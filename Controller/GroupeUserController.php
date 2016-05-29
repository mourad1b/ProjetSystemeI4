<?php
/**
 * GroupeUserRepository.php
 */

namespace nsNewsletter\Controller;

use nsNewsletter\Model\Groupe;
use nsNewsletter\Model\GroupeRepository;
use nsNewsletter\Model\GroupeUserRepository;
use nsNewsletter\Model\User;


class GroupeUserController
{
    /**
     * Affiche la page d'accueil avec la liste des offres d'emploi
     *
     * @param String $flash Affiche un message de confirmation sur le haut de la page
     */
    public function indexAction($flash = null)
    {
        $reposUsergroupe = new GroupeUserRepository();

        $usergroupes = $reposUsergroupe->findAll();
        //var_dump($usergroupes);

        require_once('../View/header.php');
        require_once('../View/Groupe/index.php');
        require_once('../View/footer.php');
    }

    /**
     * Affiche le détail d'une offre d'emploi
     */
    public function displayGroupeAction()
    {
        $reposUser = new GroupeUserRepository();
        $groupe = $reposUser->findAll();

        require_once('../View/header.php');
        require_once('../View/Groupe/displayGroupe.php');
        require_once('../View/footer.php');

    }

    /**
     * Affetter des utilisateurs à un groupe choisi
     * Importer les utilisateurs via un fichier .CSV
     */
    public function affecteUsersToGroupeAction()
    {
        $idUsers = $_POST['idUsers'];
        $idGroupe = $_POST['idGroupe'];

        $repoGU = new GroupeUserRepository();
        $groupesusers = $repoGU->persist($idGroupe, $idUsers);

        $result = $this->db->lastInsertId();
        return $result;
    }


    /**
     * Traite le formulaire de création d'un Groupe et persiste l'objet Groupe correspondant dans la base de données.
     *
     */
    public function handleFormAddAction()
    {
        $repos = new GroupeRepository();

        $groupe = new Groupe('', $_POST['libelle'],  '');

        $id = $repos->persist($groupe); // On persiste l'objet dans la base et on récupère son id

        $this->indexAction('<strong>Félicitations !</strong> Le Groupe est créé avec succès !'); // Redirect to index
    }

}

