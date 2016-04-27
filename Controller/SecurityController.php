<?php
/**
 * SecurityController.php
 */

namespace nsNewsletter\Controller;

use nsNewsletter\Model\User;
use nsNewsletter\Model\UserRepository;
use nsNewsletter\Model\Groupe;
use nsNewsletter\Model\GroupeRepository;


class SecurityController
{
    /**
     * Affiche la page d'accueil avec la liste des offres d'emploi
     *
     * @param String $flash Affiche un message de confirmation sur le haut de la page
     */
    public function indexAction($flash = null)
    {
        $reposGroupe = new GroupeRepository();
        $groupes = $reposGroupe->findAllWithCount();

        $reposUser = new UserRepository();
        $users = $reposUser->findUsersInGroupeUser();

        require_once('../View/header.php');
        require_once('../View/Groupe/index.php');
        require_once('../View/footer.php');
    }

    /**
     * Affiche le détail d'une offre d'emploi
     */
    public function displayLoginAction()
    {
        require_once('../View/header.php');
        require_once('../View/Security/login.php');
        require_once('../View/footer.php');

    }

    public function displayOptionsAction()
    {
        require_once('../View/header.php');
        require_once('../View/Security/options.php');
        require_once('../View/footer.php');

    }

    /**
     * Traite le formulaire de création d'une offre d'emploi et persiste l'objet Job correspondant dans la base de données.
     * Informe par mail le créateur
     */
    public function handleFormLoginAction()
    {
        /*** begin our session ***/

        if(session_id() === ""){
            session_start();
            //var_dump("handle  : " );
            //var_dump($_POST['formLogin_token']);
        }

        /*if(is_array($where)){
            $condition = "";
        }
        */
        /*** begin our session ***/
        //session_start();

        /*** first check that both the username, password and form token have been sent ***/
        if(!isset( $_POST['_username'], $_POST['_password'], $_POST['formLogin_token']))
        {
            $message = 'Veuillez un identifiant et un mot de passe valides';
        }
        /*** check the form token is valid ***/
        elseif( $_POST['formLogin_token'] != $_POST['formLogin_token'])
        {
            $message = 'Soummission non valide';
        }
        /*** check the username is the correct length ***/
        elseif (strlen( $_POST['_username']) > 20 || strlen($_POST['_username']) < 4)
        {
            $message = 'Longueur identifiant invalide';
        }
        /*** check the password is the correct length ***/
        elseif (strlen( $_POST['_password']) > 20 || strlen($_POST['_password']) < 4)
        {
            $message = 'Longueur mot de passe invalide';
        }
        //check the username has only alpha numeric characters
        /*elseif (ctype_alnum($_POST['_username']) != true)
        {
            //if there is no match
            $message = "L'identifiant doit être alphanumérique";
        }
        // check the password has only alpha numeric characters
        elseif (ctype_alnum($_POST['_password']) != true)
        {
            //if there is no match
            $message = "Le mot de passe doit être alphanumérique";
        }*/else {
            try {

                /*** if we are here the data is valid and we can insert it into database ***/
                $_username = filter_var($_POST['_username'], FILTER_SANITIZE_STRING);
                $_password = filter_var($_POST['_password'], FILTER_SANITIZE_STRING);

                $where = array(
                    "_username" => $_username,
                    "_password" => $_password
                );

                $repos = new UserRepository();
                $userLogged = $repos->findWhere($where);


                var_dump("userLogged");
                var_dump($userLogged);

                /*** unset the form token session variable ***/
                unset($_SESSION['formLogin_token']);

                /*** if all is done, say thanks ***/
                $message = 'Félicitations, vous êtes correctement authentifié';
            } catch (Exception $e) {
                echo ('Erreur de vérification des données');

            }
        }
        return $this->indexAction($message); // Redirect to index
    }

    public function displayLogoutAction()
    {
        require_once('../View/header.php');
        require_once('../View/Security/logout.php');
        require_once('../View/footer.php');


        // Begin the session
        /*if(session_id() === ""){
            session_start();
        }*/
// Unset all of the session variables.
        session_unset();

// Destroy the session.
        session_destroy();

        $this->indexAction('<strong>Déconnecté !</strong>'); // Redirect to index
    }



}

