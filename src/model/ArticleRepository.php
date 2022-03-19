<?php

declare(strict_types=1);

require_once 'model/Repository.php';
require_once 'model/Article.php';

class ArticleRepository extends Repository
{
    public function getAllArticle($obj){
        $db = Repository::getBdd();
        $query = 'SELECT * FROM article';
        $stmt = $db->prepare($query);
        $stmt->execute();

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)){
            $dbObjects[] = new $obj($data);
        }

        return $dbObjects;
        $stmt->closeCursor();
    }

    public function getOneArticle($id){
        $db = Repository::getBdd();
        $query = 'SELECT * FROM article WHERE id = :id';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $dbObject[] = new Article($data);
        }

        return $dbObject;

        $stmt->closeCursor();
    }
}