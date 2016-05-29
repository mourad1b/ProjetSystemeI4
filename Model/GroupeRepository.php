<?php
/**
 * GroupeRepository.php
 */

namespace nsNewsletter\Model;

class GroupeRepository
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
     * Récupère un groupe en base de donnée
     * @param $id Integer l'id du groupe
     * @return Groupe l'objet correspondant
     */
    public function find($id)
    {
        $raw = $this->db->SqlLine('SELECT g.* WHERE id_groupe = :id GROUP BY g.id_groupe ORDER BY g.id_groupe DESC', array('id' => $id));

        if ($raw == null) {
            header('HTTP/1.0 404 Not Found');
            exit('Groupe non trouvé');
        }

        return new Groupe($raw['id_groupe'], $raw['libelle'], $raw['countUser']);
    }

    public function findAll()
    {
        $stmt = "SELECT g.* FROM groupe g ORDER BY id_groupe DESC";

        $raw = $this->db->SqlArray($stmt);
        $hydrated = array();

        foreach ($raw as $groupe) {
            $hydrated[] = new Groupe($groupe['id_groupe'], $groupe['libelle'], '');
        }

        return $hydrated;
    }

    public function findAllWithCount()
    {
        $stmt = "SELECT g.*, count(DISTINCT gu.id_user) AS countUser
                    FROM groupe g
                    JOIN groupe_user gu ON g.id_groupe = gu.id_groupe
                    GROUP BY gu.id_groupe
                    ORDER BY gu.id_groupe DESC";

        $raw = $this->db->SqlArray($stmt);

        $hydrated = array();

        foreach ($raw as $groupe) {
            $hydrated[] = new Groupe($groupe['id_groupe'], $groupe['libelle'], $groupe['countUser']);
        }

        return $hydrated;
    }

    /**
     * Persiste un objet Groupe dans la base de donnée
     *
     * @param Groupe $user un objet Groupe
     * @return string l'id de l'insertion
     */
    public function persist(Groupe $groupe)
    {
        $result = $this->db->SqlValue("SELECT libelle FROM groupe WHERE libelle = '".$groupe->getLibelle()."' LIMIT 1");
        //$req = mysql_fetch_array($result);

        if ($result) {
            return '';
        }
        else {
            $this->db->Sql(
                "INSERT INTO groupe (libelle) VALUES(:libelle)",
                array('libelle' => $groupe->getLibelle())
            );
            $id = $this->db->lastInsertId();
            $result = $id;
        }
        return $result;
    }


    public function update(Groupe $groupe)
    {
        $this->db->Sql("UPDATE groupe SET libelle =:libelle WHERE id_groupe =:id",
            array(
                'id' => $groupe->getId(),
                'libelle' => $groupe->getLibelle()));
    }

    public function remove(Groupe $groupe)
    {
        // Supprime le mail
        $this->db->Sql("DELETE FROM groupe WHERE id_groupe =:id",
            array('id' => $groupe->getId()));
    }

    /**
     * Supprime de la base de donnée une offre d'emploi ainsi que les candidatures qui lui sont liées
     *
     * @param User $user Le travail en question
     */
    public function removeUserFromGroupe(User $user)
    {
        // Suprime les user liées
        $this->db->Sql("DELETE FROM groupe_user WHERE id_user =:id",
            array('id' => $user->getId()));
    }
}