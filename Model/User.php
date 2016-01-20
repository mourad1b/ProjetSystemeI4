<?php
/**
 * Created by PhpStorm.
 * User: Mourad
 * Date: 08/01/2016
 * Time: 16:39
 */

/**
 * User.php
 */

namespace Newsletter\Model;


/**
 * Class User
 * @package Newsletter\Model
 */
class User
{
    /**
     * @var
     */
    private $id_user;

    /**
     * @var
     */
    private $nom;

    /**
     * @var
     */
    private $prenom;

    /**
     * @var
     */
    private $mail;

    /**
     * @var
     */
    private $telephone;

    /**
     * @param $id_user
     * @param $nom
     * @param $prenom
     * @param $mail
     */
    function __construct($id_user, $nom,$prenom, $mail)
    {
        $this->mail = $mail;
        $this->nom = $nom;
        $this->prenom = $prenom;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id_user;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id_user = $id;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function s($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        if (preg_match('#<script(.*?)>(.*?)</script>#is', $nom)) {
            exit('Hack de la validation du formulaire côté client : Injection JS');
        }
        $this->nom = strip_tags($nom);
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        if (preg_match('#<script(.*?)>(.*?)</script>#is', $prenom)) {
            exit('Hack de la validation du formulaire côté client : Injection JS');
        }
        $this->prenom = strip_tags($prenom);
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     */
    public function setTelephone($telephone)
    {
        if (preg_match('#<script(.*?)>(.*?)</script>#is', $telephone)) {
            exit('Hack de la validation du formulaire côté client : Injection JS');
        }
        $this->$telephone = strip_tags($telephone);
    }

}