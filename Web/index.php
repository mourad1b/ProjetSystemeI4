<?php

namespace nsNewsletter\Web;

use nsNewsletter\Autoloader;
use nsNewsletter\Controller\GroupeController;
use nsNewsletter\Controller\MailController;
use nsNewsletter\Controller\SecurityController;
use nsNewsletter\Controller\UserController;
use nsNewsletter\Controller\NewsletterController;

/**
 * Autoloading
 */
require_once('../Autoloader.php');
Autoloader::register();

$userController = new UserController();
$groupeController = new GroupeController();
$mailController = new MailController();
$securityController = new SecurityController();
$newsletterController = new NewsletterController();

/***********
 * Routing *
 ***********/

/**
 * Traitement des formulaires
 */


if (isset($_POST['formLogin_token'])){
    //var_dump("index traitement form : " );
    //var_dump($_POST['formLogin_token']);
    $securityController->handleFormLoginAction(); // Traite le formulaire et redirige vers la page d'accueil
}

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

        case 'campagnes':
            $mailController->displayMailAction();
            break;

        case 'newsletters':
            $newsletterController->displayNewsletterAction();
            break;

        case 'options':
            $securityController->displayOptionsAction();
            break;

        case 'Login':
            $securityController->displayLoginAction();
            break;

        case 'logout':
            $securityController->displayLogoutAction();
            //$groupeController->indexAction();
            break;

        default:
            header('Status: 301 Moved Permanently', false, 301); // Redirection vers l'acceuil -> mémorisé dans le cache du navigateur
            header('Location: index.php');
    }
} else {
    if(session_id()===""){
        session_start();
        //var_dump("index  : " );
        //var_dump($_SESSION['formLogin_token']);
    }
    if(isset($_SESSION['formLogin_token'])){
       // var_dump("formLogin_token  : " );
        //var_dump($_SESSION['formLogin_token']);
        $securityController->displayLoginAction();
    }else{
        // On affiche la page d'accueil
        $groupeController->indexAction();
    }
}

?>