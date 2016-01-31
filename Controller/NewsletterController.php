<?php
/**
 * NewslettersController.php
 */

namespace nsNewsletter\Controller;

use nsNewsletterNewsletter\Model\Groupe;
use nsNewsletter\Model\GroupeRepository;
use nsNewsletter\Model\NewsletterRepository;


class NewsletterController
{
    /**
     * Affiche la page d'accueil avec la liste des mails
     *
     * @param String $flash Affiche un message de confirmation sur le haut de la page
     */
    public function indexAction($flash = null)
    {
        //$reposNews = new NewsletterRepository();
        //$news = $reposNews->findAll();

        require_once('../View/header.php');
        require_once('../View/Newsletter/index.php');
        require_once('../View/footer.php');
    }

    /**
     * Affiche le détail d'une offre d'emploi
     */
    public function displayNewsletterAction()
    {
        $repo = new NewsletterRepository();
        $news = $repo->findAll();

        require_once('../View/header.php');
        require_once('../View/Newsletter/displayNewsletter.php');
        require_once('../View/footer.php');

    }

    /**
     * Traite le formulaire de création d'un Groupe et persiste l'objet Groupe correspondant dans la base de données.
     *
     */
    public function handleFormAddNewsletterAction()
    {
        /*$repos = new MailRepository();

        $groupe = new Mail('', $_POST['libelle']);

        $id = $repos->persist($groupe); // On persiste l'objet dans la base et on récupère son id

        $this->indexAction('<strong>Félicitations !</strong> Le Groupe est créé avec succès !'); // Redirect to index
        */
    }

}

