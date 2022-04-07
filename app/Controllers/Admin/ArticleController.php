<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller{

    public function listeArticle()
    {
        $this->isAdmin();
        
        $articles = (new Article($this->getDB()))->getAll();

        return $this->view('admin.article.listeArticle', compact('articles'));
    }

    /**
     * retourne le formulaire de création d'article
     */
    public function create()
    {
        $this->isAdmin();

        return $this->view('admin.article.form');
    }

    /**
     * crée l'article avec les données du formulaire
     */
    public function createArticle()
    {
        $this->isAdmin();

        $article = new Article($this->getDB());
        
        $result = $article->create($_POST);

        if ($result) {
            return header('Location: /admin/posts');
        } else {
            return header('Location: /admin/posts');
        }
    }

    public function edit(int $id)
    {
        $this->isAdmin();

        $article = (new Article($this->getDB()))->findById($id);

        return $this->view('admin.article.form', compact('article'));
    }

    public function update(int $id)
    {
        $this->isAdmin();

        $article = new Article($this->getDB());

        $result = $article->update($id, $_POST, true);

        if ($result) {
            return header('Location: /admin/posts');
        }
    }

    public function destroy(int $id)
    {
        $this->isAdmin();

        $article = new Article($this->getDB());
        $result = $article->destroy($id);

        if ($result) {
            return header('Location: /admin/posts');
        }
    }
}