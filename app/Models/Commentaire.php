<?php

namespace App\Models;

class Commentaire extends Model{

    protected $table = 'commentaire';

    public function submitComment($data)
    {
        $param = [
            $data['contenu'],// = urlencode($data['contenu']), //urldecode 
            $data['id_auteur'],
            $data['id_article']
        ];
        //var_dump($param);
        //die();
        $this->createComment($param);
    }

}