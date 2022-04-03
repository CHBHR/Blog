<?php

namespace App\Models;

use DateTime;

class Article extends Model{

    protected $table = 'articles';

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

    //TO DO
    // public function getAuthor($id)
    // {
    //     $db = $this->db::getPDO();
    //     $query = "SELECT nom_utilisateur FROM utilisateurs WHERE id = $id";
    //     $stmt = $db->prepare($query);
    //     $stmt->execute();
    //     return $stmt->fetch();
    // }
}