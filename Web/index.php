<?php

namespace Newsletter\Web;

use Newsletter\Autoloader;
use Newsletter\Controller\GroupeController;
use Newsletter\Controller\UserController;

/**
 * Autoloading
 */
require_once('../Autoloader.php');
Autoloader::register();



$userController = new UserController();
$groupeController = new GroupeController();


/***********
 * Routing *
 ***********/

/**
 * Traitement du formulaire de recherche
 */

// Formulaire ajout d'un emploi
if (isset($_POST['formAddUser'])) {
    $userController->handleFormUploadFileAction(); // Traite le formulaire et redirige vers la page d'accueil
    $groupeController->handleFormUploadFileAction();

}
elseif (isset($_GET['page'])) {
    $url = $_GET['page'];

    switch ($url) {
        case 'adduser':
            $userController->displayUserAction();
            break;

        case 'addgroupe':
            $groupeController->displayGroupeAction();
            break;
        default:
            header('Status: 301 Moved Permanently', false, 301); // Redirection vers l'acceuil -> mémorisé dans le cache du navigateur
            header('Location: index.php');


    }
} else {
    // On affiche la page d'accueil
    $userController->indexAction();
}

?>