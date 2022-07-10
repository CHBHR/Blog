<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Article;
use App\Controllers\Globals;

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
        
        $dataPost = (new Globals())->getPostData();

        $result = $article->create($dataPost);

        if ($result) {
            return $this->redirect('admin/articles');
        } return $this->redirect('admin/articles');
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

        $dataPost = (new Globals())->getPostData();

        $result = $article->update($id, $dataPost, true);

        if ($result) {
            return $this->redirect('admin/articles');
        }
    }

    public function destroy(int $articleId)
    {
        $this->isAdmin();

        $article = new Article($this->getDB());
        $result = $article->destroy($articleId);

        if ($result) {
            return $this->redirect('admin/articles');
        }
    }
}