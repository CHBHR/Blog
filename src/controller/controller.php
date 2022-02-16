<?php
    
    require(dirname(__FILE__) . "/../model/model.php");
    
    include(dirname(__FILE__) . "/../view/headerView.php");
    include(dirname(__FILE__) . "/../view/accueilView.php");
    include(dirname(__FILE__) . "/../view/footerView.php");

    // function listPosts()
    // {
    //     $post = getPosts();

    //     require('../view/listeArticlesView.php');
    // }

    // function post()
    // {
    //     $post = getPost($_GET['id']);
    //     $comments = getComments($_GET['id']);

    //     require('../view/accueilView.php');
    // }