<?php

function dbConnect()
{
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=blog_database;charset=utf8', 'root', '');
        return $db;
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
}
