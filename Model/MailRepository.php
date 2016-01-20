<?php
/**
 * UserRepository.php
 */

namespace Newsletter\Model;

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
     * Récupère un emploi en base de donnée
     * @param $id Integer l'id de l'emploo
     * @return User l'objet correspondant
     */
    public function find($id)
    {
        $raw = $this->db->SqlLine('SELECT m.* WHERE id_mail = :id GROUP BY m.id_mail ORDER BY m.id_mail DESC', array('id' => $id));

        if ($raw == null) {
            header('HTTP/1.0 404 Not Found');
            exit('Utilisateur non trouvé');
        }

        return new Mail($raw['libelle'], $raw['objet'], $raw['body']);
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
     * Persiste un objet User dans la base de donnée
     *
     * @param User $user un objet User
     * @return string l'id de l'insertion
     */
    public function persist(Mail $mail)
    {
        $this->db->Sql("INSERT INTO `mail`(`libelle`, `objet`, `body`) VALUES(:libelle,:objet,:body)",
            array(  'libelle' => $mail->getLibelle(),
                    'objet' => $mail->getObjet(),
                    'body' => $mail->getBody()));
        $id = $this->db->lastInsertId();
        return $id;
    }


    /**
     * Supprime de la base de donnée une offre d'emploi ainsi que les candidatures qui lui sont liées
     *
     * @param User $user Le travail en question
     */
    public function removeJobCascade(Mail $mail)
    {
        // Suprime les candidatures liées
        $this->db->Sql("DELETE FROM mail WHERE id_mail = :id",
            array('id' => $mail->getId()));

        // Supprime l'emploi
        $this->db->Sql("DELETE FROM users WHERE id_mail = :id",
            array('id' => $mail->getId()));
    }
}