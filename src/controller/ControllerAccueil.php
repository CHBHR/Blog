<?php

declare(strict_types=1);

require_once 'views/View.php';

class ControllerAccueil
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
            $this->generateView();
        }
    }

    private function generateView()
    {
        $this->_view = new View('Accueil');
        $this->_view->generatePage();
    }

}