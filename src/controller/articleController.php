<?php 

    session_start();

    include_once(dirname(__FILE__) . "/../config.php");

   

    if(isset($_GET['id'])){
    
        $id = $_GET['id'];

        if(!getArticle($id)){
            
            header("Location: controller.php");
            echo"Désolé, cet article n'existe pas";
        }

        $dataArticle = getArticle($id);

        } else {
        header("Location: controller.php");
        echo"Désolé, cet article n'existe pas";
    }

    // if(isset($_POST['formUpdateArticle'])){

    //     $titre = $_POST['titre'];
    //     $chapo = $_POST['chapo'];
    //     $contenu = $_POST['contenu'];
    //     $id = $dataArticle['id'];

    //     if(updateArticle($con, $titre, $chapo, $contenu, $id))
    //     {
    //         echo "Article modifié !";
    //     } else {
    //         echo "l'Article n'a pas pu être modifié";
    //     }

    // }

    function getArticle($id)
    {
        $con = Config::connect();

        $query = $con->prepare("
            SELECT * FROM article WHERE id = :id
        ");

        $query->bindParam(":id", $id);

        $query->execute();

        $dataArticle = $query->fetch();

        return $dataArticle;
    }

    function updateArticle($con, $titre, $chapo, $contenu, $id)
    {

        $con = Config::connect();

        $query = $con->prepare("
            UPDATE article SET titre=:titre,chapo=:chapo,contenu=:contenu,auteur_id=:auteurId WHERE id=:id
        ");

        $query->bindParam(":titre", $titre);
        $query->bindParam(":chapo", $chapo);
        $query->bindParam(":contenu", $contenu);
        $query->bindParam(":auteurId", $auteurId);
        $query->bindParam(":id", $id);

        return $query->execute();
    }

    include(dirname(__FILE__) . "/../view/headerView.php");

    include(dirname(__FILE__) . "/../view/articleView.php");
    
    include(dirname(__FILE__) . "/../view/footerView.php");
