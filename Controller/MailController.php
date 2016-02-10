<?php
/**
 * mailController.php
 */

namespace nsNewsletter\Controller;

use nsNewsletter\Model\Mail;
use nsNewsletter\Model\MailRepository;


class MailController
{
    /**
     * Affiche la page d'accueil avec la liste des mails
     *
     * @param String $flash Affiche un message de confirmation sur le haut de la page
     */
    public function indexAction($flash = null)
    {
        $reposMail = new MailRepository();
        $mails = $reposMail->findAll();

        require_once('../View/header.php');
        require_once('../View/Mail/index.php');
        require_once('../View/footer.php');
    }

    /**
     * Affiche le détail d'une offre d'emploi
     */
    public function displayMailAction()
    {
        $reposMail = new MailRepository();
        $mails = $reposMail->findAll();

        require_once('../View/header.php');
        require_once('../View/Mail/displayMail.php');
        require_once('../View/footer.php');

    }

    /**
     * Traite le formulaire de création d'un Groupe et persiste l'objet Groupe correspondant dans la base de données.
     *
     */

    public function handleFormManageMailAction()
    {
        $repos = new MailRepository();
        $mail = new Mail('', $_POST['libelle'], $_POST['objet'], $_POST['corps']);

        $id = $repos->find($mail); // On persiste l'objet dans la base et on récupère son id

        $this->indexAction('<strong>Succès !</strong> Le mail a bien été créé.'); // Redirect to index
    }

    public function getMailsAction()
    {
        $repos = new MailRepository();
        $mails = $repos->findAll();

        $json = array();
        foreach($mails as $mail){
            $array = array(
                'idMail' => $mail->getId(),
                'libelle' => $mail->getLibelle(),
                'objet' => $mail->getObjet(),
                'corps' => $mail->getBody()
            );
            array_push($json, $array);
        }

        echo json_encode($json);
    }

    public function getMailByIdAction($id)
    {
        $repos = new MailRepository();
        //$mail = new Mail($_POST['idMail'], $_POST['libelleMail'], $_POST['objetMail'], $_POST['corpsMail']);

        $mail = $repos->find($id); // On persiste l'objet dans la base et on récupère son id

        return $mail;
        //$this->indexAction(/*'<strong>Succès !</strong> Le mail a bien été créé.'*/); // Redirect to index
    }

    public function addMailAction()
    {
        $repos = new MailRepository();
        $post = $_POST;
        $mail = new Mail('', $_POST['libelle'], $_POST['objet'], $_POST['corps']);

        $id = $repos->persist($mail); // On persiste l'objet dans la base et on récupère son id

        $this->indexAction('<strong>Succès !</strong> Mail créé.'); // Redirect to index
    }

    public function updateMailAction($mail)
    {
        $repos = new MailRepository();
        $post = $_POST;
        //$mail = new Mail($_POST['idMail'], $_POST['libelleMail'], $_POST['objetMail'], $_POST['corpsMail']);

        $id = $repos->update($mail); // On persiste l'objet dans la base et on récupère son id

        $this->indexAction('<strong>Succès !</strong> Mail mis à jour.'); // Redirect to index
    }

    public function deleteMailAction()
    {
        $repos = new MailRepository();
        $mail = new Mail($_GET['idMail'], $_POST['libelle'], $_POST['objet'], $_POST['corps']);

        $repos->remove($mail); // On persiste l'objet dans la base et on récupère son id

        $this->indexAction('<strong>Succès !</strong> Mail supprimé.'); // Redirect to index
    }
}

