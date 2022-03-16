<?php

declare(strict_types=1);

//require_once 'model/UserManager.php';
// require_once 'views/View.php';
require_once 'helpers/session_helper.php';

class ControllerUsers
{
    private $userManager;
    private $_view;

    public function __construct()
    {
        $this->userManager = new UserRepository;
        //if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['formSignIn'])){
            switch($_POST['type']){
                case 'register':
                    $this->register();
                    break;
            }$this->generateView();
        }
        //$this->userManager = new UserManager();
        else{
            $this->generateView();
        }
        
    }

    public function register()
    {
        //process form

        //sanitize POST data
        //replace with FILTER_UNSAFE_RAW 
        // protect output with htmlspecialchars() method
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        //init data
        $data = [
            'nomUtilisateur' => trim($_POST['nomUtilisateur']),
            'email' => trim($_POST['email']),
            'mdp' => trim($_POST['mdp']),
            'mdpVerification' => trim($_POST['mdpVerification']),
        ];

        //validate inputs
        if(empty($data['nomUtilisateur']) || empty($data['email']) || empty($data['mdp']) || empty($data['mdpVerification'])){
            flash("register", "Merci de remplir tout les champs");
            //redirect("../views/viewSignUp.php");
        }

        if(!preg_match("/^[a-zA-Z0-9]*$/", $data['nomUtilisateur'])){
            flash("register", "Ce nom d'utilisateur est invalide");
        }

        if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            flash("register", "Cet email est invalide");
        }

        if(strlen($data['mdp']) < 6){
            flash("register", "Mot de passe trop court");
        } else if  ($data['mdp'] !== $data['mdpVerification']){
            flash("register", "Les mots de passes ne sont pas les mêmes");
        }

        if($this->userManager->findUserByEmailOrUsername($data['nomUtilisateur'], $data['email'])){
            flash("register", "Le nom d'utilisateur ou email est déjà pris");
        }

        //passed all validation checks
        //now going to hash password
        $data['mdp'] = password_hash($data['mdp'], PASSWORD_DEFAULT);

        if($this->userManager->register($data)){
            redirect("index.php?accueil");
        }else{
            die("Quelque chose s'est mal passé");
        }
    }

    private function generateView()
    {
        $this->_view = new View('SignUp');
        $this->_view->generatePage();
    }
}
