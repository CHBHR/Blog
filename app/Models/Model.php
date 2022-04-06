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
        return $this->queryModel("SELECT * FROM {$this->table} WHERE id = ?", [$id], true);
    }

    public function create(array $data)
    {
        // "INSERT INTO articles (titre, chapo, contenu, auteur_id) 
        // VALUES(:titre, :chapo, :contenu, :date_creation,:auteur_id)";

        $firstParethesis = "";
        $secondParenthesis = "";
        $i = 1;

        foreach ($data as $key => $value) {
            $comma = $i === count($data) ? " " : ", ";
            $firstParethesis .= "{$key}{$comma}";
            $secondParenthesis .= ":{$key}{$comma}";
            $i++;
        }

        return $this->queryModel(
            "INSERT INTO {$this->table} ($firstParethesis) 
            VALUES($secondParenthesis)"
            );
    }

    public function update(int $id, array $data, $updateDate = false)
    {
        $sqlRequestPart = "";
        $i = 1;

        foreach ($data as $key => $value) {
            $comma = $i === count($data) ? " " : ', ';
            /**
             * Ajoute la valeur de la clef renvoyer par le formulaire à la même clef dans un tableau grâce au Hypertext Preprocessor
             */
            $sqlRequestPart .= "{$key} = :{$key}{$comma}";
            $i++;
        }

        $data['id'] = $id;

        if ($updateDate === true) {
            return $this->queryModel("UPDATE {$this->table} SET {$sqlRequestPart}, date_mise_a_jour = NOW() WHERE id = :id", $data);
        } else {
            return $this->queryModel("UPDATE {$this->table} SET {$sqlRequestPart} WHERE id = :id", $data);
        }
    }

    public function destroy(int $id): bool
    {
        return $this->queryModel("DELETE FROM {$this->table} WHERE id = ?", [$id]);
    }

    /**
     * Pour éviter les répétitions sur les requetes sql
     * 
     * return Model | array  void
     */
    public function queryModel(string $sql, array $param = null, bool $single = null)
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
            return $stmt->execute($param);
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
            $stmt->execute($param);
            return $stmt->$fetch();
        }
    }
}