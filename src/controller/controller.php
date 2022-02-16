<?php
    require('../model/model.php');

    function listPosts()
    {
        $post = getPosts();

        require('../view/listeArticlesView.php');
    }

    function post()
    {
        $post = getPost($_GET['id']);
        $comments = getComments($_GET['id']);

        require('../view/accueilView.php');
    }