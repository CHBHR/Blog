<?php

declare(strict_types=1);

abstract class Model
{

    private static $_bdd;

    //connexion à la bdd

    private static function setBdd(){
        self::$_bdd = new PDO('mysql:host=localhost;dbname=blog_database;charset=utf8', 'root', '');

        //constantes de PDO pour gerer les erreurs
        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    //connection par defaut
    protected function getBdd(){
        if (self::$_bdd == null) {
            self::setBdd();
            return self::$_bdd;
        }
    }

    //recuperation des elements en bdd
    protected function getAll($table, $obj){
        $this->getBdd();
        $dbObjects = [];
        $requete = self::$_bdd->prepare("SELECT * FROM ".$table." ORDER BY id desc");
        $requete->execute();

        //on cree la variable data pour contenir les donnees de la table cible
        while ($data = $requete->fetch(PDO::FETCH_ASSOC)){
            //dbObjects contiendra les données sous forme d'objet
            $dbObjects[] = new $obj($data);
        }

        return $dbObjects;
        $requete->closeCursor();
    }

}
