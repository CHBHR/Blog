<?php

namespace Database;

use PDO;

class Repository
{
    private static $pdo;

    private static function setPDO(){
        self::$pdo = new PDO('mysql:host=localhost;dbname=blog_database;charset=utf8', 'root', '',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ]);
        //self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING, PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }

    public static function getPDO(){
        if (self::$pdo == null) {
            self::setPDO();
            return self::$pdo;
        }
        return self::$pdo;
        //return self::$pdo ?? self::setPDO();
    }

    // private function sanitizeString($string)
    // {
    //     $string = strip_tags($string);
    //     $string = str_replace(" ","",$string);
    //     return $string;
    // }

    // private function sanitizePassword($string)
    // {
    //     $string = md5($string);
    //     return $string;
    // }

    // public function execute(){
    //     return $this->stmt->execute();
    // }

    // public function single(){
    //     $this->execute();
    //     return $this->stmt->fetch(PDO::FETCH_OBJ);
    // }

    // public function rowCount(){
    //     return $this->stmt->rowCount();
    // }
}