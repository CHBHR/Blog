<?php

declare(strict_types=1);

require_once('Repository.php');

class UserRepository extends Repository
{

    public function getAllUser(){
        $db = Repository::getBdd();
        $query = 'SELECT * FROM utilisateur';
        $stmt = $db->prepare($query);
        $stmt->execute();

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)){
            $dbObjects[] = new User($data);
        }
        
        return $dbObjects;
        $stmt->closeCursor();
    }

    public function getOneUser($id){
        $db = Repository::getBdd();
        $query = 'SELECT * FROM utilisateur WHERE id=:id';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $dbObject[] = new User($data);
        }

        return $dbObject;

        $stmt->closeCursor();
    }

    public function findUserByEmailOrUsername($nomUtilisateur, $email)
    {
        $db = Repository::getBdd();
        $query = 'SELECT * FROM utilisateur WHERE nom_utilisateur=:nomUtilisateur OR email=:email';
        $stmt = $db->prepare($query);
        $stmt->bindParam(":nomUtilisateur", $nomUtilisateur);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_OBJ);

        // var_dump($email);
        // var_dump($result);
        if(!empty($result->nom_utilisateur)){
            return $result;
        }else{
            return false;
            echo "false";
        }
    }

    public function register($data)
    {
        $db = Repository::getBdd();
        $query = "INSERT INTO utilisateur (nom_utilisateur, email, mdp) VALUES (:nomUtilisateur, :email, :mdp)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":nomUtilisateur", $data['nomUtilisateur']);
        $stmt->bindParam(":email", $data['email']);
        $stmt->bindParam(":mdp", $data['mdp']);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function login($nomOuEmail, $mdp)
    {
        $result = $this->findUserByEmailOrUsername($nomOuEmail, $nomOuEmail);

        if($result == false) return false;

        $hashedPassword = $result->mdp;
        if(password_verify($mdp, $hashedPassword)){
            //var_dump($result);
            return $result;
        }else{
            return false;
        }

    }

}

