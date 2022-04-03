<?php

namespace App\Models;

use PDO;
use Database\DBConnection;

abstract class Model{

    protected $db;
    protected $table;

    public function __construct(DBConnection $db)
    {
        $this->db = $db;
    }

    public function getAll(): array
    {
        $stmt = $this->db::getPDO()->query("SELECT * FROM {$this->table} ORDER BY date_creation DESC");
        /**
         * PDOStatement::setFetchMode vas nous permettre d'instancier notre classe pendant le fetch. Il faut lui préciser le Fetch mode, le nom/namespace de la classe et le constructor arg, ici la connection à la base de donnée pour une classe comme Article
         */
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this),[$this->db]);
        return $stmt->fetchAll();
    }

    public function findById(int $id): Model
    {
        $stmt = $this->db::getPDO()->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this),[$this->db]);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}