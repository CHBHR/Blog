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
$router->get('/articles', 'App\Controllers\BlogController@index');
$router->get('/articles/:id', 'App\Controllers\BlogController@show');
/**
 * Les routes commentaire
 */
$router->post('/articles/submitComment', 'App\Controllers\BlogController@submitComment');

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
$router->get('/admin/articles', 'App\Controllers\Admin\ArticleController@listeArticle');
$router->get('/admin/articles/create', 'App\Controllers\Admin\ArticleController@create');
$router->post('/admin/articles/create', 'App\Controllers\Admin\ArticleController@createArticle');
$router->post('/admin/articles/delete/:id', 'App\Controllers\Admin\ArticleController@destroy');
$router->get('/admin/articles/edit/:id', 'App\Controllers\Admin\ArticleController@edit');
$router->post('/admin/articles/edit/:id', 'App\Controllers\Admin\ArticleController@update');
$router->get('/admin/articles/comment/:id', 'App\Controllers\Admin\CommentaireController@listeCommentaire');
$router->get('/admin/articles/comment/validate/:id', 'App\Controllers\Admin\CommentaireController@validerCommentaire');
$router->post('/admin/articles/comment/delete/:id', 'App\Controllers\Admin\CommentaireController@deleteCommentaire');

/**
 * Le téléchargement du pdf
 */
$router->get('/downloadpdf', 'App\Controllers\DownloadController@downloadpdf');

/**
 * Le formulaire de contact 
 */
$router->get('/contact', 'App\Controllers\ContactController@showContactForm');
$router->post('/contact', 'App\Controllers\ContactController@checkContactForm');

try {
    $router->run();
} catch (NotFoundException $e) {
    echo $e->error404();
}
