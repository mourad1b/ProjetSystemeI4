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

    private $countUser;

    /**
     * @var
     */
    private $id_groupe;

    private $groupe_libelle;

    /**
     * @param $id_user
     * @param $nom
     * @param $prenom
     * @param $mail
     * @param $telephone
     * @param $countUser
     * @param $groupe_libelle
     */
    function __construct($id_user, $nom, $prenom, $mail, $telephone, $id_groupe, $groupe_libelle)
    {
        $this->id_user = $id_user;
        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->setMail($mail);
        $this->telephone = $telephone;
        //$this->countUser = $countUser;
        $this->id_groupe = $id_groupe;
        $this->groupe_libelle = $groupe_libelle;
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
    public function getCountUser()
    {
        return $this->countUser;
    }

    /**
     * @param mixed $countUser
     */
    public function setCountUser($countUser)
    {
        $this->countUser = $countUser;
    }

    /**
     * @return mixed
     */
    public function getIdGroupe()
    {
        return $this->id_groupe;
    }

    /**
     * @param mixed $id_groupe
     */
    public function setIdGroupe($id_groupe)
    {
        $this->id_groupe = $id_groupe;
    }

    /**
     * @return mixed
     */
    public function getGroupeLibelle()
    {
        return $this->groupe_libelle;
    }

    /**
     * @param mixed $groupe_libelle
     */
    public function setGroupeLibelle($groupe_libelle)
    {
        if (preg_match('#<script(.*?)>(.*?)</script>#is', $groupe_libelle)) {
            exit('Hack de la validation du formulaire côté client : Injection JS');
        }
        $this->groupe_libelle = strip_tags($groupe_libelle);
    }

}