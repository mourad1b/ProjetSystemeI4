<?php
/**
 * UserController.php
 */

namespace Newsletter\Controller;

use Newsletter\Model\User;
use Newsletter\Model\UserRepository;


class UserController
{
    /**
     * Affiche la page d'accueil avec la liste des offres d'emploi
     *
     * @param String $flash Affiche un message de confirmation sur le haut de la page
     */
    public function indexAction($flash = null)
    {
        $reposUser = new UserRepository();

        $users = $reposUser->findAll();


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
        //$user = $reposUser->find($_GET['id_user']);

        require_once('../View/header.php');
        require_once('../View/User/displayUser.php');
        require_once('../View/footer.php');

    }

    /**
     * Affiche le formulaire d'ajout d'une offre d'emploi
     */
    public function ajoutOffreAction()
    {
        require_once('../View/header.php');
        require_once('../View/User/addUserForm.php');
        require_once('../View/footer.php');
    }


    /**
     * Traite le formulaire de création d'une offre d'emploi et persiste l'objet Job correspondant dans la base de données.
     * Informe par mail le créateur
     */
    public function handleFormAddAction()
    {
        $repos = new UserRepository();

        $user = new User('', '', $_POST['nom'], $_POST['prenom'], $_POST['mail']);
        //$user->setCodeAndDateAjout();

        // Validation dans les Getter et Setters de Job car une validation côté client est mise en place et si y'a bypass on joue sur les exit()

        $id = $repos->persist($user); // On persiste l'objet dans la base et on récupère son id

       // $code = $user->getCode();

        // Envoie du mail sans header et tout car trop long pour l'exercice qui servira une fois -> SwiftMailer pour le futur
        //mail($user->getEmail(), "Confirmation de création", "Votre offre d'emploi à correctement été enregistrée !\nConsultez l'ensemble des candidatures via ce lien :\n" . PATH_TO_FRONT_CONTROLLER . "\nSupprimez l'offre d'emploi et les candidature liées via ce lien :\n" . PATH_TO_FRONT_CONTROLLER . "\n\nVous recevrez un mail en cas de nouveau candidat.");


        $this->indexAction('<strong>Félicitation !</strong> Les utilisateurs sont créés avec succès !'); // Redirect to index
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
                    $user = new User('', $userVal[0], $userVal[1], $userVal[2]);
                    $id = $reposUser->persist($user); // On persiste l'objet dans la base et on récupère son id
                }
            }catch (\Exception $e){
                echo "erreur parse CSV";
            }

            $this->indexAction('<strong>Félicitations !</strong> Les utilisateurs ont été ajoutés à la base avec succès !'); // Redirect to index

        }
    }


    /**
     * Effectue une recherche dans la base de données avec des critères
     */
    public function searchJob()
    {
        $reposUser = new JobRepository();
        $motscles = preg_replace("/[ ,-;]/","%",$_POST['keywords']); // Remplace les espaces, tirets et points virgules par des % pour le LIKE
        $users = $reposUser->searchJob($motscles,$_POST['typecontrat']);

        require_once('../View/header.php');
        require_once('../View/User/index.php');
        require_once('../View/footer.php');
    }

}

