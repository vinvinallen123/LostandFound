<?php

class AdminModel {

    private $connect;

    public function __construct($db)
    {
        $this->connect = $db;
    }

    public function createAdmin($fName, $lName, $email, $username, $password): mixed {

        $query = "INSERT INTO admins_tbl 
        (admin_username, admin_pass, logged_at, signedoff_at, admin_email, admin_firstname, admin_lastname)
        VALUES 
        (:username, :pass, :logged_at, :signedoff_at, :email, :fname, :lname)";

        $stmt = $this->connect->prepare($query);

        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $now = date('Y-m-d H:i:s');

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":pass", $hashed);
        $stmt->bindParam(":logged_at", $now);
        $stmt->bindParam(":signedoff_at", $now);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":fname", $fName);
        $stmt->bindParam(":lname", $lName);

        return $stmt->execute();
    }

    public function checkAdmin($email, $username): mixed {

        $query = "SELECT * FROM admins_tbl 
                  WHERE admin_email = :email OR admin_username = :username";

        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":username", $username);

        $stmt->execute();
        return $stmt;
    }

    public function loginAdmin($username): mixed {

        $query = "SELECT * FROM admins_tbl 
                  WHERE admin_username = :username";

        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(":username", $username);

        $stmt->execute();
        return $stmt;
    }
}
?>