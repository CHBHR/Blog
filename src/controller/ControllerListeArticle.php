<?php

declare(strict_types=1);

require_once 'views/View.php';

class ControllerListeArticle
{
    private $_articleManager;
    private $_view;

    public function __construct($url)
    {
        if (!isset($url)) {
            throw new \Exception("Page introuvable");
        }
        else {
            $this->articles();
        }
    }

    private function articles()
    {
        $this->_articleManager = new ArticleManager();
        $articles = $this->_articleManager->getArticles();
        $this->_view = new View('listeArticle');
        $this->_view->generate(array('articles' => $articles));
    }

}