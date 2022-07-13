<?php

namespace App\Controllers;

use App\Models\Article;
use App\Models\Commentaire;
use App\Validation\Validator;

class BlogController extends Controller {

    public function welcome()
    {
        $article = new Article($this->getDB());

        $articles = $article->getFirstThree();

        return $this->view('blog.welcome', compact('articles')); 
    }

    public function index()
    {
        $article = new Article($this->getDB());
        $articles = $article->getAll();

        return $this->view('blog.index', compact('articles'));
    }

    public function show(int $articleId)
    {
        $article = new Article($this->getDB());
        $article = $article->findById($articleId);

        $comment = new Commentaire($this->getDB());
        $comment = $comment->getCommentsFromArticle($articleId);

        return $this->view('blog.show', compact('article','comment'));
    }

    public function submitComment()
    {
        $this->isConnected();

        $dataPost = (new Globals())->getPostData();

        $articleId = $dataPost['id_article'];

        $validator = new Validator($dataPost);
        $errors = $validator->validate([
            'contenu' => ['required', 'min:16']
        ]);

        $session = $this->globals->getSessionData();

        if ($errors) {
            $session['errors'][] = $errors;
            $this->redirect('articles/' . $articleId);
        }

        $commentaire = new Commentaire($this->getDB());

        $result = $commentaire->submitComment($dataPost);

        if ($result) {
            return $this->redirect('?submit=true');
        }  return $this->redirect('articles/'. $articleId);
    }
}