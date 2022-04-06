<?php

namespace App\Controllers;

use App\Models\User;

class UserController extends Controller{

    public function login()
    {
        return $this->view('auth.login');
    }

    public function loginPost()
    {
        $user = (new User($this->getDB()))->getByUserName($_POST['username']);

        if (password_verify($_POST['password'], $user->mdp)) {

            /**
             * On stock la valeur du role dans la session
             */
            $_SESSION['auth'] = $user->role;
            return header('Location: /admin/posts?success=true');
        } else {
            return header('Location: /login');
        }
    }

    public function logout()
    {
        session_destroy();

        return header('Location: /');
    }
}