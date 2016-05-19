<?php
/**
 * GroupeController.php
 */

namespace nsNewsletter\Controller;

use nsNewsletter\Model\Groupe;
use nsNewsletter\Model\GroupeRepository;
use nsNewsletter\Model\UserRepository;


class CampagneController
{
    /**
     * Affiche la page d'accueil avec la liste des offres d'emploi
     *
     * @param String $flash Affiche un message de confirmation sur le haut de la page
     */
    public function indexAction($flash = null)
    {
        require_once('../View/header.php');
        require_once('../View/Campagne/index.php');
        require_once('../View/footer.php');
    }

    /**
     * Affiche le détail d'une offre d'emploi
     */
    public function displayGroupeAction()
    {
        require_once('../View/header.php');
        require_once('../View/Campagne/displayCampagne.php');
        require_once('../View/footer.php');

    }

}

