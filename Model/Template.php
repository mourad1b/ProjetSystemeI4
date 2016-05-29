<?php
/**
 * Created by PhpStorm.
 * User: Mourad
 * Date: 08/01/2016
 * Time: 16:39
 */

/**
 * Newsletter.php
 */

namespace nsNewsletter\Model;


/**
 * Class Template
 * @package Template\Model
 */
class Template
{
    /**
     * @var
     */
    private $id_template;

    /**
     * @var
     */
    private $nom;

    /**
     * @var
     */
    private $contenu;

    /**
     * @var
     */
    private $lien;

    /**
     * @param $id_groupe
     * @param $libelle
     */
    function __construct($id_template, $nom, $contenu, $lien)
    {
        $this->id_template = $id_template;
        $this->nom = $nom;
        $this->contenu = $contenu;
        $this->lien = $lien;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id_template;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id_template = $id;
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
    public function getTexte()
    {
        return $this->contenu;
    }

    /**
     * @param mixed $contenu
     */
    public function setTexte($contenu)
    {
        $this->contenu = $contenu;
    }

    /**
     * @return mixed
     */
    public function getLien()
    {
        return $this->lien;
    }

    /**
     * @param mixed $photo
     */
    public function setLien($lien)
    {
        $this->lien = $lien;
    }
}