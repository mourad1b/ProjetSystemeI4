<?php
/**
 * Created by PhpStorm.
 * User: Mourad
 * Date: 08/01/2016
 * Time: 16:39
 */

/**
 * GroupeUser.php
 */

namespace Newsletter\Model;


/**
 * Class GroupeUser
 * @package Newsletter\Model
 */
class GroupeUser
{
    /**
     * @var
     */
    private $id_groupe;

    /**
     * @var
     */
    private $id_user;

    /**
     * @param $id_groupe
     * @param $id_user
     */
    function __construct($id_groupe, $id_user)
    {
        $this->id_user = $id_user;
    }


    /**
     * @return mixed
     */
    public function getIdGroupe()
    {
        return $this->$id_groupe;
    }

    /**
     * @param mixed $id
     */
    public function setIdGroupe($id_groupe)
    {
        $this->$id_groupe = $id_groupe;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->$id_user;
    }

    /**
     * @param mixed $id_user
     */
    public function setIdUser($id_user)
    {
        $this->$id_user = $id_user;
    }

}