<?php
    
    require(dirname(__FILE__) . "/../model/model.php");
    
    include(dirname(__FILE__) . "/../view/headerView.php");
    include(dirname(__FILE__) . "/../view/connexionView.php");
    include(dirname(__FILE__) . "/../view/footerView.php");

    $userName = "";
    $email = "";
    $errors = [];
    $db = mySqlyConnect();

    if (isset($_POST['formInscription'])) {
        //récupere les input du formulaire
        $userName = mysqli_real_escape_string($db, $_POST['userName']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        $passConfirmation = mysqli_real_escape_string($db, $_POST['passConfirmation']);

        // check si le formulaire est bien remplis
        // by adding (array_push()) corresponding error unto $errors array
        if (empty($userName)) { array_push($errors, "Username is required"); }
        if (empty($email)) { array_push($errors, "Email is required"); }
        if (empty($password)) { array_push($errors, "Password is required"); }
        if ($password != $passConfirmation) {
            array_push($errors, "The two passwords do not match");
        }

        // check si il existe déjà un utilisateur avec le même username
        $userCheckQuery = "SELECT * FROM 'user' WHERE 'user_name' = '$userName' OR email = '$email' LIMIT 1";
        $userCheckDoublon = mysqli_query($db, $userCheckQuery);
        $utilisateur = mysqli_fetch_assoc($userCheckDoublon);

        //si l'utilisateur existe
        if ($utilisateur) { 
            if ($utilisateur['user_name'] === $userName) {
                // array_push($errors, "Ce nom utilisateur existe déjà");
                echo "Ce nom utilisateur existe déjà";

            }
            if ($utilisateur['email'] === $email) {
                array_push($errors, "Cet email est déjà utilisé");
                echo "Cet email est déjà utilisé";
            }
        }

        //enregistre l'utilisateur si il n'y a aucune erreur
        if (count($errors) == 0) {
            $motDePasse = md5($pass);

            $query = "INSERT INTO 'user' ('user_name', 'email', 'password' , 'role') VALUES ('$userName', '$email', '$password', 'utilisateur')";

            var_dump($query);

            mysqli_query($db, $query);

            $_SESSION['user_name'] = $nomUtilisateur;
            $_SESSION['role'] = 'utilisateur';
            $_SESSION['success'] = "Vous êtes maintenant connecté";

            echo "normalement c'est bon";
            var_dump($_SESSION);

            //header('location: controller.php');
        }

    }