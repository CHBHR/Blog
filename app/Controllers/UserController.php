<?php

namespace App\Controllers;

use App\Models\User;
use App\Validation\Validator;

class UserController extends Controller{

    public function login()
    {
        return $this->view('auth.login');
    }

    public function loginPost()
    {
        /**
         * Ajouter des $rules en plus pour les différents champs
         */
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'username' => ['required', 'min:3'],
            'email' => ['required'],
            'password' => ['required']
        ]);

        if ($errors) {
            $_SESSION['errors'][] = $errors;
            header('Location: /login');
            exit;
        }

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

    public function signin()
    {
        $validator = new Validator($_POST);

        $errors = $validator->validate([
            'username' => ['required', 'min:3', 'unused'],
            'email' => ['required', 'unused'],
            'password' => ['required'],
            'passwordCheck' => ['required']
        ]);

        $user = new User($this->getDB());

        if ($user->getByUserName($_POST['username'])) {
            $errors['username'][] = "Ce nom d'utilisateur est déjà pris";
            $_SESSION['errors'][] = $errors;
            header('Location: /login');
            exit;
        } elseif ($user->getByEmail($_POST['email'])) {
            $errors['email'][] = "Cet email est déjà utilisé";
            $_SESSION['errors'][] = $errors;
            header('Location: /login');
            exit;
        } else {

            $user = new User($this->getDB());
            
            //implement createUser
            $data = [
                'nom_utilisateur' => $_POST['username'],
                'email'=> $_POST['email'],
                'mdp' => $_POST['password']
            ];

            $result = $user->create($data);
    
            if ($result) {
                $_SESSION['auth'] = $user->role;
                return header('Location: /');
            } else {
                return header('Location: /login');
            }
        }

        if ($errors) {
            $_SESSION['errors'][] = $errors;
            header('Location: /login');
            exit;
        }

    }
}