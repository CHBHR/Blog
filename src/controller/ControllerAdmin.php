<?php

declare(strict_types=1);

require_once 'views/View.php';

class ControllerAdmin
{
    private $_view;

    public function __construct($url)
    {
        if($_SESSION['role'] != 'admin') {
            throw new \Exception("Vous n'avez pas les droits pour consulter cette page");
        } 
        else {
            "bienvenue";
        }
    }

}