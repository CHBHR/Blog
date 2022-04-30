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
        var_dump($param);
        //die();
        $this->createUser($param);
    }

        // $this->$queryModel("INSERT INTO utilisateur (nom_utilisateur, email, mdp) VALUES (:nomUtilisateur, :email, :mdp)");
        // $stmt = $this->$query;
        // $stmt->bindParam(":nomUtilisateur", $data['username']);
        // $stmt->bindParam(":email", $data['email']);
        // $stmt->bindParam(":mdp", password_hash($data['mdp'], PASSWORD_DEFAULT));
        // if($stmt->execute()){
        //     return true;
        // }else{
        //     return false;
        // }

        // return($this->queryModel("INSERT INTO utilisateur (nom_utilisateur, email, mdp) VALUES (:nomUtilisateur, :email, :mdp)"));
    //}

}