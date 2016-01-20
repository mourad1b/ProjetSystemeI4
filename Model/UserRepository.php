<?php
/**
 * UserRepository.php
 */

namespace Newsletter\Model;

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
     * Récupère un emploi en base de donnée
     * @param $id Integer l'id de l'emploo
     * @return User l'objet correspondant
     */
    public function find($id)
    {
        $raw = $this->db->SqlLine('SELECT u.* WHERE id_user = :id GROUP BY u.id_user ORDER BY u.id_user DESC', array('id' => $id));

        if ($raw == null) {
            header('HTTP/1.0 404 Not Found');
            exit('Utilisateur non trouvé');
        }

        return new User($raw['id_user'], $raw['nom'], $raw['prenom'], $raw['email']);
    }

    public function findAll()
    {
        $stmt = "SELECT u.* FROM benzaidm.user u";

        $raw = $this->db->SqlArray($stmt);
        $hydrated = array();

        foreach ($raw as $user) {
            $hydrated[] = new User($user['id_user'], $user['nom'], $user['prenom'], $user['email']);
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
        $this->db->Sql("INSERT INTO benzaidm.user VALUES('',:nom,:prenom,:email)",
            array('nom' => $user->getNom(),
                'prenom' => $user->getPrenom(),
                'email' => $user->getEmail()));
        return $this->db->lastInsertId();
    }


    /**
     * Supprime de la base de donnée une offre d'emploi ainsi que les candidatures qui lui sont liées
     *
     * @param User $user Le travail en question
     */
    public function removeJobCascade(User $user)
    {
        // Suprime les candidatures liées
        $this->db->Sql("DELETE FROM benzaidm.user WHERE id_user = :id",
            array('id' => $user->getId()));

        // Supprime l'emploi
        $this->db->Sql("DELETE FROM benzaidm.user WHERE id_user = :id",
            array('id' => $user->getId()));
    }
}