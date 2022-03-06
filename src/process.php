<?php
    session_start();

    include_once("config.php");


    if (isset($_POST['formInscription']))
    {
        $con = config::connect();
        $nomUtilisateur = sanitizeString($_POST['nomUtilisateur']);
        $email = sanitizeString($_POST['email']);
        $mdp = sanitizePassword($_POST['mdp']);
        //$mdpConf = $_POST['mdpConfirmation'];

        if($nomUtilisateur == "" || $email == "" || $mdp == "")
        {
            return;
        }

        if(insertDetails($con, $nomUtilisateur, $email, $mdp))
        {
            echo "details inserted successfully";
            $_SESSION['nomUtilisateur'] = $nomUtilisateur;
            header("Location: controller/Controller.php");
        }
    }

    if (isset($_POST['formConnection']))
    {
        $con = config::connect();

        $nomUtilisateur = sanitizeString($_POST['nomUtilisateur']);
        $mdp = sanitizePassword($_POST['mdp']);
        //$mdpConf = $_POST['mdpConfirmation'];

        if(checkLogin($con, $nomUtilisateur, $mdp))
        {
            $_SESSION['nomUtilisateur'] = $nomUtilisateur;
            header("Location: controller/Controller.php");
        } else {
            echo "Le nom d'utilisateur ou le mot de passe est incorrect";
        }
    }

    function insertDetails($con, $nomUtilisateur, $email, $mdp)
    {
        $query = $con->prepare("
            INSERT INTO utilisateur (nom_utilisateur,email,mdp)
            VALUES(:nomUtilisateur,:email,:mdp)
        ");

        $query->bindParam(":nomUtilisateur", $nomUtilisateur);
        $query->bindParam(":email", $email);
        $query->bindParam(":mdp", $mdp);

        return $query->execute();
    }

    function checkLogin($con, $nomUtilisateur, $mdp)
    {
        $query = $con->prepare("
            SELECT * FROM utilisateur WHERE nom_utilisateur=:nomUtilisateur AND mdp=:mdp
        ");

        $query->bindParam(":nomUtilisateur", $nomUtilisateur);
        $query->bindParam(":mdp", $mdp);

        $query->execute();

        //check combiens de 'rows' sont retournés
        if($query->rowCount() == 1)
        {
            return true;
        } else {
            return false;
        }
    }

    function sanitizeString($string)
    {
        $string = strip_tags($string);

        $string = str_replace(" ","",$string);

        return $string;
    }

    function sanitizePassword($string)
    {
        $string = md5($string);

        return $string;
    }
