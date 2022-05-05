<?php

namespace App\Models;
use DateTime;

class Commentaire extends Model{

    protected $table = 'commentaire';

    public function submitComment($data)
    {
        $param = [
            $data['contenu'],// = urlencode($data['contenu']), //urldecode 
            $data['id_auteur'],
            $data['id_article']
        ];

        $this->createComment($param);
    }

    public function getCommentsFromArticle($articleId)
    {
        return $this->queryModel("SELECT * FROM {$this->table} WHERE id_article = ?", [$articleId]);
    }

    public function getFormatedDate($date): string
    {
        return (new DateTime($date))->format('d/m/Y à H:i');
    }

    public function getAuthor($id): string
    {
        $db = $this->db::getPDO();
        $query = "SELECT nom_utilisateur FROM utilisateur WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return ($row->nom_utilisateur);
    }

    public function validate(int $id)
    {
        return $this->queryModel("UPDATE {$this->table} SET status = 'validated' WHERE id = ?", [$id], false);
    }

}