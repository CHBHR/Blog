<?php

declare(strict_types=1);

require_once __DIR__.'/../views/View.php';

class AccueilController
{
    private $_articleManager;
    private $_view;

    public function __construct($url)
    {
        if (!isset($url)) {
            throw new \Exception("Page introuvable");
            echo "page introuvable";
        }
        else {
            //$this->_view = new View('Accueil');
            echo"else";
            $this->generateView();
        }
    }

    private function generateView()
    {
        $this->_view = new View('Accueil');
        $this->_view->generatePage();
    }

}
echo"accueil";