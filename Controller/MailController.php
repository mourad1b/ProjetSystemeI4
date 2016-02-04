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
    public function displayMailAction($flash = null)
    {
        $reposMail = new MailRepository();
        $mails = $reposMail->findAll();

        require_once('../View/header.php');
        require_once('../View/Mail/displayMail.php');
        //require_once('../View/User/index.php');
        require_once('../View/footer.php');

    }

    /**
     * Traite le formulaire de création d'un Groupe et persiste l'objet Groupe correspondant dans la base de données.
     *
     */

    public function handleFormManageMailAction()
    {
        $repos = new MailRepository();
        var_dump($_POST);

        $mail = new Mail('', $_POST['libelleMail'], $_POST['objetMail'], $_POST['corpsMail']);

        $id = $repos->persist($mail); // On persiste l'objet dans la base et on récupère son id

        $this->indexAction('<strong>Succès !</strong> Le mail a bien été créé.'); // Redirect to index
    }

    public function addMailAction()
    {
        $repos = new MailRepository();
        var_dump($_POST);

        $mail = new Mail('', $_POST['libelleMail'], $_POST['objetMail'], $_POST['corpsMail']);

        $id = $repos->persist($mail); // On persiste l'objet dans la base et on récupère son id

        $this->indexAction('<strong>Succès !</strong> Le mail a bien été créé.'); // Redirect to index
    }

    public function updateMailAction()
    {
        $repos = new MailRepository();
        $mail = new Mail('', $_POST['libelleMail'], $_POST['objetMail'], $_POST['corpsMail']);

        $id = $repos->update($mail); // On persiste l'objet dans la base et on récupère son id

        $this->indexAction('<strong>Succès !</strong> Le mail a bien été mis à jour.'); // Redirect to index
    }

    public function deleteMailByIdAction($id)
    {
        $repos = new MailRepository();
        //$mail = new Mail('', $_POST['libelleMail'], $_POST['objetMail'], $_POST['corpsMail']);

        $repos->remove($id); // On persiste l'objet dans la base et on récupère son id

        $this->indexAction('<strong>Succès !</strong> Le mail a bien été supprimé.'); // Redirect to index
    }

    public function deleteMail()
    {

        if(!empty($_POST['id_rep[]']))
        {
            echo 'Les valeurs des cases cochées sont :<br />';
            foreach($_POST['choix'] as $val)
            {
                echo $val,'<br />';
            }
            echo '<br /> Faire un autre test : <a href="checkbox3.php">Tester à nouveau</a>';
        }
        else{
            echo ' vide ';
        }
    }
}

