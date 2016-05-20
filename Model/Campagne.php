<?php
/**
 * Created by PhpStorm.
 * User: Mourad
 * Date: 08/01/2016
 * Time: 16:39
 */

/**
 * Campagne.php
 */

namespace nsNewsletter\Model;


/**
 * Class Mail
 * @package Newsletter\Model
 */
class Campagne
{
    /**
     * @var
     */
    private $id_campagne;

    /**
     * @var
     */
    private $id_newsletter;

    /**
     * @var
     */
    private $id_groupe;

    /**
     * @var
     */
    private $mail_user;

    /**
     * @var
     */
    private $libelle;

    /**
     * @var
     */
    private $objet;

    /**
     * @param $id_campagne
     * @param $id_newsletter
     * @param $id_groupe
     * @param $mail_user
     * @param $libelle
     * @param $objet
     */
    function __construct($id_campagne, $id_newsletter, $id_groupe, $libelle, $objet, $mail_user )
    {
        $this->id_campagne = $id_campagne;
        $this->id_newsletter = $id_newsletter;
        $this->id_groupe = $id_groupe;
        $this->mail_user = $mail_user;
        $this->setLibelle($libelle);
        $this->setObjet($objet);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id_campagne;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id_ = $id;
    }

    /**
     * @return mixed
     */
    public function getIdNewsletter()
    {
        return $this->id_newsletter;
    }

    /**
     * @param mixed $id
     */
    public function setIdNewsletter($id)
    {
        $this->id_ = $id;
    }

    /**
     * @return mixed
     */
    public function getIdGroupe()
    {
        return $this->id_groupe;
    }

    /**
     * @param mixed $id
     */
    public function setIdGroupe($id)
    {
        $this->id_ = $id;
    }

    /**
     * @return mixed
     */
    public function getMailUser()
    {
        return $this->mail_user;
    }

    /**
     * @param mixed $id
     */
    public function setMailUser($mailUser)
    {
        if (preg_match('#<script(.*?)>(.*?)</script>#is', $mailUser)) {
            exit('Hack de la validation du formulaire côté client : Injection JS');
        }
        $this->mail_user_ = strip_tags($mailUser);
    }
    /**
     * @return mixed
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param mixed $nom
     */
    public function setLibelle($libelle)
    {
        if (preg_match('#<script(.*?)>(.*?)</script>#is', $libelle)) {
            exit('Hack de la validation du formulaire côté client : Injection JS');
        }
        $this->libelle = strip_tags($libelle);
    }

    /**
     * @return mixed
     */
    public function getObjet()
    {
        return $this->objet;
    }

    /**
     * @param mixed $objet
     */
    public function setObjet($objet)
    {
        if (preg_match('#<script(.*?)>(.*?)</script>#is', $objet)) {
            exit('Hack de la validation du formulaire côté client : Injection JS');
        }
        $this->objet = strip_tags($objet);
    }

}