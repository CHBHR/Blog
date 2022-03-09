<?php 

session_start();

    require(dirname(__FILE__) . "/../model/model.php");
        
    include(dirname(__FILE__) . "/../view/headerView.php");
    include(dirname(__FILE__) . "/../view/listeArticlesView.php");
    include(dirname(__FILE__) . "/../view/footerView.php");