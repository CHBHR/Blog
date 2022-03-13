<?php

declare(strict_types=1);

class ControllerUpdate
{
    private $_articleManager;
    private $_view;

    public function __construct()
    {
        if (isset($_POST['updateButton']) && isset($_GET['id'])) {
            $this->updateForm($_GET['id']);
        }else if (isset($_POST['formUpdateArticle'])) {
            $id = $_GET['id'];
            $this->update($id);
        } else {
            throw new \Exception(("Page introuvable"));
        }
    }

    private function updateForm($id)
    {
        $this->_articleManager = new ArticleManager();
        $article = $this->_articleManager->getArticle($id);
        $this->_view = new View('UpdatePost');
        $this->_view->generate(array('article' => $article));
    }

    private function update($id)
    {
        $this->_articleManager = new ArticleManager;
        $this->_articleManager->updateArticle($id);
        $this->_view = new View('accueil');
        $this->_view->generatePage();
    }

}