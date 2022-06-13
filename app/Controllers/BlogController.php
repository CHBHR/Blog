<?php

namespace App\Controllers;

use App\Models\Article;
use App\Models\Commentaire;
use App\Validation\Validator;

class BlogController extends Controller {

    public function welcome()
    {
        $post = new Article($this->getDB());

        $posts = $post->getFirstThree();

        return $this->view('blog.welcome', compact('posts')); // ['posts'=>$posts->getFirstThree()]
    }

    public function index()
    {
        $post = new Article($this->getDB());
        $posts = $post->getAll();

        return $this->view('blog.index', compact('posts'));
    }

    public function show(int $articleId)
    {
        $post = new Article($this->getDB());
        $post = $post->findById($articleId);

        $comment = new Commentaire($this->getDB());
        $comment = $comment->getCommentsFromArticle($articleId);

        return $this->view('blog.show', compact('post','comment'));
    }

    public function submitComment()
    {
        $this->isConnected();

        $dataPost = $this->sanitize($_POST);

        $articleId = $dataPost['id_article'];

        $validator = new Validator($dataPost);
        $errors = $validator->validate([
            'contenu' => ['required', 'min:16']
        ]);

        if ($errors) {
            $_SESSION['errors'][] = $errors;
            $this->redirect('posts/' . $articleId);
        }

        $commentaire = new Commentaire($this->getDB());

        $result = $commentaire->submitComment($dataPost);

        if ($result) {
            return $this->redirect('?submit=true');
        }  return $this->redirect('posts/'. $articleId);
    }
}