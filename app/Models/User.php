<?php

namespace App\Models;

class User extends Model{

    protected $table = 'utilisateurs';

    public function getByUserName(string $username)
    {
        return $this->queryModel("SELECT * FROM {$this->table} WHERE nom_utilisateur = ?", [$username], true);
    }

    public function getByEmail(string $email)
    {
        return $this->queryModel("SELECT * FROM {$this->table} WHERE email= ?", [$email], true);
    }

    public function createUser(array $data)
    {
        // $db = new Model();
        // var_dump($data);
        // die();
        // $query = "INSERT INTO utilisateur (nom_utilisateur, email, mdp) VALUES (:nomUtilisateur, :email, :mdp)";
        // $stmt = $db->prepare($query);
        // $stmt->bindParam(":nomUtilisateur", $data['username']);
        // $stmt->bindParam(":email", $data['email']);
        // $stmt->bindParam(":mdp", $data['mdp']);
        // if($stmt->execute()){
        //     return true;
        // }else{
        //     return false;
        // }

        // "INSERT INTO articles (titre, chapo, contenu, auteur_id) 
        // VALUES(:titre, :chapo, :contenu, :date_creation,:auteur_id)";
    }

}