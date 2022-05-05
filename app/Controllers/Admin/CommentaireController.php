<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Article;
use App\Models\Commentaire;

class CommentaireController extends Controller{

    public function listeCommentaire($articleId)
    {
        $this->isAdmin();

        $article = (new Article($this->getDB()))->findById($articleId);

        $commentaires = (new Commentaire($this->getDB()))->getCommentsFromArticle($articleId);
    
        return $this->view('admin.article.listeCommentaire', compact('article', 'commentaires'));
    }

    public function validerCommentaire($commentaireId)
    {
        $this->isAdmin();

        $commentaire = new Commentaire($this->getDB());

        $result = $commentaire->validate($commentaireId);

        if ($result) {
            return header('Location: /admin/posts');
        } else {
            return header('Location: /admin/posts');
        }
    }

    public function deleteCommentaire($id)
    {
        $this->isAdmin();
    
        $commentaire = new Commentaire($this->getDB());
        $result = $commentaire->destroy($id);

        if ($result) {
            return header('Location: /admin/posts');
        }
    }

}