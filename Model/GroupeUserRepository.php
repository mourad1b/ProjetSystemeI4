<?php
/**
 * GroupeUserRepository.php
 */

namespace nsNewsletter\Model;

class GroupeUserRepository
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
     * Récupère un GroupeUser en base de donnée
     * @param $id Integer l'id de l'emploo
     * @return GroupeUser l'objet correspondant
     */
    public function find($ids)
    {
        $id_user = $ids['$id_user'];
        $id_groupe = $ids['$id_groupe'];
        $raw = $this->db->SqlLine('SELECT ug.* WHERE ug.id_user =:id_user AND ug.id_groupe =:id_groupe GROUP BY u.id_user ORDER BY u.id_user DESC', array('id_groupe' => $id_groupe, 'id_user' => $id_user, ));

        if ($raw == null) {
            header('HTTP/1.0 404 Not Found');
            exit('Utilisateur non trouvé');
        }

        return new GroupeUser($raw['id_groupe'], $raw['id_user']);
    }
    public function findGroupOfUser($ids)
    {
        $id_user = $ids['id_user'];
        $id_groupe = $ids['id_groupe'];
        $raw = $this->db->SqlValue('SELECT * FROM groupe_user WHERE id_user=:id_user AND id_groupe=:id_groupe',
            array(  'id_groupe' => $id_groupe,
                    'id_user' => $id_user));
        if (empty($raw) )
            return 0;
        return 1;
    }

    public function findAll()
    {
        $stmt = "SELECT ug.* FROM groupe_user ug ORDER BY ug.id_groupe DESC";

        $raw = $this->db->SqlArray($stmt);
        $hydrated = array();

        foreach ($raw as $usergroupe) {
            $hydrated[] = new GroupeUser($usergroupe['id_groupe'], $usergroupe['id_user']);
        }

        return $hydrated;
    }

    public function persist($idGroupe, $users)
    {
        $results = array();
        foreach($users as $user){
            $this->db->Sql(
                "INSERT INTO groupe_user (id_groupe, id_user) VALUES(:idGroupe, :idUser)",
                array(  'idGroupe' => $idGroupe,
                        'idUser' => $user)
            );
            $results[] = $this->db->lastInsertId();
        }

        return $results;
    }

    public function findUsersByIdGroupe($id)
    {
        $raw = $this->db->SqlArray("SELECT ug.* FROM groupe_user ug WHERE id_groupe =:id ORDER BY id_user DESC", array('id' => $id));
        $hydrated = array();

        foreach ($raw as $usergroupe) {
            $hydrated[] = new GroupeUser($usergroupe['id_groupe'], $usergroupe['id_user']);
        }

        return $hydrated;
    }
}