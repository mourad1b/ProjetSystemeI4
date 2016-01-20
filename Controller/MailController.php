<?php
/**
 * GroupeController.php
 */

namespace Newsletter\Controller;

use Newsletter\Model\Mail;
use Newsletter\Model\MailRepository;


class MailController
{
    /**
     * Affiche la page d'accueil avec la liste des offres d'emploi
     *
     * @param String $flash Affiche un message de confirmation sur le haut de la page
     */
    public function indexAction($flash = null)
    {
        $reposMail = new MailRepository();

        $mails = $reposMail->findAll();

        require_once('../View/header.php');
        require_once('../View/Mail/index.php');
        require_once('../View/footer.php');
    }

    /**
     * Affiche le détail d'une offre d'emploi
     */
    public function displayMailAction()
    {
        $reposUser = new MailRepository();
        //$user = $reposUser->find($_GET['id_user']);
        //$groupe = $reposUser->findAll();
        require_once('../View/header.php');
        require_once('../View/Mail/displayMail.php');
        //require_once('../View/User/index.php');
        require_once('../View/footer.php');

    }

    /**
     * Traite le formulaire de création d'un Groupe et persiste l'objet Groupe correspondant dans la base de données.
     *
     */
    public function handleFormAddAction()
    {
        $repos = new MailRepository();

        $mail = new Mail( $_POST['libelleMail'],$_POST['objetMail'],$_POST['bodyMail'] );

        $id = $repos->persist($mail); // On persiste l'objet dans la base et on récupère son id
        $this->indexAction('<strong>Félicitations !</strong> Le Mail est créé avec succès !'); // Redirect to index
    }

}

