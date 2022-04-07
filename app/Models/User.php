<?php

namespace App\Models;

class User extends Model {

    protected $table = 'utilisateurs';

    public function getByUserName(string $username): User
    {
        return $this->queryModel("SELECT * FROM {$this->table} WHERE nom_utilisateur = ?", [$username], true);
    }

}