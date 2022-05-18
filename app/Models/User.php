<?php

namespace App\Models;

class User extends Model{

    protected $table = 'utilisateur';

    public function getByUserName(string $username)
    {
        return $this->queryModel("SELECT * FROM {$this->table} WHERE nom_utilisateur = ?", [$username], true);
    }

    public function getByEmail(string $email)
    {
        return $this->queryModel("SELECT * FROM {$this->table} WHERE email= ?", [$email], true);
    }

    public function createNewUser(array $data)
    {
        $param = [
            $data['nom_utilisateur'], 
            $data['email'], 
            password_hash(
                $data['mdp'], 
                PASSWORD_DEFAULT)
            ];
        $this->createUser($param);
    }

}