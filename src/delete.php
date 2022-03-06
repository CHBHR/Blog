<?php

    session_start();

    include_once("config.php");

    $con = config::connect();

    $nomUtilisateur = $_SESSION['nomUtilisateur'];

    $query = $con->prepare("
        DELETE FROM utilisateur WHERE nomUtilisateur=:nomutilisateur
    ");

    $query->bindParam("nomUtilisateur", $nomUtilisateur);

    $query->execute();

    //FIX ME
    header("Location: ");