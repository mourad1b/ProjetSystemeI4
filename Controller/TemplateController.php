<?php
/**
 * GroupeController.php
 */

namespace nsNewsletter\Controller;

use nsNewsletter\Model\CampagneRepository;


class TemplateController
{
    /**
     * Affiche la page d'accueil avec la liste des offres d'emploi
     *
     * @param String $flash Affiche un message de confirmation sur le haut de la page
     */
    public function indexAction($flash = null)
    {
        require_once('../View/header.php');
        require_once('../View/Template/index.php');
        require_once('../View/footer.php');
    }

    /**
     * Affiche le détail d'une offre d'emploi
     */
    public function displayTemplateAction()
    {
        require_once('../View/header.php');
        require_once('../View/Template/displayTemplate.php');
        require_once('../View/footer.php');

    }

    public function getCampagneByIdAction($id)
    {
        $repos = new CampagneRepository();
        $news = $repos->find($id); // On persiste l'objet dans la base et on récupère son id

        return $news;
        //$this->indexAction(/*'<strong>Succès !</strong> Le mail a bien été créé.'*/); // Redirect to index
    }
}

