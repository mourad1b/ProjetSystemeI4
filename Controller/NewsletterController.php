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
    public function addNewsletterAction()
    {
        $repos = new NewsletterRepository();

        $news = new Newsletter('', $_POST['nomNewsletter'], $_POST['contenuNewsletter'], $_POST['lienNewsletter']);

        $id = $repos->persist($news); // On persiste l'objet dans la base et on récupère son id

        $this->displayNewsletterAction('<strong>Succès !</strong> Newsletter créée'); // Redirect to index

    }

    public function getNewsletterByIdAction($id)
    {
        $repos = new NewsletterRepository();
        $news = $repos->find($id); // On persiste l'objet dans la base et on récupère son id

        return $news;
        //$this->indexAction(/*'<strong>Succès !</strong> Le mail a bien été créé.'*/); // Redirect to index
    }
    public function  getNewslettersAction()
    {
        $repos = new NewsletterRepository();
        $newsletters = $repos->findAll();

        $json = array();
        foreach($newsletters as $newsletter){
            $array = array(
                'idNewsletter' => $newsletter->getId(),
                'nom' => $newsletter->getNom(),
                'contenu' => $newsletter->getTexte(),
                'lien' => $newsletter->getLien()
            );
            array_push($json, $array);
        }

        echo json_encode($json);
    }

    public function updateNewsletterAction(Newsletter $news)
    {
        $repos = new NewsletterRepository();
        $id = $repos->update($news); // On persiste l'objet dans la base et on récupère son id

        $this->indexAction('<strong>Succès !</strong> Newsletter mise à jour.'); // Redirect to index
    }

    public function deleteNewsletterAction()
    {
        $repos = new NewsletterRepository();
        $news = new Newsletter($_POST['idNewsletter'], $_POST['nomNewsletter'], $_POST['contenuNewsletter'], $_POST['lienNewsletter']);
        $repos->remove($news);

        $this->indexAction('<strong>Succès !</strong> Newsletter supprimée.'); // Redirect to index
    }

}

