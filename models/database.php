<?php
date_default_timezone_set("Asia/Manila");
class Database {

    private $host = "localhost";
    private $dbName = "lostandfoundsystem"; 
    private $username = "root";    
    private $password = "";                 

    public function connectionDB(): PDO {
        try {
            $connect = new PDO(
                "mysql:host=$this->host;dbname=$this->dbName",
                $this->username,
                $this->password
            );

            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $connect;

        } catch (PDOException $e) {
            die("Connection Failed: " . $e->getMessage());
        }
    }
}

?>