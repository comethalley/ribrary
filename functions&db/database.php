<?php

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "db_eread";

$connect = mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);

// If connection fail: die
if(!$connect){
    die("Connection failed: ".mysqli_connect_error());
}