<?php
/**
 * MailRepository.php
 */

namespace nsNewsletter\Model;

class MailRepository
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
     * @return Mail l'objet correspondant
     */
    public function find($id)
    {
        $raw = $this->db->SqlLine('SELECT m.* WHERE id_mail = :id GROUP BY m.id_mail ORDER BY m.id_mail DESC', array('id' => $id));

        if ($raw == null) {
            header('HTTP/1.0 404 Not Found');
            exit('Utilisateur non trouvé');
        }

        return new Groupe($raw['id_mail'], $raw['libelle'], $raw['objet'], $raw['body']);
    }

    public function findAll()
    {
        $stmt = "SELECT m.* FROM mail m";

        $raw = $this->db->SqlArray($stmt);
        $hydrated = array();

        foreach ($raw as $mail) {
            $hydrated[] = new Mail($mail['id_mail'], $mail['libelle'], $mail['objet'], $mail['body']);
        }

        return $hydrated;
    }

    /**
     * Persiste un objet Mail dans la base de donnée
     *
     * @param Mail $user un objet Mail
     * @return string l'id de l'insertion
     */
    public function persist(Mail $mail)
    {
        $this->db->Sql("INSERT INTO mail (libelle, objet, body) VALUES(:libelle,:objet,:body)",
            array(  'libelle' => $mail->getLibelle(),
                    'objet' => $mail->getPrenom(),
                    'body' => $mail->getBody()));
        $id = $this->db->lastInsertId();
        return $id;
    }


    /**
     * Supprime de la base de donnée un mail
     *
     * @param mail $mail Le travail en question
     */
    public function removeMailCascade(Mail $mail)
    {
        // Supprime le mail
        $this->db->Sql("DELETE FROM users WHERE id_mail = :id",
            array('id' => $mail->getId()));
    }
}