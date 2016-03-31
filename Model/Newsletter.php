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
 * Class Newsletter
 * @package Newsletter\Model
 */
class Newsletter
{
    /**
     * @var
     */
    private $id_newsletter;

    /**
     * @var
     */
    private $nom;

    /**
     * @var
     */
    private $texte;

    /**
     * @var
     */
    private $lien;

    /**
     * @param $id_groupe
     * @param $libelle
     */
    function __construct($id_newsletter, $nom, $texte, $lien)
    {
        $this->id_newsletter = $id_newsletter;
        $this->nom = $nom;
        $this->texte = $texte;
        $this->lien = $lien;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id_newsletter;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id_newsletter = $id;
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
        return $this->texte;
    }

    /**
     * @param mixed $texte
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;
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