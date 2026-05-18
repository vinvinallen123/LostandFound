<?php

require_once "../models/database.php";
require_once "../models/adminModel.php";

class adminManager {

    private $adminModel;

    public function __construct() {
        $db = new Database();
        $this->adminModel = new AdminModel($db->connectionDB());
    }

    public function addAdminFunc($firstName, $lastName, $email, $username, $password): void {

        $existing = $this->adminModel
            ->checkAdmin($email, $username)
            ->fetch(PDO::FETCH_ASSOC);

        if ($existing) {
            echo "Email or username already exists";
            return;
        }

        if ($this->adminModel->createAdmin($firstName, $lastName, $email, $username, $password)) {
            echo "successfully registered";
        } else {
            echo "Error registering admin";
        }
    }

    public function loginAdminFunc($username, $password): void {

        $admin = $this->adminModel
            ->loginAdmin($username)
            ->fetch(PDO::FETCH_ASSOC);

        if (!$admin) {
            echo "Invalid username or password";
            return;
        }

        if (password_verify(trim($password), $admin["admin_pass"])) {

            

            $_SESSION["admin_id"] = $admin["admin_id"];
            $_SESSION["admin_username"] = $admin["admin_username"];
            $_SESSION["admin_email"] = $admin["admin_email"];
            $_SESSION["admin_firstname"] = $admin["admin_firstname"];
            $_SESSION["admin_lastname"] = $admin["admin_lastname"];

            echo "Login successful";

        } else {
            echo "Invalid username or password";
        }
    }
}
?>