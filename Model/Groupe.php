<?php
/**
 * Created by PhpStorm.
 * User: Mourad
 * Date: 08/01/2016
 * Time: 16:39
 */

/**
 * Groupe.php
 */

namespace nsNewsletter\Model;


/**
 * Class Groupe
 * @package Newsletter\Model
 */
class Groupe
{
    /**
     * @var
     */
    private $id_groupe;

    /**
     * @var
     */
    private $libelle;

    private $countUser;

    /**
     * @param $id_groupe
     * @param $libelle
     * @param $countUser
     */
    function __construct($id_groupe, $libelle, $countUser)
    {
        $this->id_groupe = $id_groupe;
        $this->libelle = $libelle;
        $this->countUser = $countUser;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id_groupe;
    }

    /**
     * @param mixed
     */
    public function setId($id_groupe)
    {
        $this->$id_groupe = $id_groupe;
    }

    /**
     * @return mixed
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param mixed
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

}