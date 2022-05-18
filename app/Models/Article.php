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
    public function getExcerpt(): string
    {
        return substr($this->contenu, 0, 150) . '...';
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

    public function getPendingComment($id)
    {
        $db = $this->db::getPDO();
        $query = "SELECT * FROM commentaire WHERE id_article = ? AND status = 'pending'";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        $row = $stmt->rowCount();
        return ($row);
    }
}