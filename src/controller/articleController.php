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

    include(dirname(__FILE__) . "/../view/headerView.php");
    include(dirname(__FILE__) . "/../view/articleView.php");
    include(dirname(__FILE__) . "/../view/footerView.php");
