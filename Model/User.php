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

namespace nsNewsletter\Model;


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
     * @var
     */
    private $countUser;

    /**
     * @var
     */
    private $etat;

    /**
     * @var
     */
    private $accuse;

    /**
     * @param $id_user
     * @param $nom
     * @param $prenom
     * @param $mail
     * @param $telephone
     * @param $groupe_libelle
     */
    function __construct($id_user, $nom, $prenom, $mail, $telephone, $etat, $accuse)
    {
        $this->id_user = $id_user;
        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->setMail($mail);
        $this->telephone = $telephone;
        $this->etat = $etat;
        $this->accuse = $accuse;
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
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail)
    {
        if (preg_match('#<script(.*?)>(.*?)</script>#is', $mail)) {
            exit('Hack de la validation du formulaire côté client : Injection JS');
        }
        $this->mail = $mail;
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

    /**
     * @return mixed
     */
    public function getIdEtat()
    {
        return $this->etat;
    }

    /**
     * @param mixed $etat
     */
    public function setIdEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     * @return mixed
     */
    public function getAccuse()
    {
        return $this->accuse;
    }

    /**
     * @param mixed $accuse
     */
    public function setGroupeLibelle($accuse)
    {
        $this->accuse = $accuse;
    }

}