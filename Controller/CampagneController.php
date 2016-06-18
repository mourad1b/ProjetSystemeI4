<?php
/**
 * GroupeController.php
 */

namespace nsNewsletter\Controller;

use nsNewsletter\Model\Campagne;
use nsNewsletter\Model\CampagneRepository;
use nsNewsletter\Model\NewsletterRepository;
use nsNewsletter\Model\GroupeUserRepository;
use nsNewsletter\Model\UserRepository;


class CampagneController
{
    /**
     * Affiche la page d'accueil avec la liste des offres d'emploi
     *
     * @param String $flash Affiche un message de confirmation sur le haut de la page
     */
    public function indexAction($flash = null)
    {
        $reposCampagne = new CampagneRepository();
        $campagnes = $reposCampagne->findAll();

        require_once('../View/header.php');
        require_once('../View/Campagne/index.php');
        require_once('../View/footer.php');
    }

    /**
     * Affiche le détail d'une campagne
     */
    public function displayCampagneAction()
    {
        $reposCampagne = new CampagneRepository();
        $campagnes = $reposCampagne->findAll();

        require_once('../View/header.php');
        require_once('../View/Campagne/displayCampagne.php');
        require_once('../View/footer.php');

    }

    public function afficheCampagneAction($id)
    {
        $reposCamp = new CampagneRepository();
        $campagne = $reposCamp->find($id);

        $reposNews = new NewsletterRepository();
        $newsletter = $reposNews->find($campagne->getIdNewsletter());

        require_once('../View/Campagne/afficheCampagne.php');
    }


    /**
     * Traite le formulaire de création d'un Groupe et persiste l'objet Groupe correspondant dans la base de données.
     *
     */

    public function handleFormManageCampagneAction()
    {
        $repos = new CampagneRepository();
        $campagne = new Campagne('', $_POST['libelleCampagne'], $_POST['objetCampagne'], $_POST['idNewsletter'], $_POST['idGroupe'], $_POST['userMail']);

        $id = $repos->find($campagne); // On persiste l'objet dans la base et on récupère son id

        $this->indexAction('<strong>Succès !</strong> La campagne a bien été créé.'); // Redirect to index
    }

    public function getCampagnesAction()
    {
        $repos = new CampagneRepository();
        $campagnes = $repos->findAll();

        $json = array();
        foreach($campagnes as $campagne){
            $array = array(
                'idCampagne' => $campagne->getId(),
                'libelle' => $campagne->getLibelle(),
                'objet' => $campagne->getObjet(),
                'idNewsletter' => $campagne->getIdNewsletter(),
                'idGroupe' => $campagne->getIdGroupe(),
                'destinataire' => $campagne->getMailUser(),
            );
            array_push($json, $array);
        }

        echo json_encode($json);
    }

    public function getCampagneByIdAction($id)
    {
        $repos = new CampagneRepository();
        $campagne = $repos->find($id); // On persiste l'objet dans la base et on récupère son id

        return $campagne;
    }

    public function sendCampagneAction($params)
    {

        $idCampagne = $params['idSelectedCampagne'];
        $libelle = $params['libelleCampagne'];
        $objet = $params['objetCampagne'];
        $destinataire = $params['destinataire'];
        $idNewsletter = $params['idNewsletter'];
        $idGroupe = $params['idGroupe'];

        $groupeusers = array();
        $users = array();
        $news = array();
        $newsletterContent = array();

        // erreur
        if(!empty($idNewsletter)) {
            $repoNews = new NewsletterRepository();
            $news = $repoNews->find($idNewsletter);
            $newsletterContent = $news->getTexte();
        }
        if(!empty($idGroupe)) {
            $repoGU = new GroupeUserRepository();
            $groupeusers = $repoGU->findUsersByIdGroupe($idGroupe);

            $repoUser = new UserRepository();
            foreach($groupeusers as $groupeuser){
                $rows[] = $repoUser->find($groupeuser->getIdUser());
            }

            if (!empty($rows) ){
                foreach($rows as $row){
                    $users[]= $row->getMail();
                }
            }
        }


        $params['users'] = $users;

        $repoMS = new MailSenderController();
        $mailSend = $repoMS->send($objet, $newsletterContent, $destinataire, $params);

        $this->indexAction('<strong>Succès !</strong> Campagne mis à jour.'); // Redirect to index
    }

    public function addCampagneAction()
    {
        $repos = new CampagneRepository();
        if(!empty($_POST['idSelectedCampagne'])){
            $libelleCampagne = $repos->find($_POST['idSelectedCampagne'])->getLibelle();
            $campagne = new Campagne('', $libelleCampagne, $_POST['objetCampagne'], $_POST['idNewsletter'], $_POST['idGroupe'], $_POST['destinataire']);
        }else{
            //$campagne= new Campagne($_POST['idCampagne'], $_POST['libelleCampagne'], $_POST['objetCampagne'], $_POST['idNewsletter'], $_POST['idGroupe'], $_POST['destinataire']);
            $campagne = new Campagne('', $_POST['libelleCampagne'], $_POST['objetCampagne'], $_POST['idNewsletter'], $_POST['idGroupe'], $_POST['destinataire']);
        }


        $id = $repos->persist($campagne); // On persiste l'objet dans la base et on récupère son id

        $this->indexAction('<strong>Succès !</strong> Campagne créé.'); // Redirect to index
    }

    public function updateCampagneAction(Campagne $campagne)
    {
        $repos = new CampagneRepository();
        /*if(!empty($_POST['idSelectedCampagne'])){
            $libelleCampagne = $repos->find($_POST['idSelectedCampagne']);
            $campagne = new Campagne($_POST['idSelectedCampagne'], $libelleCampagne->getLibelle(), $_POST['objetCampagne'], $_POST['idNewsletter'], $_POST['idGroupe'], $_POST['destinataire']);
        }else{

        }*/
            //$campagne= new Campagne($_POST['idCampagne'], $_POST['libelleCampagne'], $_POST['objetCampagne'], $_POST['idNewsletter'], $_POST['idGroupe'], $_POST['destinataire']);
        //}

        $id = $repos->update($campagne);

        // campagne($campagne->getCampagne(), "Confirmation de création", "Votre utilisateur a correctement été enregistrée !\nConsultez l'ensemble des campagnes via ce lien :\n" . PATH_TO_FRONT_CONTROLLER . "\nSupprimez un campagne via ce lien :\n" . PATH_TO_FRONT_CONTROLLER . "\n\nVous recevrez un campagne en cas de nouveau campagne.");

        $this->indexAction('<strong>Succès !</strong> Campagne mis à jour.'); // Redirect to index
    }

    public function deleteCampagneAction()
    {
        //@todo delete campagne cascade remove id newsletter
        $repos = new CampagneRepository();
        $campagne = new Campagne($_POST['idCampagne'], $_POST['libelleCampagne'], $_POST['objetCampagne'], $_POST['idTemplate'], $_POST['idGroupe'], $_POST['destinataire']);

        $repos->remove($campagne); // On persiste l'objet dans la base et on récupère son id

        $this->indexAction('<strong>Succès !</strong> Campagne supprimé.'); // Redirect to index
    }

}

