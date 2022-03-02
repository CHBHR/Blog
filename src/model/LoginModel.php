<?php 

    declare(strict_types = 1);

    require_once(__DIR__ . '/Db.php');

    class LoginModel extends Db {

        /**
         * @param string
         * @return array
         * 
         * @desc Returns a user record based on the method parameter
         */
        public function fetchEmail(string $email) :array
        {
            $this->query("SELECT * FROM 'utilisateur' WHERE 'email' = :email");
            $this->bind('email', $email);
            $this->execute();

            $email = $this->fetch();
            if (empty($email)) {
                $response = array(
                    'status' => true,
                    'data' => $email
                );

                return $response;
            }

            if (!empty($email)) {
                $response = array(
                    'status' => false,
                    'data' => $email
                );

                return $response;
            }
        }
    }
    ?>
