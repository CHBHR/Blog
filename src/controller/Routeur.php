<?php

declare(strict_types=1);

require_once 'views/View.php';

// Route::set('accueil', function(){
//     echo "accueil";
// });

// Route::set('listeArticles', function(){
//     echo "accueil";
// });

class Routeur
{

    public function routeReq(){

        try {
            //chargement automatique des classes du dossier model
            // spl_autoload_register(function($class){
            //     require_once('model/'.$class.'.php');
            // });

            //creation de la variable url
            $url = '';

            //determine le controller en fonction de la valeur de cette variable
            echo "try";
            echo "</br>";
            if (isset($_SERVER['REQUEST_URI'])){
                $url = $_SERVER['QUERY_STRING'];
                $url = explode('=', $url);

                echo "if no 1";
                echo "</br>";

                if (count($url) > 1 && strpos($url[1], '&')){
                    $urlParam = explode('&',$url[1]);
                    $url[0] = $urlParam[0];
                    echo "if no 2";
                    echo "</br>";
                }

                echo "else n 2";
                echo "</br>";

                //prend le premier parametre de l'url et le convertis
                $controller = ucfirst(strtolower($url[0]));
                $controllerClass = "Controller".$controller;
                //on retrouve le chemin du controller voulu
                $controllerFile ="controller/".$controllerClass.".php";

                //check si le fichier du controller existe
                if (file_exists($controllerFile) && $controllerFile !== 'controller/Controller.php'){
                    //on lance la classe en question avec tous les param url pour respecter l'encapsulation
                    var_dump($controllerFile);

                    require_once($controllerFile);
                    $this->ctrl = new $controllerClass($url);
                    echo "if n 3";
                    echo "</br>";

                } else {
                    echo "else n3";
                    echo "</br>";
                    throw new \Exception("Page introuvable");
                    var_dump($controllerFile);
                }

            } else {
                require_once('controller/ControllerAccueil.php');
                $this->ctrl = new ControllerAccueil($url);
                echo "la page n'a pas été trouvée";
                echo "else n 1";
                echo "</br>";                
            }

        } catch (\Exception $e) {
            $errorMsg = $e->getMessage();
            // $this->view = new View('Error');
            // $this->view->generate(array('errorMsg' => $errorMsg));
            // require_once('views/viewError.php');
            echo 'page non trouvée';
            require_once('controller/ControllerAccueil.php');
            $this->ctrl = new ControllerAccueil($url);
            //var_dump($url);
        }

    }

}
