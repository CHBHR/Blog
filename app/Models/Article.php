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

    // public function create(array $data)
    // {
    //     parent::create($data);
    // }

    public function getAuthor($id): string
    {
        $db = $this->db::getPDO();
        $query = "SELECT nom_utilisateur FROM utilisateurs WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return ($row->nom_utilisateur);
    }
}