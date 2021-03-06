<?php

namespace App\Controllers;

use Database\DBConnection;
use App\Controllers\Globals;

abstract class Controller {

    protected $database;
    protected $globals;

    public function __construct(DBConnection $database)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $this->database = $database;
    }

    /**
     * @SuppressWarnings("unused")
     */
    protected function view(string $path, array $params = null)
    {
        ob_start();
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
        require VIEWS . $path . '.php';
        $content = ob_get_clean();
        require VIEWS . 'layout.php';
    }

    protected function getDB()
    {
        return $this->database;
    }

    protected function isAdmin()
    {
        $auth = 'auth';
        $this->globals = new Globals;
        $session = $this->globals->getSessionData($auth);
        if (isset($session) && $session === 'admin') {
            return true;
        } return  $this->redirect('login');
    }

    protected function isConnected()
    {
        $this->globals = new Globals;
        $session = $this->globals->getSessionData();

        if (isset($session)) {
            return true;
        } else {
           return  $this->redirect('login');
        }
    }

    public function redirect($url)
    {
        return header('Location: /'.$url);
    }

    public function sanitize($dataPost)
    {
        foreach($dataPost as $key => $value) {
            switch($key) {
                //user
                case $key === 'username':
                    $value = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    break;
                case $key === 'email':
                    $value = filter_var($value, FILTER_SANITIZE_EMAIL);
                    break;
                case $key === 'password':
                    $value = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    break;
                case $key === 'id_article':
                    $value = filter_var($value, FILTER_VALIDATE_INT);
                    break;
                //article and comment
                case $key === 'titre':
                    $value = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    break;
                case $key === 'chapo':
                    $value = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    break;
                case $key === 'contenu':
                    $value = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    break;
            }
        }
        return $dataPost;
    }

}