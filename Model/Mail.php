<?php
/**
 * Created by PhpStorm.
 * User: Mourad
 * Date: 08/01/2016
 * Time: 16:39
 */

/**
 * Mail.php
 */

namespace Newsletter\Model;


/**
 * Class Mail
 * @package Newsletter\Model
 */
class Mail
{
    /**
     * @var
     */
    private $id_mail;

    /**
     * @var
     */
    private $libelle;

    /**
     * @var
     */
    private $objet;

    /**
     * @var
     */
    private $body;

    /**
     * @param $id_groupe
     * @param $libelle
     */
    function __construct($libelle, $objet, $body)
    {

        $this->libelle = $libelle;
        $this->body = $body;
        $this->objet = $objet;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id_mail;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id_mail = $id;
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
        $this->objet = $objet;
    }


    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

}