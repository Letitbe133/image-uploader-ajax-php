<?php

class Database {

    // DB params
    private $host = 'localhost';
    private $dbname = 'images';
    private $username = 'letitbe133';
    private $password = 'Tinjiful';
    private $conn;

    public function connect() {

        $this->conn = null;

        try {
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ];
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8", $this->username, $this->password, $options);
            // echo 'Successfully connected to database';
        } catch (PDOException $error) {
            echo "Error connecting to database : $error->getMessage()";
        }

        return $this->conn;
    }

}