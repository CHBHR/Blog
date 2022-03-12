<?php

declare(strict_types=1);

class ArticleManager extends Model
{

    //récupère tous les articles dans la bdd
    public function getArticles()
    {
        return $this->getAll('article','Article');
    }

    //recupère une seul article dans la bdd
    public function getArticle($id)
    {
        return $this->getOne('article', 'Article', $id);
    }

}