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

