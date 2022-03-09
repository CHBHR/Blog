<?php 

    session_start();

    include_once(dirname(__FILE__) . "/../config.php");
        
    include(dirname(__FILE__) . "/../view/headerView.php");
    include(dirname(__FILE__) . "/../view/listeArticlesView.php");


    if (isset($_POST['formCreationArticle']))
    {
        $con = Config::connect();
        
        $titre = $_POST['titre'];
        $chapo = $_POST['chapo'];
        $contenu =$_POST['contenu'];

        if(insertDetails($con, $titre, $chapo, $contenu))
        {
            echo "Article sauvegardé !";
            header("Location: controller/listeArtcileController.php");
        }

    }

    function insertDetails($con, $titre, $chapo, $contenu)
    {
        $auteurNom = $_SESSION['nomUtilisateur'];

        $auteurId =getAuteurId($con, $auteurNom);

        $query = $con->prepare("
            INSERT INTO article (titre,chapo,contenu,auteurId)
            VALUES(:titre,:chapo,:contenu,:auteurId)
        ");

        $query->bindParam(":titre", $titre);
        $query->bindParam(":chapo", $chapo);
        $query->bindParam(":contenu", $contenu);
        $query->bindParam(":auteurId", $auteurId);

        return $query->execute();
    }

    function getAuteurId($con, $nomUtilisateur)
    {
        $query = $con->prepare("
            SELECT * FROM utilisateur WHERE nom_utilisateur=:nomUtilisateur
        ");

        $query->bindParam(":nomUtilisateur", $nomUtilisateur);

        $query->execute();

        $dataUtilisateur = $query->fetch();

        return $dataUtilisateur['id'];
    }

    function getArticle()
    {
        $con = Config::connect();
        $query = $con->prepare("
            SELECT * FROM article
        ");
        $query->execute();

        $dataArticle = $query->fetch();

        return $dataArticle;
    }
    
    include(dirname(__FILE__) . "/../view/footerView.php");
