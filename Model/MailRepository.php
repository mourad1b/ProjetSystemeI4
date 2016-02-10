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

        return new Mail($raw['id'], $raw['libelle'], $raw['objet'], $raw['body']);
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

        $result = $this->db->SqlValue("SELECT libelle FROM mail WHERE libelle = '".$mail->getLibelle()."' LIMIT 1 ");
        //$req = mysql_fetch_array($result);

        if ($result) {
            echo 'Ce type de mail existe déja';
        }
        else {
            $this->db->Sql("INSERT INTO mail (libelle, objet, body) VALUES(:libelle,:objet,:body)",
            array(  'libelle' => $mail->getLibelle(),
                'objet' => $mail->getObjet(),
                'body' => $mail->getBody()));
        }
        return $result;
        //$id = $this->db->lastInsertId();
        //return $id;
    }

    public function update(Mail $mail)
    {
        $this->db->Sql("UPDATE mail SET libelle = :libelle, objet = :objet, body = :body WHERE id_mail = :id",
            array(
                'id' => $mail->getId(),
                'libelle' => $mail->getLibelle(),
                'objet' => $mail->getObjet(),
                'corps' => $mail->getBody()));

        //$id = $this->db->lastInsertId();
        //return $id;
    }

    public function remove(Mail $mail)
    {
        // Supprime le mail
        $this->db->Sql("DELETE FROM mail WHERE id_mail = :id",
            array('id' => $mail->getId()));
    }

    /**
     * Supprime de la base de donnée un mail
     *
     * @param mail $mail Le travail en question
     */
    public function removeMailCascade($id)
    {
        // Supprime le mail
        // todo Supprimer le mail de newsletter,... cascade
        $this->db->Sql("DELETE FROM mail WHERE id_mail = :id",
            array('id' => $id));
    }
}