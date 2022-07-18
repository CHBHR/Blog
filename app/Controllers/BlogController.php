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

        $getData = (new Globals())->getGetData();

        if(isset($getData['success']))
            $message = "Vous êtes connecté!";
        elseif(isset($getData['submit']))
            $message = "Votre commentaire a été envoyer pour validation";
        elseif(isset($getData['mailSent']))
            $message = "Votre formulaire de contact a bien été envoyé";
        elseif(isset($getData['signIn']))
            $message = "Votre inscription s'est bien passé, veuillez vous connecter";
        else
            $message = "";

        return $this->view('blog.welcome', ['articles' => $articles, 'message' => $message]);
    }

    public function index()
    {
        $article = new Article($this->getDB());
        $articles = $article->getAll();

        return $this->view('blog.index', ['articles' => $articles]);
    }

    public function show(int $articleId)
    {
        $article = new Article($this->getDB());
        $article = $article->findById($articleId);

        $comment = new Commentaire($this->getDB());
        $commentaires = $comment->getCommentsFromArticle($articleId);

        return $this->view('blog.show', ['article' => $article,'commentaires' => $commentaires]);
    }

    public function submitComment()
    {
        $this->isConnected();

        $globals = new Globals;
        $dataPost = $globals->getPostData();

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