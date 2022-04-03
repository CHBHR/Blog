<?php

namespace App\Models;

use DateTime;

class Article extends Model{

    protected $table = 'articles';

    public function getFormatedDate(): string
    {
        return (new DateTime($this->date_creation))->format('d/m/Y à H:m');
    }

    /**
     * retourne une chaine texte tronquée
     */
    public function getExcerpt(): string
    {
        return substr($this->contenu, 0, 150) . '...';
    }
}