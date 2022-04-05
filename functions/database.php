<?php

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";

try {
    $connect = new PDO("mysql:host=$dbServername;dbname=db_eread", $dbUsername, $dbPassword);
    
    // set the PDO error mode to exception
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
