<?php

namespace App\Controllers;

use App\Models\User;
use App\Validation\Validator;

class UserController extends Controller{

    public function login()
    {
        return $this->view('auth.login');
    }

    public function signup()
    {
        return $this->view('auth.signup');
    }

    public function loginPost()
    {
        $dataPost = $this->sanitize($_POST);

        $session = $_SESSION;

        /**
         * Ajouter des $rules en plus pour les différents champs
         */
        $validator = new Validator($dataPost);
        $errors = $validator->validate([
            'username' => ['required', 'min:3'],
            'email' => ['required'],
            'password' => ['required']
        ]);

        if ($errors) {
            $session['errors'][] = $errors;
            $this->redirect('login');
            exit;
        }

        $user = (new User($this->getDB()))->getByUserName($dataPost['username']);

        if (password_verify($dataPost['password'], $user->mdp) && $user->role === 'admin') {

            /**
             * On stock la valeur du role dans la session
             */
            $session['auth'] = $user->role;
            $session['id'] = $user->id;
            return $this->redirect('admin/posts?success=true');

        } elseif (password_verify($dataPost['password'], $user->mdp)) {
            $session['auth'] = $user->role;
            $session['id'] = $user->id;
            return $this->redirect('?success=true');
            
        } else {
            $errors['problem'][] = "il y a eu un probleme";
            $session['errors'][] = $errors;
            return $this->redirect('login');
        }
    }

    public function logout()
    {
        session_destroy();

        return $this->redirect('');
    }

    public function signin()
    {
        $dataPost = $this->sanitize($_POST);

        $session = $_SESSION;

        $validator = new Validator($dataPost);

        $errors = $validator->validate([
            'username' => ['required', 'min:3', 'unused'],
            'email' => ['required', 'unused'],
            'password' => ['required'],
            'passwordCheck' => ['required']
        ]);

        $user = new User($this->getDB());

        if ($user->getByUserName($dataPost['username'])) {
            $errors['username'][] = "Ce nom d'utilisateur est déjà pris";
            $session['errors'][] = $errors;
            $this->redirect('signup');
        } elseif ($user->getByEmail($dataPost['email'])) {
            $errors['email'][] = "Cet email est déjà utilisé";
            $session['errors'][] = $errors;
            $this->redirect('signup');
        } else {

            $user = new User($this->getDB());
            
            //implement createUser
            $data = [
                'nom_utilisateur' => $dataPost['username'],
                'email'=> $dataPost['email'],
                'mdp' => $dataPost['password']
            ];

            $result = $user->createNewUser($data);
    
            if ($result) {
                $session['auth'] = $user->role;
                $session['id'] = $user->id;
                return $this->redirect('');
            } else {
                return $this->redirect('signup');
            }
        }

        if ($errors) {
            $session['errors'][] = $errors;
            $this->redirect('signup');
        }

    }
}