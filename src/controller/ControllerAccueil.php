<?php

require_once 'views/View.php';

class ControllerAccueil
{
    private $_articleManager;
    private $_view;

    public function __construct($url)
    {
        if (!isset($url)) {
            throw new \Exception(("Page introuvable"));
        }
        else {
            $this->articles();
        }
    }

    private function articles()
    {
        $this->_articleManager = new ArticleManager();
        $articles = $this->_articleManager->getArticles();
        // require_once("views/viewHeader.php");
        // require_once("views/viewAccueil.php");
        // require_once("views/viewFooter.php");
        $this->view = new View('accueil');
        $this->view->generate(array('articles' => $articles));
    }

}