<?php

use Router\Router;
use App\Exceptions\NotFoundException;

require '../vendor/autoload.php';

define('VIEWS', dirname(__DIR__). DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
define('SCRIPT', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);

$router = new Router($_GET['url']);

$router->get('/', 'App\Controllers\BlogController@welcome');
$router->get('/posts', 'App\Controllers\BlogController@index');
$router->get('/posts/:id', 'App\Controllers\BlogController@show');

$router->get('/admin/posts', 'App\Controllers\Admin\ArticleController@listeArticle');
$router->post('/admin/posts/delete/:id', 'App\Controllers\Admin\ArticleController@destroy');

try {
    $router->run();
} catch (NotFoundException $e) {
    echo $e->error404();
}
