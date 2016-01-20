<?php
/**
 * GroupeController.php
 */

namespace Newsletter\Controller;

use Newsletter\Model\Groupe;
use Newsletter\Model\GroupeRepository;


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

        $groupes = $reposGroupe->findAll();
        var_dump($groupes);

        foreach ($groupes as $groupe){
            echo $groupe->getLibelle() . ' => ' . $groupe->getLibelle() . '<br>';
        }


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
        //$user = $reposUser->find($_GET['id_user']);
        $groupe = $reposUser->findAll();
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

        $groupe = new Groupe('', $_POST['libelle']);

        $id = $repos->persist($groupe); // On persiste l'objet dans la base et on récupère son id

        $this->indexAction('<strong>Félicitations !</strong> Le Groupe est créé avec succès !'); // Redirect to index
    }

}

