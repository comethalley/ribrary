<?php
 include_once("Login.html");
 error_reporting(E_ALL ^ E_NOTICE);
 $mysqli = new mysqli("localhost", "root", "", "db_eread");

 if($mysqli === false){
 die("ERROR: Could not connect. " . $mysqli->connect_error);
 }
  
    $user = $mysqli->real_escape_string($_POST["UserName"]);
    $password = $mysqli->real_escape_string($_POST["Password"]);

    $sql = "SELECT * FROM login_tbl WHERE username = '".$user."' AND password = '".$password."' ";
    
    $result = $mysqli-> query($sql);

    if(mysqli_num_rows($result) == 1 ){
        echo "Successfully login";
    }

$mysqli->close();

?>