<?php

declare(strict_types=1);

require_once('./controller/Routeur.php');

function autoload($class_name) {
    require_once('classes/Route.php');
}

// require_once("controller/Routeur.php");

// $routeur = new Routeur();

// $routeur->routeReq();