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

    //creer un article
    public function createArticle()
    {
        return $this->addArticle('article', 'Article');
    }

    //supprime un article
    public function deleteArticle($id)
    {
        try{
            return $this->deleteOne('article', $id);
        } catch (\Exception $e) {
            $errorMsg = $e->getMessage();
            echo "L'article n'a pas pu être supprimé";
        }
    }

    //met l'article à jour
    public function updateArticle($id)
    {
        return $this->updateOne('article', $id);
    }

}