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

namespace Newsletter\Model;


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

    /**
     * @param $id_groupe
     * @param $libelle
     */
    function __construct($id_groupe, $libelle)
    {
        $this->id_groupe = $id_groupe;
        $this->libelle = $libelle;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->$id_groupe;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->$id_groupe = $id;
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

}