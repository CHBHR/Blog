<?php

use Router\Router;

require '../vendor/autoload.php';

define('VIEWS', dirname(__DIR__). DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
define('SCRIPT', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);

$router = new Router($_GET['url']);

$router->get('/', 'App\Controllers\BlogController@index');
$router->get('/post/:id', 'App\Controllers\BlogController@show');

$router->run();

// require_once("controller/Routeur.php");

// $routeur = new Routeur();

// $routeur->routeReq();
