<?php

namespace App\Controllers;

use Database\DBConnection;

abstract class Controller {

    protected $database;

    public function __construct(DBConnection $database)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        //setter en reference
        
        $this->database = $database;
    }

    /**
     * @SuppressWarnings("unused")
     */
    protected function view(string $path, array $params = null)
    {
        //FIX ME
        ob_start();
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
        require VIEWS . $path . '.php';
        //this line doesn't comply with codacy guidelines but failes without
        $content = ob_get_clean();
        require VIEWS . 'layout.php';
        //ajouter compact directement de params if not null
    }

    protected function getDB()
    {
        return $this->database;
    }

    protected function isAdmin()
    {
        if (isset($_SESSION['auth']) && $_SESSION['auth'] === 'admin') {
            return true;
        } return  $this->redirect('Location: /login');
    }

    protected function isConnected()
    {
        if (isset($_SESSION['auth'])) {
            return true;
        } else {
           return  $this->redirect('Location: /login');
        }
    }

    public function redirect($url)
    {
        return header('Location: /'.$url);
    }

    // public function convertSuperGlobalPost($global)
    // {
    //     //transform array superglobal to object
    //     //return array

    //     $object = new stdClass();
    //     foreach ($array as $key => $value)
    //         {
    //             $object->$key = $value;
    //         }
    //     return $object;
    // }

    // public function sanitize(array $inputs, array $fields) : array
    // {

    // }
}