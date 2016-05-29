<?php
/**
 * TemplateController.php
 */

namespace nsNewsletter\Controller;

use nsNewsletter\Model\CampagneRepository;
use nsNewsletter\Model\TemplateRepository;


class TemplateController
{
    /**
     * Affiche la page d'accueil avec la liste des offres d'emploi
     *
     * @param String $flash Affiche un message de confirmation sur le haut de la page
     */
    public function indexAction($flash = null)
    {
        require_once('../View/header.php');
        require_once('../View/Template/index.php');
        require_once('../View/footer.php');
    }

    /**
     * Affiche le détail d'une offre d'emploi
     */
    public function displayTemplateAction()
    {
        $repo = new TemplateRepository();
        $newsletters = $repo->findAll();

        require_once('../View/header.php');
        require_once('../View/Template/displayTemplate.php');
        require_once('../View/footer.php');
    }

    public function displayTemplateManageAction()
    {
        $repo = new TemplateRepository();
        $newsletters = $repo->findAll();

        require_once('../View/header.php');
        require_once('../View/Template/addTemplateForm2.php.php');
        require_once('../View/footer.php');
    }

    public function getTemplateByIdAction($id)
    {
        $repos = new TemplateRepository();
        $news = $repos->find($id); // On persiste l'objet dans la base et on récupère son id

        return $news;
        //$this->indexAction(/*'<strong>Succès !</strong> Le mail a bien été créé.'*/); // Redirect to index
    }
    public function  getTemplatesAction()
    {
        $repos = new TemplateRepository();
        $newsletters = $repos->findAll();

        $json = array();
        foreach($newsletters as $newsletter){
            $array = array(
                'idTemplate' => $newsletter->getId(),
                'nom' => $newsletter->getNom(),
                'contenu' => $newsletter->getTexte(),
                'lien' => $newsletter->getLien()
            );
            array_push($json, $array);
        }

        echo json_encode($json);
    }

    public function updateTemplateAction(Template $news)
    {
        $repos = new TemplateRepository();
        $id = $repos->update($news); // On persiste l'objet dans la base et on récupère son id
        $this->indexAction('<strong>Succès !</strong> Template mise à jour.'); // Redirect to index
    }

    public function deleteTemplateAction()
    {
        $repos = new TemplateRepository();
        $news = new Template($_POST['idTemplate'], $_POST['nomTemplate'], $_POST['contenuTemplate'], $_POST['lienTemplate']);
        $repos->remove($news);

        $this->indexAction('<strong>Succès !</strong> Template supprimée.'); // Redirect to index
    }
}

