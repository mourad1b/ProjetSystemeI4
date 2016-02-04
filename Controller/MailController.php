<?php
/**
 * mailController.php
 */

namespace nsNewsletter\Controller;

use nsNewsletter\Model\Groupe;
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
        //require_once('../View/User/index.php');
        require_once('../View/footer.php');

    }

    /**
     * Traite le formulaire de création d'un Groupe et persiste l'objet Groupe correspondant dans la base de données.
     *
     */
    public function handleFormAddAction()
    {
        $repos = new MailRepository();

        $groupe = new Mail('', $_POST['libelle']);

        $id = $repos->persist($groupe); // On persiste l'objet dans la base et on récupère son id

        $this->indexAction('<strong>Félicitations !</strong> Le Groupe est créé avec succès !'); // Redirect to index
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

