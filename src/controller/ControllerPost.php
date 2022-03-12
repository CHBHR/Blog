<?php

declare(strict_types=1);

class ControllerPost
{
    private $_articleManager;
    private $_view;

    public function __construct()
    {
        if (isset($url) && count($url) < 1) {
            throw new \Exception(("Page introuvable"));
        }
        else {
            $this->article();
        }
    }

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
}