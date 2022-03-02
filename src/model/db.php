<?php

declare(strict_types = 1);

    class Db {

        protected $dbName = 'blog_database';
        protected $dbHost = 'localhost';
        protected $dbUSer = 'root';
        protected $dbPass = '';
        protected $dbHandler, $dbStmt;

        /**
         * @desc Creates or resume an existing database connection
         */
        public function __construct()
        {
            //create a dsn ressource
            $dsn = "mysql:host=" . $this->dbHost . ';dbname=' . $this->dbName;

            //create a pdo options array
            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );
            
            try {
                $this->dbHandler = new PDO($dsn, $this->dbUSer, $this->dbPass, $options);
            } catch (Exception $e) {
                var_dump("Couldn't establish a database connection due to the following: " . $e->getMessage());
            }
        }

        /**
         * @desc Creates a PDO statement object
         */
        public function query($query)
        {
            $this->dbStmt = $this->dbHandler->prepare($query);
        }

        /**
         * @param string|integer
         * @return null|void
         * 
         * @desc Matches the correct datatype to the PDO Statement object
         */
        public function bind($param, $value, $type = null)
        {
            if (is_null($type)) {
                switch (true) {
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
                    break;
                }
            }

            $this->dbStmt->binValue($param, $value, $type);
        }

        /**
         * @desc Executes a PDO statement object or a db query
         */
        public function execute()
        {
            $this->dbStmt->execute();
            return true;
        }

        /**
         * @desc Executes a PDO Statement Object and returns a single database record as an associative array
         */
        public function fetch()
        {
            $this->execute();
            return $this->dbStmt->fetch(PDO::FETCH_ASSOC);
        }

        /**
         * @desc Executes a PDO Statement Object and returns multiple database record as an associative array
         */
        public function fetechAll()
        {
            $this->execute();
            return $this->dbStmt->fetechAll(PDO::FETCH_ASSOC);
        }

    }

$host = 'localhost';
$db = 'blog_database';
$user = 'root';
$pass = '';
$port = '3306';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;port=$port;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try{
    $pdo = new \PDO($dsn, $user, $pass, $options);
    echo 'Databse connexion established';
} catch (\PDOException $e){
    throw new \PDOException($e->getMessage(), $e->getCode());
}