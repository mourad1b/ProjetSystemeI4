<?php
/**
 * TemplateRepository.php
 */

namespace nsNewsletter\Model;

class TemplateRepository
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
     * Récupère un mail en base de donnée
     * @param $id Integer l'id du mail
     * @return Template l'objet correspondant
     */
    public function find($id)
    {
        $raw = $this->db->SqlLine('SELECT n.* FROM template n WHERE id_template =:id', array('id' => $id));
        // GROUP BY n.id_template ORDER BY n.id_template DESC

        if ($raw == null) {
            header('HTTP/1.0 404 Not Found');
            exit('Template non trouvé');
        }

        return new Template($raw['id_template'], $raw['nom'], $raw['contenu'], $raw['lien']);
    }

    public function findAll()
    {
        $stmt = "SELECT n.* FROM template n ORDER BY id_template DESC";

        $raw = $this->db->SqlArray($stmt);
        $hydrated = array();

        foreach ($raw as $news) {
            $hydrated[] = new Template($news['id_template'], $news['nom'], $news['contenu'], $news['lien']);
        }

        return $hydrated;
    }

    public function persist(Template $template)
    {
        //$result = $this->db->SqlValue("Select `nom` From template where `nom` = '".$template->getNom()."' LIMIT 1 ");
        //$req = mysql_fetch_array($result);
        $this->db->Sql("INSERT INTO template (nom, contenu, lien) VALUES(:nom,:contenu,:lien)",
            array(  'nom' => $template->getNom(),
                'contenu' => $template->getTexte(),
                'lien' => $template->getLien()));
    }

    public function update(Template $news)
    {
        $this->db->Sql("UPDATE template SET nom =:nom, contenu =:contenu, lien=:lien WHERE id_template=:id",
            array(
                'id' => $news->getId(),
                'nom' => $news->getNom(),
                'contenu' => $news->getTexte(),
                'lien' => $news->getLien()));

        //$id = $this->db->lastInsertId();
        //return $id;
    }

    public function remove(Template $news)
    {
        //@todo supprimer la template CAscade idtemplate dans Campagne

        $repoCampagnes = new CampagneRepository();
        $campagnes =$repoCampagnes->findAll();
        foreach($campagnes as $campagne){
            if($campagne->getIdTemplate() == $news->getId()){
                $this->db->Sql("UPDATE campagne SET id_template =:idTemplate WHERE id_campagne =:id",
                    array ( 'id' => $campagne->getId(),
                            'idTemplate' => null) );
            }
        }

        // Supprime la template
        $this->db->Sql("DELETE FROM template WHERE id_template =:id",
            array('id' => $news->getId()));
    }
}