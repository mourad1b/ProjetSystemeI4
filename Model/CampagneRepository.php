<?php
/**
 * CampagneRepository.php
 */

namespace nsNewsletter\Model;

class CampagneRepository
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
     * Récupère un campagne en base de donnée
     * @param $id Integer l'id du campagne
     * @return Campagne l'objet correspondant
     */
    public function find($id)
    {
        $raw = $this->db->SqlLine('SELECT c.* FROM campagne c WHERE id_campagne =:id GROUP BY c.id_campagne ORDER BY c.id_campagne DESC', array('id' => $id));

        if ($raw == null) {
            header('HTTP/1.0 404 Not Found');
            exit('Campagne non trouvee');
        }

        return new Campagne($raw['id_campagne'], $raw['libelle'], $raw['objet'], $raw['id_newsletter'], $raw['id_groupe'], $raw['mail_user']);
    }

    public function findAll()
    {
        $stmt = "SELECT m.* FROM campagne m";

        $raw = $this->db->SqlArray($stmt);
        $hydrated = array();

        foreach ($raw as $campagne) {
            $hydrated[] = new Campagne($campagne['id_campagne'], $campagne['libelle'], $campagne['objet'], $campagne['id_newsletter'], $campagne['id_groupe'],   $campagne['mail_user']);
        }

        return $hydrated;
    }

    /**
     * Persiste un objet Campagne dans la base de donnée
     *
     * @param Campagne $user un objet Campagne
     * @return string l'id de l'insertion
     */
    public function persist(Campagne $campagne)
    {
        $this->db->Sql("INSERT INTO campagne (libelle, objet, id_newsletter, id_groupe, mail_user) VALUES(:libelle,:objet,:id_newsletter,:id_groupe,:mail_user)",
            array(  'libelle' => $campagne->getLibelle(),
                    'objet' => $campagne->getObjet(),
                    'id_newsletter' => $campagne->getIdNewsletter(),
                    'id_groupe' => $campagne->getIdGroupe(),
                    'mail_user' => $campagne->getMailUser()));
    }

    public function update(Campagne $campagne)
    {
        $this->db->Sql("UPDATE campagne SET libelle =:libelle, objet =:objet, mail_user =:mail_user, id_newsletter =:id_newsletter, id_groupe =:id_groupe WHERE id_campagne =:id",
            array(  'id' => $campagne->getId(),
                    'libelle' => $campagne->getLibelle(),
                    'objet' => $campagne->getObjet(),
                    'id_newsletter' => $campagne->getIdNewsletter(),
                    'id_groupe' => $campagne->getIdGroupe(),
                    'mail_user' => $campagne->getMailUser()));

        //$id = $this->db->lastInsertId();
        //return $id;
    }

    public function remove(Campagne $campagne)
    {
        // Supprime le campagne
        $this->db->Sql("DELETE FROM campagne WHERE id_campagne =:id",
            array('id' => $campagne->getId()));
    }

}