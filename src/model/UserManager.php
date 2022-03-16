<?php

declare(strict_types=1);

class UserManager extends Model
{
    private $_bdd;

    public function __construct()
    {
    }
    //trouve un utilisateur avec son email ou nomUtilisateur
    public function findUserByEmailOrUsername($email, $nomUtilisateur)
    {
        $_bdd = $this->getBdd();
        $query = $_bdd->prepare('SELECT * FROM utilisateur WHERE nom_utilisateur = :nomUtilisateur OR email = :email');
        $query->bindParam("nom_utilsateur", $nomUtilisateur);
        $query->bindParam("email", $email);
        $query->execute();
        
        $row = 0;

        if($this->_bdd->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }
}