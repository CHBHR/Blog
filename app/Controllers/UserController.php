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
        $globals = new Globals;
        $dataPost = $globals->getPostData();

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
            $globals->putSessionData('errors',$errors);
            $session = $globals->getSessionData('errors');

            return $this->view('auth.login', ['session' => $session]);
        }

        $user = (new User($this->getDB()))->getByUserName($dataPost['username']);

        if (password_verify($dataPost['password'], $user->mdp) && $user->role === 'admin') {

            /**
             * On stock la valeur du role dans la session
             */
            //$globals->putSessionData('auth',$user->role);
            //$globals->putSessionData('id',$user->id);
            $_SESSION['auth'] = $user->role;
            $_SESSION['id'] = $user->id;
            return $this->redirect('admin/articles?success=true');

        } elseif (password_verify($dataPost['password'], $user->mdp)) {
            $_SESSION['auth'] = $user->role;
            $_SESSION['id'] = $user->id;
            return $this->redirect('?success=true');
            
        } else {
            $errors['problem'][] = "il y a eu un probleme";
            $_SESSION['errors'][] = $errors;
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
        $globals = new Globals;
        $dataPost = $globals->getPostData();
        
        $validator = new Validator($dataPost);

        $session = new Globals;

        $errors = $validator->validate([
            'username' => ['required', 'min:3', 'unused'],
            'email' => ['required', 'unused'],
            'password' => ['required'],
            'passwordCheck' => ['required']
        ]);

        $user = new User($this->getDB());
        $session = $globals->getSessionData();

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
            
            $data = [
                'nom_utilisateur' => $dataPost['username'],
                'email'=> $dataPost['email'],
                'mdp' => $dataPost['password']
            ];

            $result = $user->createNewUser($data);
    
            if ($result) {
                $globals->putSessionData('auth',$user->role);
                $globals->putSessionData('id',$user->id);
                return $this->redirect('?signIn=true');
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