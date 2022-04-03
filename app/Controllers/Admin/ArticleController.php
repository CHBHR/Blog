<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller{

    public function listeArticle()
    {
        $articles = (new Article($this->getDB()))->getAll();

        return $this->view('admin.article.listeArticle', compact('articles'));
    }

    public function destroy(int $id)
    {
        $article = new Article($this->getDB());
        $result = $article->destroy($id);

        if ($result) {
            return header('Location: /admin/posts');
        }
    }
}