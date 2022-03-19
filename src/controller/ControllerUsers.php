<?php

declare(strict_types=1);

require_once 'helpers/session_helper.php';
require_once 'model/UserRepository.php';

class ControllerUsers
{
    private $userManager;
    private $_view;

    public function __construct()
    {
        $this->userManager = new UserRepository;
        

        if (isset($_POST['formSignIn'])){
        //if($_SERVER['REQUEST_METHOD'] == 'POST'){
            switch($_POST['type']){
                case 'register':
                    $this->register();
                    $this->generateView();
                    break;
                case 'login':
                    $this->login();
                    $this->generateView();
                    break;
                default:
                    $this->generateView();
            }
        }elseif(isset($_GET['q'])){
        //}else{
            switch($_GET['q']){
                case 'logout':
                    $this->logout();
                    break;
                default:
                    $this->generateView();
            }
        }
        // else if(isset($_POST['formLogin'])){
        //     $this->login();
        //     //$this->generateView();
        // }
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
            'mdpVerification' => trim($_POST['mdpVerification'])
        ];

        //validate inputs
        if(empty($data['nomUtilisateur']) || empty($data['email']) || empty($data['mdp']) || empty($data['mdpVerification'])){
            flash("register", "Merci de remplir tout les champs");
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

    public function login()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
            'nomUtilisateur/email' => trim($_POST['nomUtilisateur/email']),
            'mdp' => trim($_POST['mdp'])
        ];

        if(empty($data['nomUtilisateur/email']) || empty($data['mdp']) ){
            flash("login", "Merci de remplir tout les champs");
        }

        if($this->userManager->findUserByEmailOrUsername($data['nomUtilisateur/email'], $data['nomUtilisateur/email'])){
            $loggedInUser = $this->userManager
                ->login($data['nomUtilisateur/email'], $data['mdp']);
            if($loggedInUser){
                $this->createUserSession($loggedInUser);
            }
        }else {
            flash('login', "nom d'utilisateur ou email non trouvé");
        }
    }

    public function createUserSession($user)
    {
        $_SESSION['id'] = $user->id;
        $_SESSION['nomUtilisateur'] = $user->nom_utilisateur;
        $_SESSION['email'] = $user->email;
        $_SESSION['role'] = $user->role;
        echo "session created";
        redirect("index.php?accueil");
    }

    private function logout()
    {
        unset($_SESSION['id']);
        unset($_SESSION['nomUtilisateur']);
        unset($_SESSION['email']);
        unset($_SESSION['role']);
        session_destroy();
        $this->_view = new View('accueil');
        $this->_view->generatePage();
    }

    private function generateView()
    {
        $this->_view = new View('SignUp');
        $this->_view->generatePage();
    }
}
