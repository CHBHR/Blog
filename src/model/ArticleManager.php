<?php

declare(strict_types=1);

class ArticleManager extends Model
{

    //récupération des articles dans la bdd
    public function getArticles(){
        return $this->getAll('article','Article');
    }

}