<?php
/**
 * NewslettersController.php
 */

namespace nsNewsletter\Controller;

use nsNewsletter\Model\Newsletter;
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
        $newsletters = $repo->findAll();

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
        $repos = new NewsletterRepository();

        $news = new Newsletter('', $_POST['nomNewsletter'], $_POST['lienNewsletter'], $_POST['photoNewsletter'], $_POST['texteNewsletter']);

        $id = $repos->persist($news); // On persiste l'objet dans la base et on récupère son id

        $this->displayNewsletterAction('<strong>Félicitations !</strong> Newsletter !'); // Redirect to index

    }

}

