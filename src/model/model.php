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
        $query = self::$_bdd->prepare("SELECT * FROM ".$table." ORDER BY id desc");
        $query->execute();

        //on cree la variable data pour contenir les donnees de la table cible
        while ($data = $query->fetch(PDO::FETCH_ASSOC)){
            //dbObjects contiendra les données sous forme d'objet
            $dbObjects[] = new $obj($data);
        }

        return $dbObjects;
        $query->closeCursor();
    }

    protected function getOne($table, $obj, $id)
    {
        $this->getBdd();
        $dbObject = [];
        $query = self::$_bdd->prepare("SELECT * FROM ".$table." WHERE id = ?");
        $query->execute(array($id));
        while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $dbObject[] = new $obj($data);
        }

        return $dbObject;
        $query->closeCursor();
    }

    protected function addArticle($table)
    {
        $this->getBdd();
        $query = self::$_bdd->prepare("INSERT INTO ".$table." (titre, chapo, contenu, auteur_id) VALUES (?, ?, ?, ?)");
        $query->execute(array($_POST['titre'], $_POST['chapo'], $_POST['contenu'], 1));
        $query->closeCursor();
    }

    protected function deleteOne($table, $id)
    {
        $this->getBdd();
        $query = self::$_bdd->prepare("DELETE FROM ".$table." WHERE id = :id");
        $query->bindParam(":id", $id);
        $query->execute();
        $query->closeCursor();
    }

    protected function updateOne($table,$id)
    {
        $this->getBdd();
        $query = self::$_bdd->prepare("UPDATE ".$table." SET titre=:titre, chapo=:chapo, contenu=:contenu WHERE id=:id");
        $query->bindParam("titre", $_POST['titre']);
        $query->bindParam("chapo", $_POST['chapo']);
        $query->bindParam("contenu", $_POST['contenu']);
        // $query->bindParam("dateMAJ", date("d-m-Y"));
        $query->bindParam("id", $id);
        $query->execute();
        $query->closeCursor();
    }

    //from tuto
    //execute the prepare statement
    protected function query($sql)
    {
        $this->getBdd();
        return self::$_bdd->prepare($sql);
    }

    //Binnd values to prepare statement using parameters
    public function bind($param, $value, $type = null)
    {
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                $type = PDO::PARAM_STR;
            }
            $this->stmt->bindValue($param,$value, $type);
        }
    }

    // public function execute()
    // {
    //     return $this->execute();
    // }

    //return multiple records as array
    // public function resultSet()
    // {
    //     $this->getBdd();
    //     $stmt = self::$_bdd;
    //     $this->execute();
    //     return $stmt->fetchAll(PDO::FETCH_OBJ);
    // }

    //return single object
    // public function single()
    // {
    //     $this->getBdd();
    //     $dbObject = [];
    //     $query = self::$_bdd->prepare("SELECT * FROM ".$table." WHERE id = ?");
    //     $query->execute(array($id));
    //     while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
    //         $dbObject[] = new $obj($data);
    //     }

    //     return $dbObject;
    //     $query->closeCursor();

    //     $this->getBdd();
    //     $stmt = self::$_bdd;
    //     $this->execute();
    //     return $stmt->fetch(PDO::FETCH_OBJ);
    // }

    //Get row count
    public function rowCount()
    {
        $this->getBdd();
        $stmt = self::$_bdd;
        return $stmt->rowCount();
    }

}
