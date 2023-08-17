<?php

class Config{
    private $serverName;
    protected $userName;
    private $password;
    private $database;

    public function conn(){

        $this->serverName = 'localhost';
        $this->userName = 'root';
        $this->password = '';
        $this->database = 'fine_renovation';

        $conn = mysqli_connect($this->serverName,$this->userName,$this->password,$this->database);

        if(!$conn){
            echo "Database Connection Error";
        }
        // else{
        //     echo "Database Connected";
        // }

        return $conn;
    }
}
