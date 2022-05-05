<?php

namespace App\Controllers;

use App\Models\Article;
use App\Models\Commentaire;
use App\Validation\Validator;

class BlogController extends Controller {

    public function welcome()
    {
        return $this->view('blog.welcome');
    }

    public function index()
    {
        $post = new Article($this->getDB());
        $posts = $post->getAll();

        return $this->view('blog.index', compact('posts'));
    }

    public function show(int $id)
    {
        $post = new Article($this->getDB());
        $post = $post->findById($id);

        $comment = new Commentaire($this->getDB());
        $comment = $comment->getCommentsFromArticle($id);

        return $this->view('blog.show', compact('post','comment'));
    }

    public function submitComment()
    {
        $this->isConnected();

        $articleId = $_POST['id_article'];

        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'contenu' => ['required', 'min:16']
        ]);

        if ($errors) {
            $_SESSION['errors'][] = $errors;
            header('Location: /posts/' . $articleId);
            exit;
        }

        $commentaire = new Commentaire($this->getDB());

        $result = $commentaire->submitComment($_POST);

        if ($result) {
            return header('Location: /?submit=true');
        } else {
            return header('/posts/:id');
        }
    }
}