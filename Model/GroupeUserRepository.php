<?php
/**
 * GroupeUserRepository.php
 */

namespace Newsletter\Model;

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
        $raw = $this->db->SqlLine('SELECT ug.* WHERE ug.id_user = :id_user AND ug.id_groupe = :id_groupe GROUP BY u.id_user ORDER BY u.id_user DESC', array('id_groupe' => $id_groupe, 'id_user' => $id_user, ));

        if ($raw == null) {
            header('HTTP/1.0 404 Not Found');
            exit('Utilisateur non trouvé');
        }

        return new GroupeUser($raw['id_user'], $raw['id_groupe']);
    }

    public function findAll()
    {
        $stmt = "SELECT ug.* FROM groupe_user ug";

        $raw = $this->db->SqlArray($stmt);
        $hydrated = array();

        foreach ($raw as $usergroupe) {
            $hydrated[] = new GroupeUser($usergroupe['id_user'], $usergroupe['id_groupe']);
        }

        return $hydrated;
    }
}