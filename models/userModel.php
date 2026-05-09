<?php

class UserModel {

    private $connect;

    public function __construct($db)
    {
        $this->connect = $db;
    }

  public function createUser($fName, $lName, $email, $username, $password): mixed {

    $insertQuery = "INSERT INTO users_tbl (first_name, last_name, user_email, user_name, user_password, created_at, updated_at)  VALUES (:first_name, :last_name, :user_email, :user_name, :user_password, :created_at, :updated_at)";

                  
    $dateNow = date('Y-m-d H:i:s');



        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);        


    $response = $this->connect->prepare($insertQuery);
    $response->bindParam(":first_name", $fName);
    $response->bindParam(":last_name", $lName);
   
    $response->bindParam(":user_email", $email);
    $response->bindParam(":user_name", $username);
    $response->bindParam(":user_password", $hashedPassword);
    $response->bindParam(":created_at", $dateNow);
    $response->bindParam(":updated_at", $dateNow);

    return $response->execute();
}


    public function checkUser($email, $username): mixed {

        $selectQuery = "SELECT * FROM users_tbl 
              WHERE user_email = :user_email OR user_name = :user_name";

        $response = $this->connect->prepare($selectQuery);

        $response->bindParam(":user_email", $email);
        $response->bindParam(":user_name", $username);

        $response->execute();

        return $response;
    }

    public function loginUser($username): mixed {

    $selectQuery = "SELECT * FROM users_tbl 
                    WHERE user_name = :user_name";

    $response = $this->connect->prepare($selectQuery);
    $response->bindParam(":user_name", $username);
    $response->execute();

    return $response;
}
    

public function readUser(): mixed {
$selectQuery = "SELECT * FROM users_tbl";
$response = $this->connect->prepare($selectQuery);
$response->execute();
return $response;
}

public function updateUser($uID, $fName, $lName): mixed {
    $updateQuery = "UPDATE users_tbl SET first_name = :first_name, last_name = :last_name, updated_at = :updated_at WHERE user_id = :user_id";
        $response = $this->connect->prepare($updateQuery);

        $dateNow = date('Y-m-d H:i:s');

        $response->bindParam(":first_name", $fName);
        $response->bindParam(":last_name", $lName);
        $response->bindParam(":user_id", $uID);
        $response -> bindParam(":updated_at", $dateNow);
        $response->execute();
        return $response;
}



        public function deleteUser($uID): mixed{
            $deleteQuery = "DELETE FROM users_tbl WHERE user_id = :user_id";
            $response= $this->connect->prepare($deleteQuery);
            $response->bindParam(":user_id", $uID);
            $response->execute();
            return $response;

        }


        public function readAdvancedUser(): mixed{
            $selectQuery = "SELECT * FROM users_tbl INNER JOIN tbl_departments ON users_tbl.deptID = tbl_departments.deptID";
          $response = $this->connect->prepare($selectQuery);
            $response->execute();
        return $response;
}
        }




?>