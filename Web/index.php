<?php

namespace Newsletter\Web;

use Newsletter\Autoloader;
use Newsletter\Controller\GroupeController;
use Newsletter\Controller\MailController;
use Newsletter\Controller\UserController;

/**
 * Autoloading
 */
require_once('../Autoloader.php');
Autoloader::register();



$userController = new UserController();
$groupeController = new GroupeController();
$mailController = new MailController();

/***********
 * Routing *
 ***********/

/**
 * Traitement du formulaire de recherche
 */

// Formulaire ajout d'un utilisateur
if (isset($_POST['formAddUser'])) {
    $userController->handleFormUploadFileAction(); // Traite le formulaire et redirige vers la page d'accueil

}

if (isset($_POST['formAddGroupe'])) {
    $groupeController->handleFormAddAction(); // Traite le formulaire et redirige vers la page d'accueil

}
if (isset($_POST['formAddMail'])) {
    $mailController->handleFormAddAction(); // Traite le formulaire et redirige vers la page d'accueil

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

        case 'addmail':
            $mailController->displayMailAction();
            break;

        default:
            header('Status: 301 Moved Permanently', false, 301); // Redirection vers l'acceuil -> mémorisé dans le cache du navigateur
            header('Location: index.php');


    }
} else {
    // On affiche la page d'accueil
    $groupeController->indexAction();
}

?>