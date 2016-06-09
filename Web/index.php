<?php

namespace nsNewsletter\Web;

use nsNewsletter\Autoloader;
use nsNewsletter\Controller\CampagneController;
use nsNewsletter\Controller\GroupeController;
use nsNewsletter\Controller\GroupeUserController;
use nsNewsletter\Controller\MailController;
use nsNewsletter\Controller\SecurityController;
use nsNewsletter\Controller\TemplateController;
use nsNewsletter\Controller\UserController;
use nsNewsletter\Controller\NewsletterController;
use nsNewsletter\Model\GroupeUserRepository;
use nsNewsletter\Model\Newsletter;
use nsNewsletter\Model\User;
use nsNewsletter\Model\Groupe;
use nsNewsletter\Model\Campagne;


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
$campagneController = new CampagneController();
$templateController = new TemplateController();
$groupeUserController = new GroupeUserController();

/***********
 * Routing *
 ***********/

/**
 * Traitement des formulaires
 */


//@todo décommenter pour l'authentification
 /* if (isset($_POST['formLogin_token'])){
    //var_dump("index traitement form : " );
    //var_dump($_POST['formLogin_token']);
    $securityController->handleFormLoginAction(); // Traite le formulaire et redirige vers la page d'accueil
}*/
/*
if (isset($_POST['formManageNewsletter'])){
   // var_dump("traitement form Modif News: " );
    $newsletterController->handleFormAddNewsletterAction(); // Traite le formulaire et redirige vers la page d'accueil
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
                    $userController->addUserAction();
                }elseif($urlAction == "importerCSV") {
                    $userController->handleFormUploadFileAction();
                }elseif($urlAction == "list") {
                    $userController->getUsersAction();
                }elseif($urlAction == "read") {
                    $id = $_GET['idUser'];
                    $userController->getUserByIdAction($id);
                } elseif ($urlAction == "update") {
                    $user = new User($_POST['idUser'], $_POST['nomUser'], $_POST['prenomUser'], $_POST['mailUser'], '', '', '');
                    $userController->updateUserAction($user);
                } elseif ($urlAction == "delete") {
                    $userController->deleteUserAction();
                }
            }else {
                $userController->displayUserAction();
            }
            break;

        case 'groupes':
            if (isset($_GET['action'])) {
                $urlAction = $_GET['action'];
                if ($urlAction == "create") {
                    $idGroupe = $groupeController->addGroupeAction();
                    if(!empty($_POST['idUsers'])){
                        $_POST['idGroupe'] = $idGroupe;
                        $groupeUserController->affecteUsersToGroupeAction();
                    }
                }elseif($urlAction == "read") {
                    $id = $_GET['idGroupe'];
                    $groupeController->getGroupeByIdAction($id);
                }elseif($urlAction == "list") {
                    $groupeController->getGroupesAction();
                }elseif ($urlAction == "update") {
                    $groupe = new Groupe($_POST['idGroupe'], $_POST['libelleGroupe'], '');
                    $groupeController->updateGroupeAction($groupe);
                    if(!empty($_POST['idUsers'])){
                        $groupeUserController->affecteUsersToGroupeAction();
                    }
                }elseif ($urlAction == "delete") {
                    $groupeController->deleteGroupeAction();
                }elseif ($urlAction == "affect") {
                    if(!empty($_POST['idUsers'])){
                        $_POST['idGroupe'] = $_POST['idGroupeAffect'];
                        $groupeUserController->affecteUsersToGroupeAction();
                    }
                }
            }else{
                $groupeController->displayGroupeAction();
            }
            break;

        case 'campagnes':
            if (isset($_GET['action'])) {
                $urlAction = $_GET['action'];
                if ($urlAction == "create") {
                    $campagneController->addCampagneAction();
                }elseif($urlAction == "affiche") {
                    $id = $_GET['idCampagne'];
                    $campagneController->getCampagneByIdAction($id);
                    $campagneController->afficheCampagneAction($id);
                }elseif($urlAction == "list") {
                    $campagneController->getCampagnesAction();
                }elseif ($urlAction == "update") {
                    $campagne= new Campagne($_POST['idCampagne'], $_POST['libelleCampagne'], $_POST['objetCampagne'], $_POST['idNewsletter'], $_POST['idGroupe'], $_POST['destinataire']);
                    $campagneController->updateCampagneAction($campagne);
                }elseif ($urlAction == "send") {
                    $params = array(
                       'idCampagne'=>$_POST['idCampagne'], 'libelleCampagne'=>$_POST['libelleCampagne'], 'objetCampagne'=>$_POST['objetCampagne'], 'idNewsletter'=>$_POST['idNewsletter'], 'idGroupe'=>$_POST['idGroupe'], 'destinataire'=>$_POST['destinataire']
                    );
                    //@todo insert new campagne
                    if(!empty($params['idNewsletter']) && (!empty($params['idGroupe']) || !empty($params['destinataire']))){
                        $campagneController->addCampagneAction();
                        $campagneController->sendCampagneAction($params);
                    }
                } elseif ($urlAction == "delete") {
                    $campagneController->deleteCampagneAction();
                }
            }else{
                $campagneController->displayCampagneAction();
            }
            break;

        case 'templates':
            if (isset($_GET['action'])) {
                $urlAction = $_GET['action'];
                if ($urlAction == "create") {
                } elseif ($urlAction == "list") {
                    $templateController->getTemplatesAction();
                } elseif ($urlAction == "update") {
                } elseif ($urlAction == "delete") {
                }
            }
            else{
                $templateController->displayTemplateAction();
            }
            break;

        case 'templatesManage':
            if (isset($_GET['action'])) {
                $urlAction = $_GET['action'];
                if ($urlAction == "create") {
                } elseif ($urlAction == "list") {
                    $templateController->displayTemplateManageAction();
                } elseif ($urlAction == "update") {
                } elseif ($urlAction == "delete") {
                }
            }
            else{
                $templateController->displayTemplateAction();
            }
            break;

        case 'newsletters':
            if (isset($_GET['action'])) {
                $urlAction = $_GET['action'];
                if ($urlAction == "create") {
                    $newsletterController->addNewsletterAction();
                } elseif ($urlAction == "list") {
                    $newsletterController->getNewslettersAction();
                } elseif ($urlAction == "read") {
                    $id = $_GET['idNewsletter'];
                    $newsletterController->getNewsletterByIdAction($id);
                } elseif ($urlAction == "update") {
                    $news = new Newsletter($_POST['idNewsletter'], $_POST['nomNewsletter'], $_POST['contenuNewsletter'], $_POST['lienNewsletter']);
                    $newsletterController->updateNewsletterAction($news);
                } elseif ($urlAction == "delete") {
                    $newsletterController->deleteNewsletterAction();
                }
            }
            else{
                $newsletterController->displayNewsletterAction();
            }
            break;

        case 'options':
            $securityController->displayOptionsAction();
            break;

        case 'Login':
            $securityController->displayLoginAction();
            break;

        case 'logout':
            /*if(session_id() !== ""){
                //session_start();

                session_unset(); // Unset all of the session variables.
                session_destroy();// Destroy the session.
            }

            //header('Location: index.php');
            $x = 'http://url.com/search/?location=london&page_number=1';

            $parsed = parse_url($x);
            $query = $parsed['query'];

            parse_str($query, $params);

            unset($params['page_number']);
            $string = http_build_query($params);
            var_dump($string);

            */
            $securityController->displayLogoutAction();
            //$groupeController->indexAction();
            break;

        default:
            header('Status: 301 Moved Permanently', false, 301); // Redirection vers l'acceuil -> mémorisé dans le cache du navigateur
            header('Location: index.php');
    }
} else {
   /* if(session_id()===""){
        session_start();
        //var_dump("index  : " );
        //var_dump($_SESSION['formLogin_token']);
    }*/
    if(isset($_SESSION['formLogin_token'])){
        session_start();
        //var_dump("formLogin_token  : " );
        //var_dump($_SESSION['formLogin_token']);
        $securityController->displayLoginAction();
    }else{
        // On affiche la page d'accueil
        $groupeController->indexAction();

    }
}

?>