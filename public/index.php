<?php

use Router\Router;
use App\Exceptions\NotFoundException;

require '../vendor/autoload.php';

define('VIEWS', dirname(__DIR__). DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
define('SCRIPT', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);

$router = new Router($_GET['url']);

/**
 * Les routes Article
 */
$router->get('/', 'App\Controllers\BlogController@welcome');
$router->get('/posts', 'App\Controllers\BlogController@index');
$router->get('/posts/:id', 'App\Controllers\BlogController@show');

/**
 * Les routes utilisateur
 */
$router->get('/login', 'App\Controllers\UserController@login');
$router->post('/login', 'App\Controllers\UserController@loginPost');
$router->get('/logout', 'App\Controllers\UserController@logout');
$router->get('/signup', 'App\Controllers\UserController@signup');
$router->post('/signin', 'App\Controllers\UserController@signin');

/**
 * Les routes admin
 */
$router->get('/admin/posts', 'App\Controllers\Admin\ArticleController@listeArticle');
$router->get('/admin/posts/create', 'App\Controllers\Admin\ArticleController@create');
$router->post('/admin/posts/create', 'App\Controllers\Admin\ArticleController@createArticle');
$router->post('/admin/posts/delete/:id', 'App\Controllers\Admin\ArticleController@destroy');
$router->get('/admin/posts/edit/:id', 'App\Controllers\Admin\ArticleController@edit');
$router->post('/admin/posts/edit/:id', 'App\Controllers\Admin\ArticleController@update');

/**
 * Le téléchargement du pdf
 */
$router->get('/downloadpdf', 'App\Controllers\DownloadController@downloadpdf');

try {
    $router->run();
} catch (NotFoundException $e) {
    echo $e->error404();
}
