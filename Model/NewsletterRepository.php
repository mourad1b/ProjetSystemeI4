<?php
/**
 * NewsletterRepository.php
 */

namespace nsNewsletter\Model;

class NewsletterRepository
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
     * @return Newsletter l'objet correspondant
     */
    public function find($id)
    {
        $raw = $this->db->SqlLine('SELECT n.* WHERE id_newsletter = :id GROUP BY n.id_newsletter ORDER BY n.id_newsletter DESC', array('id' => $id));

        if ($raw == null) {
            header('HTTP/1.0 404 Not Found');
            exit('Utilisateur non trouvé');
        }

        return new Newsletter($raw['id_newsletter'], $raw['nom'], $raw['contenu'], $raw['lien']);
    }

    public function findAll()
    {
        $stmt = "SELECT n.* FROM newsletter n";

        $raw = $this->db->SqlArray($stmt);
        $hydrated = array();

        foreach ($raw as $news) {
            $hydrated[] = new Newsletter($news['id_newsletter'], $news['nom'], $news['contenu'], $news['lien']);
        }

        return $hydrated;
    }

    public function persist(Newsletter $newsletter)
    {
        //$result = $this->db->SqlValue("Select `nom` From newsletter where `nom` = '".$newsletter->getNom()."' LIMIT 1 ");
        //$req = mysql_fetch_array($result);
        $this->db->Sql("INSERT INTO newsletter (nom, contenu, lien) VALUES(:nom,:contenu,:lien)",
            array(  'nom' => $newsletter->getNom(),
                'contenu' => $newsletter->getTexte(),
                'lien' => $newsletter->getLien()));
    }

    public function update(Newsletter $news)
    {
        $this->db->Sql("UPDATE newsletter SET nom =:nom, contenu =:contenu, lien=:lien WHERE id_newsletter=:id",
            array(
                'id' => $news->getId(),
                'nom' => $news->getNom(),
                'contenu' => $news->getTexte(),
                'lien' => $news->getLien()));

        //$id = $this->db->lastInsertId();
        //return $id;
    }

    public function remove(Newsletter $news)
    {
        // Supprime le mail
        $this->db->Sql("DELETE FROM newsletter WHERE id_newsletter =:id",
            array('id' => $news->getId()));
    }
}