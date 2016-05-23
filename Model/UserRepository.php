<?php
/**
 * UserRepository.php
 */

namespace nsNewsletter\Model;

class UserRepository
{
    /**
     * @var PDOSingleton
     */
    private $db;

    function __construct()
    {
        $this->db = PDOSingleton::getConnect();
    }

    /**
     * Récupère un user en base de donnée
     * @param $id Integer l'id de l'emploo
     * @return User l'objet correspondant
     */
    public function find($id)
    {
        $raw = $this->db->SqlLine('SELECT u.* FROM users u WHERE id_user =:id', array('id' => $id));

        if ($raw == null) {
            header('HTTP/1.0 404 Not Found');
            exit('Utilisateur non trouvé');
        }

        return new User($raw['id_user'], $raw['nom'], $raw['prenom'], $raw['mail'],  $raw['telephone'], $raw['id_groupe'], $raw['groupe_libelle']);
    }

    public function findUsersByIds($ids)
    {
        $id_user = $ids['id_user'];
        $id_groupe = $ids['id_groupe'];
        $raw = $this->db->SqlValue('SELECT * FROM groupe_user WHERE id_user=:id_user AND id_groupe=:id_groupe',array('id_groupe' => $id_groupe, 'id_user' => $id_user));
        if (empty($raw) )
            return 0;
        return 1;
    }

    public function findAll()
    {
        $stmt = "SELECT u.* FROM users u";

        $raw = $this->db->SqlArray($stmt);
        $hydrated = array();

        foreach ($raw as $user) {
            $id_groupe = array(); $groupe_libelle = array();
            if(isset($user['id_groupe'])){
                $id_groupe = $user['id_groupe'];
            }
            if(isset($user['groupe_libelle'])){
                $groupe_libelle = $user['id_groupe'];
            }
            $hydrated[] = new User($user['id_user'], $user['nom'], $user['prenom'], $user['mail'], $user['telephone'], $id_groupe, $groupe_libelle  );
        }

        return $hydrated;
    }

    public function findWhere($where)
    {
        $condition = $where;

        $user = $this->db->SqlLine('SELECT u.* FROM users u WHERE nom = :_username AND prenom = :_password',
                                array(  '_username' => $condition['_username'],
                                        '_password' => $condition['_password']));
        //$hydrated = array();
        //$hydrated[] = new User($user['id_user'], $user['nom'], $user['prenom'], $user['mail'], $user['telephone'], $user['adresse'], $user['etat'], $user['accuse']);

        //return $hydrated;
        return $user;
    }

    public function findUsersInGroupe()
    {
        $stmt = "SELECT u.*, count(DISTINCT u.id_user) AS countUser
                  FROM users u
                  JOIN groupe_user ug ON u.id_user = ug.id_user
                  JOIN groupe g ON g.id_groupe = ug.id_groupe
                  GROUP BY u.id_user
                  ORDER BY u.id_user DESC";

        $raw = $this->db->SqlArray($stmt);

        $hydrated = array();
        foreach ($raw as $user) {
            $hydrated[] = new User($user['id_user'], $user['nom'], $user['prenom'], $user['mail'], $user['telephone'], $user['id_groupe'], $user['groupe_libelle']);
        }

        return $hydrated;
    }

    public function findUsersInGroupeUser()
    {
        $stmt = "SELECT g.id_groupe, g.libelle AS groupe_libelle, u.*
                FROM users u
                JOIN groupe_user gu ON u.id_user = gu.id_user
                JOIN groupe g ON g.id_groupe = gu.id_groupe
                GROUP BY gu.id_user
                ORDER BY gu.id_user";

        $raw = $this->db->SqlArray($stmt);

        $hydrated = array();

        foreach ($raw as $user) {
            $hydrated[] = new User($user['id_user'], $user['nom'], $user['prenom'], $user['mail'], $user['telephone'], $user['id_groupe'], $user['groupe_libelle']);
        }

        return $hydrated;
    }

    /**
     * Persiste un objet User dans la base de donnée
     *
     * @param User $user un objet User
     * @return string l'id de l'insertion
     */
    public function persist(User $user)
    {
        $this->db->Sql("INSERT INTO users (nom,prenom,mail,telephone) VALUES(:nom,:prenom,:mail,:telephone)",
            array(  'nom' => $user->getNom(),
                    'prenom' => $user->getPrenom(),
                    'mail' => $user->getMail(),
                    'telephone' => $user->getTelephone()));

        $id = $this->db->lastInsertId();
        return $id;
    }

    public function update(User $user)
    {
        $this->db->Sql("UPDATE users SET nom =:nom, prenom =:prenom, mail =:mail, telephone=:telephone WHERE id_user=:id",
            array(
                'id' => $user->getId(),
                'nom' => $user->getNom(),
                'prenom' => $user->getPrenom(),
                'mail' => $user->getMail(),
                'telephone' => $user->getTelephone()));

        //$id = $this->db->lastInsertId();
        //return $id;
    }

    public function remove(User $user)
    {
        // Supprime le mail
        $this->db->Sql("DELETE FROM users WHERE id_user =:id",
            array('id' => $user->getId()));
    }

    /**
     * Supprime de la base de donnée une offre d'emploi ainsi que les candidatures qui lui sont liées
     *
     * @param User $user Le travail en question
     */
    public function removeUserCascade(User $user)
    {
        // Suprime les candidatures liées
        $this->db->Sql("DELETE FROM users WHERE id_user = :id",
            array('id' => $user->getId()));

        // Supprime l'emploi
        $this->db->Sql("DELETE FROM users WHERE id_user = :id",
            array('id' => $user->getId()));
    }
}