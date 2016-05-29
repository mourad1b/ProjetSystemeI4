<?php
/**
 * UserController.php
 */

namespace nsNewsletter\Controller;

use nsNewsletter\Model\User;
use nsNewsletter\Model\UserRepository;
use nsNewsletter\Model\Groupe;
use nsNewsletter\Model\GroupeRepository;


class UserController
{
    /**
     * Affiche la page d'accueil avec la liste des offres d'emploi
     *
     * @param String $flash Affiche un message de confirmation sur le haut de la page
     */
    public function indexAction($flash = null)
    {
        //$reposUser = new UserRepository();
        //$users = $reposUser->findUsersInGroupeUser();

        require_once('../View/header.php');
        require_once('../View/User/index.php');
        require_once('../View/footer.php');
    }

    /**
     * Affiche le détail d'une offre d'emploi
     */
    public function displayUserAction()
    {
        $reposUser = new UserRepository();
        $users = $reposUser->findAll();

        require_once('../View/header.php');
        require_once('../View/User/displayUser.php');
        require_once('../View/footer.php');
    }

    public function getUserByIdAction($id)
    {
        $repos = new UserRepository();
        $user = $repos->find($id); // On persiste l'objet dans la base et on récupère son id

        return $user;
        //$this->indexAction(/*'<strong>Succès !</strong> Le mail a bien été créé.'*/); // Redirect to index
    }

    public function getUsersAction()
    {
        $reposUser = new UserRepository();
        $users = $reposUser->findAll();

        $json = array();
        $array =array();
        foreach($users as $user){
            $array = array(
                'idUser' => $user->getId(),
                'nom' => $user->getNom(),
                'prenom' => $user->getPrenom(),
                'mail' => $user->getMail()
                //'tel' => $user->getTelephone()
            );
            array_push($json, $array);
        }

        echo json_encode($json);
    }

    public function addUserAction()
    {
        $repos = new UserRepository();
        $user = new User('', $_POST['nomUser'], $_POST['prenomUser'], $_POST['mailUser'], '', '', '');

        $id = $repos->persist($user); // On persiste l'objet dans la base et on récupère son id

        $this->indexAction('<strong>Succès !</strong> Utilisateur créé.'); // Redirect to index
    }

    public function updateUserAction(User $user)
    {
        $repos = new UserRepository();
        $id = $repos->update($user); // On persiste l'objet dans la base et on récupère son id

        $to_email = $user->getMail();
        $from_email = $user->getMail();
        //$subject = "Confirmation de création";
        //$message =  "Votre utilisateur a correctement été enregistrée !\nConsultez l'ensemble des mails via ce lien :\n" . PATH_TO_FRONT_CONTROLLER . "\nSupprimez un mail via ce lien :\n" . PATH_TO_FRONT_CONTROLLER . "\n\nVous recevrez un mail en cas de nouveau mail.";
        $subject = "Un petit coucou";
        $message =  "Coucou, Un petit coucou depuis mon appli ;-)";

        /*$mail = new MailSenderController();
        $mail->send($to_email, $subject, $message, array());
        */

        $this->indexAction('<strong>Succès !</strong> Utilisateur mis à jour.'); // Redirect to index
    }

    public function deleteUserAction()
    {
        $repos = new UserRepository();
        $user = new User($_POST['idUser'], $_POST['nomUser'], $_POST['prenomUser'], $_POST['mailUser'], '', '','');
        $repos->remove($user);

        $this->indexAction('<strong>Succès !</strong> User supprimé.'); // Redirect to index
    }

    /**
     * Traite le formulaire de création d'une offre d'emploi et persiste l'objet Job correspondant dans la base de données.
     * Informe par mail le créateur
     */
    public function handleFormAddAction()
    {
        $repos = new UserRepository();

        $user = new User('', $_POST['nom'], $_POST['prenom'], $_POST['mail'], '', '', '');
        $id = $repos->persist($user); // On persiste l'objet dans la base et on récupère son id

        $this->indexAction('<strong>Succès :</strong> les utilisateurs ont bien été créés.'); // Redirect to index
    }

    public function handleFormUploadFileAction()
    {
        $users = array();
        // check there are no errors
        if($_FILES['file']['error'] == 0){
            $name = $_FILES['file']['name'];
            $fileinfo = pathinfo($_FILES['file']['name']);
            $tmpName = $_FILES['file']['tmp_name'];

            // check the file is a csv
            if($fileinfo['extension'] == 'csv'){
                if(($handle = fopen($tmpName, 'r')) !== FALSE) {
                    // necessary if a large csv file
                    set_time_limit(0);

                    $row = 0;
                    while(($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                        $users[$row] = $data[0];
                        // inc the row
                        $row++;
                        // get the values from the csv
                    }
                    fclose($handle);
                }
            }
        }

        if(!empty($users)){

            $aUsers = array();
            foreach ($users as $key => $value) {
                $aUsers[] = explode(";", $value);
            }

            $reposUser = new UserRepository();

            try{
                foreach ($aUsers as $userKey => $userVal) {
                    $user = new User('', $userVal[0], $userVal[1], $userVal[2], $userVal[3], $userVal[4], array(), array());
                    $id = $reposUser->persist($user); // On persiste l'objet dans la base et on récupère son id
                }
            }catch (\Exception $e){
                echo "erreur parse CSV";
            }

            $this->indexAction('<strong>Succès :</strong> les utilisateurs ont bien été créés.'); // Redirect to index

        }
    }

}

