<?php

declare(strict_types=1);

class Repository
{
    private static $_bdd;

    private static function setBdd(){
        self::$_bdd = new PDO('mysql:host=localhost;dbname=blog_database;charset=utf8', 'root', '');
        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    protected static function getBdd(){
        if (self::$_bdd == null) {
            self::setBdd();
            return self::$_bdd;
        }
        return self::$_bdd;
    }

    private function sanitizeString($string)
    {
        $string = strip_tags($string);
        $string = str_replace(" ","",$string);
        return $string;
    }

    private function sanitizePassword($string)
    {
        $string = md5($string);
        return $string;
    }

    public function execute(){
        return $this->stmt->execute();
    }

    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    public function rowCount(){
        return $this->stmt->rowCount();
    }
}