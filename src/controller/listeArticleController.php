<?php 

    session_start();

    include_once(dirname(__FILE__) . "/../config.php");
        
    include(dirname(__FILE__) . "/../view/headerView.php");
    include(dirname(__FILE__) . "/../view/listeArticlesView.php");

    $con = Config::connect();


    if (isset($_POST['formCreationArticle']))
    {
        
        $titre = $_POST['titre'];
        $chapo = $_POST['chapo'];
        $contenu =$_POST['contenu'];

        if(insertDetails($con, $titre, $chapo, $contenu))
        {
            echo "Article sauvegardé !";
            //header("Location: controller/listeArtcileController.php");
        }

    }

    function insertDetails($con, $titre, $chapo, $contenu)
    {
        $nomUtilisateur = $_SESSION['nomUtilisateur'];

        $auteurId = getAuteurId($nomUtilisateur);

        $query = $con->prepare("
            INSERT INTO article (titre,chapo,contenu,auteur_id)
            VALUES(:titre,:chapo,:contenu,:auteurId)
        ");

        $query->bindParam(":titre", $titre);
        $query->bindParam(":chapo", $chapo);
        $query->bindParam(":contenu", $contenu);
        $query->bindParam(":auteurId", $auteurId);

        return $query->execute();
    }

    function getAuteurId($nomUtilisateur)
    {
        $con = Config::connect();

        $query = $con->prepare("
            SELECT id FROM utilisateur WHERE nom_utilisateur=:nomUtilisateur
        ");

        $query->bindParam(":nomUtilisateur", $nomUtilisateur);

        $query->execute();

        $dataUtilisateur = $query->fetch();

        return $dataUtilisateur['id'];
    }

    function getAuteurName($auteurId)
    {
        $con = Config::connect();
        
        $query = $con->prepare("
            SELECT nom_utilisateur FROM utilisateur WHERE id=:auteurId
        ");

        $query->bindParam(":auteurId", $auteurId);

        $query->execute();

        $dataUtilisateur = $query->fetch();

        return $dataUtilisateur['nom_utilisateur'];
    }

    function getAllArticle()
    {
        $con = Config::connect();

        $query = $con->prepare("
            SELECT * FROM article
        ");

        $query->execute();

        $dataArticle = $query->fetchAll();

        return $dataArticle;
    }
    
    include(dirname(__FILE__) . "/../view/footerView.php");
