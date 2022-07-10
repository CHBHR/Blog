<?php

namespace App\Models;

use DateTime;

class Article extends Model{

    protected $table = 'article';

    public function getFormatedDate($date): string
    {
        return (new DateTime($date))->format('d/m/Y à H:i');
    }

    /**
     * retourne une chaine texte tronquée
     */
    public function getExcerpt($content): string
    {
        return substr($content, 0, 150) . '...';
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

    public function getPendingComment($id)
    {
        $database = $this->database::getPDO();
        $query = "SELECT * FROM commentaire WHERE id_article = ? AND status = 'pending'";
        $stmt = $database->prepare($query);
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        $row = $stmt->rowCount();
        return ($row);
    }

    public function create($data)
    {
        $param = [
            $data['titre'],
            $data['chapo'],
            $data['contenu'],
            $data['id_auteur']
        ];

        return $this->createArticle($param);
    }
}