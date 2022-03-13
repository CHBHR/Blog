<?php

declare(strict_types=1);

class ControllerPost
{
    private $_articleManager;
    private $_view;

    public function __construct()
    {
        if (isset($url) && count($url) < 1) {
            throw new \Exception("Page introuvable");
        }
        elseif (isset($_GET['create'])) {
            $this->create();
        }
        elseif (isset($_GET['status']) && isset($_GET['status']) == "new") {
            $this->store();
        }
        elseif (isset($_GET['action']) && isset($_GET['action']) == "delete" && isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->delete($id);
        }
        else {
            $this->article();
        }
    }

    //affiche un article
    private function article()
    {
        if (isset($_GET['id'])) {
            $this->_articleManager = new ArticleManager;
            $article = $this->_articleManager->getArticle($_GET['id']);
            $this->_view = new View('singlePost');
            $this->_view->generate(array('article' => $article));
        } else {
            echo "aucun article trouvé";
        }
    }

    //affiche le formulaire de création d'un article
    private function create()
    {
        if (isset($_GET['create'])) {
            $this->_view = new View('CreatePost');
            $this->_view->generatePage();
        } else {
            echo "le formulaire n'a pas été trouvé";
        }
    }

    //insérer un article en base de donnée
    private function store()
    {
        $this->_articleManager = new ArticleManager;
        $this->_articleManager->createArticle();
        $this->_view = new View('accueil');
        $this->_view->generatePage();
    }

    private function delete($id)
    {
        $this->_articleManager = new ArticleManager;
        $this->_articleManager->deleteArticle($id);
        $this->_view = new View('accueil');
        $this->_view->generatePage();
    }

}