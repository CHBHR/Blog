<?php 

namespace Router;

use Database\DBConnection;

class Route {

    public $path;
    public $action;
    public $matches;

    public function __construct($path, $action)
    {
        $this->path = trim($path, '/');
        $this->action = $action;
    }

    public function matches(string $url)
    {
        /**
         * 1ere expression: tout ce qui est un alpha numérique après les ':' avec plusieurs répétitions possibles
         * 2eme expression: tout ce qui n'est pas un slash avec plusieurs répétitions possibles
         * 
         * permet de récupérer un paramètre éventuel
         */
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
        $pathToMatch = "#^$path$#";

        if (preg_match($pathToMatch, $url, $matches)){
            $this->matches = $matches;
            return true;
        } else {
            return false;
        }
    }

    public function execute()
    {
        $params = explode('@', $this->action);
        $controller = new $params[0](new DBConnection);
        $method = $params[1];

        /**
         * ternaire pour check si un controller est demander ou si page statique
         */
        return isset($this->matches[1]) ? $controller->$method($this->matches[1]) : $controller->$method();
    }
}