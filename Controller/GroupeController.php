<?php
/**
 * GroupeController.php
 */

namespace nsNewsletter\Controller;

use nsNewsletter\Model\Groupe;
use nsNewsletter\Model\GroupeRepository;
use nsNewsletter\Model\UserRepository;


class GroupeController
{
    /**
     * Affiche la page d'accueil avec la liste des offres d'emploi
     *
     * @param String $flash Affiche un message de confirmation sur le haut de la page
     */
    public function indexAction($flash = null)
    {
        $reposGroupe = new GroupeRepository();
        $groupes = $reposGroupe->findAllWithCount();

        //var_dump($groupes);

        $reposUser = new UserRepository();
        $users = $reposUser->findUsersInGroupeUser();

        //$userLogged = $reposUser->findWhere();

        require_once('../View/header.php');
        require_once('../View/Groupe/index.php');
        require_once('../View/footer.php');
    }

    /**
     * Affiche le détail d'une offre d'emploi
     */
    public function displayGroupeAction()
    {
        $reposUser = new GroupeRepository();
        $groupes = $reposUser->findAll();

        $reposGroupe = new GroupeRepository();
        $groupesCount = $reposGroupe->findAllWithCount();

        //var_dump($groupes);

        $reposUser = new UserRepository();
        $users = $reposUser->findUsersInGroupeUser();

        require_once('../View/header.php');
        require_once('../View/Groupe/displayGroupe.php');
        //require_once('../View/User/index.php');
        require_once('../View/footer.php');

    }

    public function getGroupesAction()
    {
        $repos = new GroupeRepository();
        $groupes = $repos->findAll();

        $json = array();
        foreach($groupes as $groupe){
            $array = array(
                'idGroupe' => $groupe->getId(),
                'libelleGroupe' => $groupe->getLibelle()
            );
            array_push($json, $array);
        }

        echo json_encode($json);
    }

    public function getGroupeByIdAction($id)
    {
        $repos = new GroupeRepository();
        //$mail = new Mail($_POST['idMail'], $_POST['libelleMail'], $_POST['objetMail'], $_POST['corpsMail']);

        $groupe = $repos->find($id); // On persiste l'objet dans la base et on récupère son id

        return $groupe;
        //$this->indexAction(/*'<strong>Succès !</strong> Le mail a bien été créé.'*/); // Redirect to index
    }

    public function addGroupeAction()
    {
        $repos = new GroupeRepository();

        $groupe = new Groupe('', $_POST['libelleGroupe'], '');

        $id = $repos->persist($groupe); // On persiste l'objet dans la base et on récupère son id

        $this->indexAction('<strong>Succès !</strong> Groupe créé.'); // Redirect to index
    }

    public function updateGroupeAction(Groupe $groupe)
    {
        $repos = new GroupeRepository();
        $id = $repos->update($groupe); // On persiste l'objet dans la base et on récupère son id

        $this->indexAction('<strong>Succès !</strong> Groupe mis à jour.'); // Redirect to index
    }

    /**
     * Affetter des utilisateurs à un groupe choisi
     * Importer les utilisateurs via un fichier .CSV
     */
    public function affecteUserGroupeAction()
    {
        $users = array();
        $post = $_POST;
        $files = $_FILES;

        if ((isset($_FILES['file']['tmp_name'])) and ($_FILES['file']['size'] > 0)) {
            $contents = file_get_contents($_FILES['file']['tmp_name']);
            $name = $_FILES['file']['name'];
            $mime = $_FILES['file']['type'];

            $http = array(
                'name'=>$name,
                'mime' => $mime,
                'contents'=>$contents
            );

        }else{

        }
    }

    public function deleteGroupeAction()
    {
        $repos = new GroupeRepository();
        $groupe = new Groupe($_POST['idGroupe'], $_POST['libelleGroupe'], array());

        $repos->remove($groupe); // On persiste l'objet dans la base et on récupère son id

        $this->indexAction('<strong>Succès !</strong> Groupe supprimé.'); // Redirect to index
    }
    /**
     * Traite le formulaire de création d'un Groupe et persiste l'objet Groupe correspondant dans la base de données.
     *
     */
    public function handleFormAddAction()
    {
        $repos = new GroupeRepository();
        $groupe = new Groupe('', $_POST['libelle'], array());

        $id = $repos->persist($groupe); // On persiste l'objet dans la base et on récupère son id

        $this->indexAction('<strong>Félicitations !</strong> Le Groupe est créé avec succès !'); // Redirect to index
    }

}

