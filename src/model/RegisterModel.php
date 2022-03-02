<?php 

    declare(strict_types = 1);

    require_once(__DIR__ . '/Db.php');

    class RegisterModel extends Db {

        /**
         * @param array
         * @return array
         * 
         * @desc Creates and returns a user record
         */
        public function createUser(array $utilisateur) :array
        {
            $this->query("INSERT INTO 'utilisateur' (nom_utilisateur, email, mdp) VALUES (:nomUtilisateur, :email, :mdp");
            $this->bind('nom_utilisateur', $utilisateur['nomUtilisateur']);
            $this->bind('email', $utilisateur['email']);
            $this->bind('mdp', $utilisateur['mdp']);

            if ($this->execute()) {
                $response = array(
                    'status' => true,
                );
                return $response;
            } else {
                $response = array(
                    'status' => false
                );
                return $response;
            }
        }

        /**
         * @param string
         * @return array
         * 
         * @desc Returns a user record based on the method parameter
         */
        public function fetchUser(string $email) :array
        {
            $this->query("SELECT * FROM 'utilisateur' WHERE 'email' = :email");
            $this->bind('email', $email);
            $this->execute();

            $utilisateur = $this->fetch();
            if (!empty($utilisateur)) {
                $response = array(
                    'status' => true,
                    'data' => $utilisateur
                );
                return $response;
            }
            return array(
                'status' => false,
                'data' => []
            );
        }
    }
    ?>

        