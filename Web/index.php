<?php

namespace nsNewsletter\Web;

use nsNewsletter\Autoloader;
use nsNewsletter\Controller\GroupeController;
use nsNewsletter\Controller\MailController;
use nsNewsletter\Controller\SecurityController;
use nsNewsletter\Controller\UserController;
use nsNewsletter\Controller\NewsletterController;
use nsNewsletter\Model\Mail;
use nsNewsletter\Model\User;
use nsNewsletter\Model\Groupe;

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
/*
if (isset($_POST['formManageNewsletter'])){
   // var_dump("traitement form Modif News: " );
    $newsletterController->handleFormAddNewsletterAction(); // Traite le formulaire et redirige vers la page d'accueil
}

// Formulaire ajout d'un utilisateur
if (isset($_POST['formAddUser'])) {
    $userController->handleFormUploadFileAction(); // Traite le formulaire et redirige vers la page d'accueil
}

if (isset($_POST['formAddGroupe'])) {
    $groupeController->handleFormAddAction(); // Traite le formulaire et redirige vers la page d'accueil

}
if (isset($_POST['formAddMail'])) {
    $mailController->addMailAction(); // Traite le formulaire et redirige vers la page d'accueil
}

if (isset($_POST['formUpdateMail'])) {
    $id = $_GET['idMail'];
    $post = $_POST;
    return $mailController->updateMailAction($id); // Traite le formulaire et redirige vers la page d'accueil
}
if (isset($_POST['formDeleteMail'])) {
    $mailController->deleteMailAction(); // Traite le formulaire et redirige vers la page d'accueil
}
*/

if (isset($_GET['page'])) {
    $urlPage = $_GET['page'];
    $urlAction = null;
    switch ($urlPage) {
        case 'users':
            if (isset($_GET['action'])) {
                $urlAction = $_GET['action'];
                if ($urlAction == "create") {
                }elseif($urlAction == "list") {
                    $userController->getUsersAction();
                }elseif($urlAction == "read") {
                    $id = $_GET['idUser'];
                } elseif ($urlAction == "update") {
                    $user = new User($_POST['idMail'], $_POST['nomUser'], $_POST['prenomUser'], $_POST['mailUser'], array(), array(), array());
                    $userController->updateUserAction($user);
                } elseif ($urlAction == "delete") {
                }
            }else {
                $userController->displayUserAction();
            }
            break;

        case 'groupes':
            if (isset($_GET['action'])) {
                $urlAction = $_GET['action'];

                if ($urlAction == "create") {
                    $groupeController->addGroupeAction();
                }elseif($urlAction == "read") {
                    $id = $_GET['idGroupe'];
                    $groupeController->getGroupeByIdAction($id);
                }elseif($urlAction == "list") {
                    $groupeController->getGroupesAction();
                }elseif ($urlAction == "update") {
                    $groupe = new Groupe($_POST['idGroupe'], $_POST['libelleGroupe'], array());
                    $groupeController->updateGroupeAction($groupe);
                } elseif ($urlAction == "delete") {
                    $groupeController->deleteGroupeAction();
                }
            }else{
                $groupeController->displayGroupeAction();
            }
            break;

        case 'mails':
            if (isset($_GET['action'])) {
                $urlAction = $_GET['action'];

                if ($urlAction == "create") {
                    $mailController->addMailAction();
                }elseif($urlAction == "read") {
                    $id = $_GET['idMail'];
                    $mailController->getMailByIdAction($id);
                }elseif($urlAction == "list") {
                    $mailController->getMailsAction();
                }elseif ($urlAction == "update") {
                    $mail = new Mail($_POST['idMail'], $_POST['libelle'], $_POST['objet'], $_POST['corps']);
                    $mailController->updateMailAction($mail);
                } elseif ($urlAction == "delete") {
                    $mailController->deleteMailAction();
                }
            }else{
                $mailController->displayMailAction();
            }
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