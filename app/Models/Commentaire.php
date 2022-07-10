<?php

namespace App\Models;
use DateTime;

class Commentaire extends Model{

    protected $table = 'commentaire';

    public function submitComment($data)
    {
        $param = [
            $data[urlencode($data['contenu'])],
            $data['id_auteur'],
            $data['id_article']
        ];

        return $this->createComment($param);
    }

    public function getCommentsFromArticle($articleId)
    {
        return $this->queryModel("SELECT * FROM {$this->table} WHERE id_article = ? ORDER BY date_creation DESC", [$articleId]);
    }

    public function getFormatedDate($date): string
    {
        return (new DateTime($date))->format('d/m/Y à H:i');
    }

    public function getAuthor($authorId): string
    {
        $database = $this->database::getPDO();
        $query = "SELECT nom_utilisateur FROM utilisateur WHERE id = ?";
        $stmt = $database->prepare($query);
        $stmt->execute([$authorId]);
        $row = $stmt->fetch();
        return ($row->nom_utilisateur);
    }

    public function validate(int $id)
    {
        return $this->queryModel("UPDATE {$this->table} SET status = 'validated' WHERE id = ?", [$id], false);
    }

}