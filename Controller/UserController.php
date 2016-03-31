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
        $subject = "Confirmation de création";
        $message =  "Votre utilisateur a correctement été enregistrée !\nConsultez l'ensemble des mails via ce lien :\n" . PATH_TO_FRONT_CONTROLLER . "\nSupprimez un mail via ce lien :\n" . PATH_TO_FRONT_CONTROLLER . "\n\nVous recevrez un mail en cas de nouveau mail.";

        //$send = $this->sendMail($to_email, $from_email, $subject, $message);
        //$send = $this->send();
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

        // Envoie du mail sans header et tout car trop long pour l'exercice qui servira une fois -> SwiftMailer pour le futur
        //mail($user->getMail(), "Confirmation de création", "Votre utilisateur a correctement été enregistrée !\nConsultez l'ensemble des utilisateurs via ce lien :\n" . PATH_TO_FRONT_CONTROLLER . "\nSupprimez l'offre d'emploi et les candidature liées via ce lien :\n" . PATH_TO_FRONT_CONTROLLER . "\n\nVous recevrez un mail en cas de nouveau candidat.");

        $this->indexAction('<strong>Succès :</strong> les utilisateurs ont bien été créés.'); // Redirect to index
    }

    public function handleFormUploadFileAction()
    {
        $users = array();
        // check there are no errors
        if($_FILES['upload_file_csv']['error'] == 0){
            $name = $_FILES['upload_file_csv']['name'];
            $fileinfo = pathinfo($_FILES['upload_file_csv']['name']);
            $tmpName = $_FILES['upload_file_csv']['tmp_name'];

            // check the file is a csv
            if($fileinfo['extension'] == 'csv'){
                if(($handle = fopen($tmpName, 'r')) !== FALSE) {
                    // necessary if a large csv file
                    set_time_limit(0);

                    $row = 0;
                    while(($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                        // get the values from the csv
                        $users[$row] = $data[0];
                        // inc the row
                        $row++;
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

    public function sendMail($to, $from_user, $from_email,
        $subject = '(No subject)', $message = '')
    {
        $from_user = "=?UTF-8?B?".base64_encode($from_user)."?=";
        $subject = "=?UTF-8?B?".base64_encode($subject)."?=";

        $headers = "From: $from_user <$from_email>\r\n".
            "MIME-Version: 1.0" . "\r\n" .
            "Content-type: text/html; charset=UTF-8" . "\r\n";

        return mail($to, $subject, $message, $headers);
    }

    public function send(){
        $mail = 'mourad_bzd@hotmail.fr'; // Déclaration de l'adresse de destination.
        if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
        {
            $passage_ligne = "\r\n";
        }
        else
        {
            $passage_ligne = "\n";
        }
        //=====Déclaration des messages au format texte et au format HTML.
        $message_txt = "Salut à tous, voici un e-mail envoyé par un script PHP.";
        $message_html = "<html><head></head><body><b>Salut à tous</b>, voici un e-mail envoyé par un <i>script PHP</i>.</body></html>";
        //==========

        //=====Création de la boundary
        $boundary = "-----=".md5(rand());
        //==========

        //=====Définition du sujet.
        $sujet = "Hey mon ami !";
        //=========

        //=====Création du header de l'e-mail.
        $header = "From: \"Mourad Benzaid\"<".$mail.">".$passage_ligne;
        $header.= "Reply-to: \"Mourad Benzaid\" <".$mail.">".$passage_ligne;
        $header.= "MIME-Version: 1.0".$passage_ligne;
        $header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
        //==========

        //=====Création du message.
        $message = $passage_ligne."--".$boundary.$passage_ligne;
        //=====Ajout du message au format texte.
        $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
        $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
        $message.= $passage_ligne.$message_txt.$passage_ligne;
        //==========
        $message.= $passage_ligne."--".$boundary.$passage_ligne;
        //=====Ajout du message au format HTML
        $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
        $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
        $message.= $passage_ligne.$message_html.$passage_ligne;
        //==========
        $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
        $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
        //==========

        //=====Envoi de l'e-mail.
        return mail($mail,$sujet,$message,$header);
        //==========
    }

}

