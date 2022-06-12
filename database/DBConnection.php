<?php

namespace Database;

use PDO;

class DBConnection
{
    private static $pdo;

    private static function setPDO(){
        self::$pdo = new PDO('mysql:host=localhost;dbname=blog_database;charset=utf8', 'root', '',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ]);

    }

    public static function getPDO(){
        if (self::$pdo == null) {
            self::setPDO();
            return self::$pdo;
        }
        return self::$pdo;
    }
}
