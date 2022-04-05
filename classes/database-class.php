<?php

class Database
{
    private $dbServername = "localhost";
    private $dbUsername = "root";
    private $dbPassword = "";

    protected function connect()
    {
        $connect = new PDO("mysql:host=$this->dbServername;dbname=db_eread", $this->dbUsername, $this->dbPassword);

        // set the PDO error mode to exception
        $connect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);

        return $connect;    
    }
}
