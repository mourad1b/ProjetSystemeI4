<?php
/**
 * EmploiController.php
 */

namespace Newsletter\Controller;

use Newsletter\Model\Job;
use Newsletter\Model\JobRepository;


class EmploiController
{
    /**
     * Affiche la page d'accueil avec la liste des offres d'emploi
     *
     * @param String $flash Affiche un message de confirmation sur le haut de la page
     */
    public function indexAction($flash = null)
    {
        $repos = new JobRepository();

        $jobs = $repos->findAllWithCount();

        require_once('../View/header.php');
        require_once('../View/Emploi/index.php');
        require_once('../View/footer.php');
    }

    /**
     * Affiche le détail d'une offre d'emploi
     */
    public function displayJobAction()
    {
        $reposJob = new JobRepository();
        $job = $reposJob->find($_GET['job_id']);

        require_once('../View/header.php');
        require_once('../View/Emploi/displayJob.php');
        require_once('../View/footer.php');

    }

    /**
     * Affiche le formulaire d'ajout d'une offre d'emploi
     */
    public function ajoutOffreAction()
    {
        require_once('../View/header.php');
        require_once('../View/Emploi/addJobForm.php');
        require_once('../View/footer.php');
    }

    /**
     * Supprime une offre d'emploi et redirige vers la page d'accueil
     */
    public function supprimerOffreAction()
    {
        $reposJob = new JobRepository();

        $job = $reposJob->find($_GET['emploi_id']);

        // On ralenti un éventuel bruteforce
        sleep(1);

        // Si le code ne correspond pas on termine
        if ($_GET['code'] !== $job->getCode()) {
            header('HTTP/1.0 403 Forbidden');
            exit('Mauvaise combinaison emploi / code. Ou l\'emploi n\'existe déjà plus');
        } else {
            // Sinon on procède à la suppression
            $repos = new JobRepository();
            $repos->removeJobCascade($job);

            $this->indexAction("L'offre d'emploi <strong>" . $job->getTitre() . "</strong> ainsi que les candidatures liées ont correctement été supprimée."); // Redirection sur la page d'acceuil
        }
    }

    /**
     * Traite le formulaire de création d'une offre d'emploi et persiste l'objet Job correspondant dans la base de données.
     * Informe par mail le créateur
     */
    public function handleFormAddAction()
    {
        $repos = new JobRepository();

        $job = new Job('', '', $_POST['titre'], $_POST['societe'], $_POST['email'], $_POST['departement'], $_POST['typecontrat'], $_POST['salaire'], $_POST['description'], '', 0);
        $job->setCodeAndDateAjout();

        // Validation dans les Getter et Setters de Job car une validation côté client est mise en place et si y'a bypass on joue sur les exit()

        $id = $repos->persist($job); // On persiste l'objet dans la base et on récupère son id

        $code = $job->getCode();

        // Envoie du mail sans header et tout car trop long pour l'exercice qui servira une fois -> SwiftMailer pour le futur
        mail($job->getEmail(), "Confirmation de création", "Votre offre d'emploi " . $job->getTitre() . " à correctement été enregistrée !\nConsultez l'ensemble des candidatures via ce lien :\n" . PATH_TO_FRONT_CONTROLLER . "?page=liste-candidature&emploi_id=$id&code=$code\nSupprimez l'offre d'emploi et les candidature liées via ce lien :\n" . PATH_TO_FRONT_CONTROLLER . "?page=supprimer-emploi&emploi_id=$id&code=$code\n\nVous recevrez un mail en cas de nouveau candidat.");


        $this->indexAction('<strong>Félicitation !</strong> Offre d&apos;emploie crée avec succès !'); // Redirect to index
    }

    /**
     * Effectue une recherche dans la base de données avec des critères
     */
    public function searchJob()
    {
        $repos = new JobRepository();
        $motscles = preg_replace("/[ ,-;]/","%",$_POST['keywords']); // Remplace les espaces, tirets et points virgules par des % pour le LIKE
        $jobs = $repos->searchJob($motscles,$_POST['typecontrat']);

        require_once('../View/header.php');
        require_once('../View/Emploi/index.php');
        require_once('../View/footer.php');
    }

}

