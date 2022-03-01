<?php
    
    require(dirname(__FILE__) . "/../model/model.php");
    
    include(dirname(__FILE__) . "/../view/headerView.php");
    include(dirname(__FILE__) . "/../view/connexionView.php");
    include(dirname(__FILE__) . "/../view/footerView.php");

    //$nomUtilisateur = "";
    //$email = "";
    $errors = [];
    $db = mySqlyConnect();

    if (isset($_POST['formulaireInscription'])) {
        //récupere les input du formulaire
        $nomUtilisateur = mysqli_real_escape_string($db, $_POST['nomUtilisateur']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $pass = mysqli_real_escape_string($db, $_POST['pass']);
        $passConfirmation = mysqli_real_escape_string($db, $_POST['passConfirmation']);

        // check si le formulaire est bien remplis
        // by adding (array_push()) corresponding error unto $errors array
        if (empty($nomUtilisateur)) { array_push($errors, "Username is required"); }
        if (empty($email)) { array_push($errors, "Email is required"); }
        if (empty($pass)) { array_push($errors, "Password is required"); }
        if ($pass != $passConfirmation) {
            array_push($errors, "The two passwords do not match");
        }

        // check si il existe déjà un utilisateur avec le même username
        $userCheckQuery = "SELECT * FROM utilisateur WHERE nom_utilisateur = '$nomUtilisateur' OR email = '$email' LIMIT 1";
        $userCheckDoublon = mysqli_query($db, $userCheckQuery);
        $utilisateur = mysqli_fetch_assoc($userCheckDoublon);

        //si l'utilisateur existe
        if ($utilisateur) { 
            if ($utilisateur['nom_utilisateur'] === $nomUtilisateur) {
                array_push($errors, "Ce nom utilisateur existe déjà");
            }
            if ($utilisateur['email'] === $email) {
                array_push($errors, "Cet email est déjà utilisé");
            }
        }

        //enregistre l'utilisateur si il n'y a aucune erreur
        if (count($errors) == 0) {
            $motDePasse = md5($pass);

            $query = "INSERT INTO utilisateur (nom_utilisateur, email, mdp , role) VALUES('$nomUtilisateur', '$email', '$motDePasse', 'utilisateur')";
            mysqli_query($db, $query);
            $_SESSION['nomUtilisateur'] = $nomUtilisateur;
            $_SESSION['role'] = 'utilisateur';
            $_SESSION['success'] = "Vous êtes maintenant connecté";
            header('location: controller.php');
        }

    }