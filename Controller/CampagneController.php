<?php
/**
 * GroupeController.php
 */

namespace nsNewsletter\Controller;

use nsNewsletter\Model\Campagne;
use nsNewsletter\Model\CampagneRepository;
use nsNewsletter\Model\NewsletterRepository;


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
                'idNewsletter' => $campagne->getObjet(),
                'idGroupe' => $campagne->getObjet(),
                'userMail' => $campagne->getObjet(),
                'libelle' => $campagne->getLibelle(),
                'objet' => $campagne->getObjet(),
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

    public function addCampagneAction()
    {
        $repos = new CampagneRepository();
        $campagne = new Campagne('', $_POST['libelleCampagne'], $_POST['objetCampagne'], $_POST['idNewsletter'], $_POST['idGroupe'], $_POST['userMail']);

        $id = $repos->persist($campagne); // On persiste l'objet dans la base et on récupère son id

        $this->indexAction('<strong>Succès !</strong> Campagne créé.'); // Redirect to index
    }

    public function updateCampagneAction(Campagne $campagne)
    {
        $repos = new CampagneRepository();
        $id = $repos->update($campagne);

        // campagne($campagne->getCampagne(), "Confirmation de création", "Votre utilisateur a correctement été enregistrée !\nConsultez l'ensemble des campagnes via ce lien :\n" . PATH_TO_FRONT_CONTROLLER . "\nSupprimez un campagne via ce lien :\n" . PATH_TO_FRONT_CONTROLLER . "\n\nVous recevrez un campagne en cas de nouveau campagne.");

        $this->indexAction('<strong>Succès !</strong> Campagne mis à jour.'); // Redirect to index
    }

    public function deleteCampagneAction()
    {
        $repos = new CampagneRepository();
        $campagne = new Campagne($_POST['idCampagne'], $_POST['libelleCampagne'], $_POST['objetCampagne'], $_POST['idNewsletter'], $_POST['idGroupe'], $_POST['userMail']);

        $repos->remove($campagne); // On persiste l'objet dans la base et on récupère son id

        $this->indexAction('<strong>Succès !</strong> Campagne supprimé.'); // Redirect to index
    }

}

