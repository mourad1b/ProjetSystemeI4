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

        return new Newsletter($raw['id_newsletter'], $raw['id_mail'], $raw['nom'], $raw['texte'], $raw['photo'], $raw['lien']);
    }

    public function findAll()
    {
        $stmt = "SELECT n.* FROM newsletter n";

        $raw = $this->db->SqlArray($stmt);
        $hydrated = array();

        foreach ($raw as $news) {
            $hydrated[] = new Newsletter($news['id_newsletter'], $news['id_mail'], $news['nom'], $news['texte'], $news['photo'], $news['lien']);
        }

        return $hydrated;
    }

}