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
        return $this->queryModel("SELECT * FROM {$this->table} ORDER BY date_creation DESC");
    }

    public function findById(int $id): Model
    {
        return $this->queryModel("SELECT * FROM {$this->table} WHERE id = ?", $id, true);
    }

    public function destroy(int $id): bool
    {
        return $this->queryModel("DELETE FROM {$this->table} WHERE id = ?", $id);
    }

    /**
     * Pour éviter les répétitions sur les requetes sql
     * Penser à changer le type int de param si on a besoin d'autre chose que d'un entier
     * return Model | array  void
     */
    public function queryModel(string $sql, int $param = null, bool $single = null)
    {
        $method = is_null($param) ? 'query' : 'prepare';

        /**
         * On check la position des mots clef Delete, Update et Create. Si en début de query on adapte la fonction pour ne pas fetch
         */
        if (strpos($sql, 'DELETE') === 0
            || strpos($sql, 'UPDATE') === 0
            || strpos($sql, 'CREATE') === 0) {

            $stmt = $this->db::getPDO()->$method($sql);
            $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this),[$this->db]);
            return $stmt->execute([$param]);
        }

        $fetch = is_null($single) ? 'fetchAll' : 'fetch';

        $stmt = $this->db::getPDO()->$method($sql);
        /**
         * PDOStatement::setFetchMode vas nous permettre d'instancier notre classe pendant le fetch. Il faut lui préciser le Fetch mode, le nom/namespace de la classe et le constructor arg, ici la connection à la base de donnée pour une classe comme Article
         */
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this),[$this->db]);

        if ($method === 'query'){
            return $stmt->$fetch();
        } else {
            $stmt->execute([$param]);
            return $stmt->$fetch();
        }
    }
}