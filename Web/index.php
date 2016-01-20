<?php

namespace Newsletter\Web;

use Newsletter\Autoloader;
use Newsletter\Controller\UserController;

/**
 * Autoloading
 */
require_once('../Autoloader.php');
Autoloader::register();


$userController = new UserController();


/***********
 * Routing *
 ***********/

/**
 * Traitement du formulaire de recherche
 */

// Formulaire ajout d'un emploi
if (isset($_POST['formAddUser'])) {
    $userController->handleFormUploadFileAction(); // Traite le formulaire et redirige vers la page d'accueil

}
elseif (isset($_GET['page'])) {
    $url = $_GET['page'];

    switch ($url) {
        case 'adduser':
            $userController->displayUserAction();
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