<?php
    session_start();

    include_once("config.php");
    include("Controller/connexionController.php");

    if (isset($_POST['formInscription']))
    {
        $con = config::connect();
        $nomUtilisateur = sanitizeString($_POST['nomUtilisateur']);
        $email = sanitizeString($_POST['email']);
        $mdp = sanitizePassword($_POST['mdp']);
        $mdpConf = sanitizePassword($_POST['mdpConfirmation']);

        if($nomUtilisateur == "" || $email == "" || $mdp == "")
        {
            echo "Il faut remplir les champs";
            return;
        }

        if($mdp != $mdpConf)
        {
            echo "Les mots de passes ne sont pas les mêmes";
            return;
        }

        if(!checkUserNameExist($con, $nomUtilisateur))
        {
            echo "Ce nom d'utilisateur est déjà pris";
            return;
        }

        if(!checkEmailExist($con, $email))
        {
            echo "Cet email est déjà utilisé";
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

        if(checkLogin($con, $nomUtilisateur, $mdp))
        {
            $_SESSION['nomUtilisateur'] = $nomUtilisateur;
            header("Location:controller/Controller.php");
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
            unset($query);
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

    function checkUserNameExist($con, $nomUtilisateur)
    {
        $query = $con->prepare("
            SELECT * FROM utilisateur WHERE nom_utilisateur=:nomUtilisateur
        ");

        $query->bindParam(":nomUtilisateur", $nomUtilisateur);

        $query->execute();

        if($query->rowCount() >= 1)
        {
            return false;
        } else {
            return true;
        }

    }

    function checkEmailExist($con, $email)
    {
        $query = $con->prepare("
            SELECT * FROM utilisateur WHERE email=:email
        ");

        $query->bindParam(":email", $email);

        $query->execute();

        if($query->rowCount() >= 1)
        {
            return false;
        } else {
            return true;
        }
    }