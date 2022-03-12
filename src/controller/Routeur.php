<?php

declare(strict_types=1);

require_once 'views/View.php';

class Routeur
{

    private $ctrl;
    private $_view;

    public function routeReq(){

        try {

            //chargement automatique des classes du dossier model
            spl_autoload_register(function($class){
                require_once('model/'.$class.'.php');
            });

            //creation de la variable url
            $url = '';

            //determine le controller en fonction de la valeur de cette variable
            if (isset($_GET['url'])){
                //on décompose l'url et on lui applique un filtre
                $url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));

                //prend le premier parametre de l'url et le convertis
                $controller = ucfirst(strtolower($url[0]));

                //
                $controllerClass = "Controller".$controller;

                //on retrouve le chemin du controller voulu
                $controllerFile = "controller/".$controllerClass.".php";

                //check si le fichier du controller existe
                if (file_exists($controllerFile)){
                    //on lance la classe en question avec tous les param url pour respecter l'encapsulation

                    require_once($controllerFile);
                    $this->ctrl = new $controllerClass($url);
                } else {
                    throw new \Exception(("Page introuvable"));
                }

            } else {
                require_once('controller/ControllerAccueil.php');
                $this->ctrl = new ControllerAccueil($url);
            }

        } catch (\Exception $e) {
            $errorMsg = $e->getMessage();
            $this->view = new View('Error');
            $this->view->generate(array('errorMsg' => $errorMsg));
            require_once('views/viewError.php');
        }

    }

}
