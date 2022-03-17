<?php

// $dbServername = "localhost";
// $dbUsername = "root";
// $dbPassword = "";
// $dbName = "db_eread";

// $connect = mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);

// // If connection fail: die
// if(!$connect){
//     die("Connection failed: ".mysqli_connect_error());
// }

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";

try {
    $connect = new PDO("mysql:host=$dbServername;dbname=db_eread", $dbUsername, $dbPassword);
    // set the PDO error mode to exception
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
