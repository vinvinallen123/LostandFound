<?php

require_once "../models/database.php";
require_once "../models/userModel.php";

class userManager {

    private $userModel;

    public function __construct() {
        $database = new Database();
        $db = $database->connectionDB();
        $this->userModel = new UserModel($db);
    }

    public function addUserFunc($firstName, $lastName, $email, $username, $password): void {
        try {
            $existingUser = $this->userModel->checkUser($email, $username)->fetch(PDO::FETCH_ASSOC);

            if ($existingUser) {
                echo "Email or username already exists";
                return;
            }

            if ($this->userModel->createUser($firstName, $lastName, $email, $username, $password)) {
                echo "User registered successfully";
            } else {
                echo "Error adding user to the database";
            }

        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
    }

    public function loginUserFunc($username, $password): void {
        try {
            $login = $this->userModel->loginUser($username)->fetch(PDO::FETCH_ASSOC);

            if ($login && password_verify($password, $login["user_password"])) {
                $_SESSION["user_id"] = $login["user_id"];
                $_SESSION["first_name"] = $login["first_name"];
                $_SESSION["last_name"] = $login["last_name"];
                $_SESSION["user_name"] = $login["user_name"];
                $_SESSION["user_email"] = $login["user_email"];

                echo "Login successful";
            } else {
                echo "Invalid username or password";
            }

        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
    }

}

?>