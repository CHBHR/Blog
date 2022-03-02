<?php 

    declare(strict_types=1);

    require_once(__DIR__ . '/Controller.php');
    require_once('../model/LoginModel.php');

    class Login extends Controller {

        public $active = 'login';
        private $loginModel;

        /**
         * @param null|void
         * @return null|void
         * 
         * @desc Checks if the user session is set and creates a new instance of the LoginModel
         */
        public function __construct()
        {
            if (isset($_SESSION['auth_status'])) header("Location: dashboard.php");
            $this->loginModel = new LoginModel();
        }

        /**
         * @param array
         * @return array|booloean
         * 
         * @desc Verifies and redirects a user by calling the login method on the LoginModel
         */
        public function login(array $data)
        {
            $email = stripcslashes((strip_tags($data['email'])));
            $mdp = stripcslashes(strip_tags($data['mdp']));

            $emailRecords = $this->loginModel->fetchEmail($email);

            if (!$emailRecords['status']) {
                if (password_verify($mdp, $emailRecords['data']['mdp'])) {
                    //check if the remember_me was selected
                    $response = array(
                        'status' => true
                    );

                    $_SESSION['data'] = $emailRecords['data'];
                    $_SESSION['auth_status'] = true;
                    header("Location: dashboard.php");
                }

                $response = array(
                    'status' => false,
                );
                return $response;
            }

            $response = array(
                'status' =>false,
            );
            return $response;
        }
    }
    ?>
    