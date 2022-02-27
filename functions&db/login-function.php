<?php
//  include_once("Login.html");
//  error_reporting(E_ALL ^ E_NOTICE);
//  $mysqli = new mysqli("localhost", "root", "", "db_eread");

//  if($mysqli === false){
//  die("ERROR: Could not connect. " . $mysqli->connect_error);
//  }
  
//     $user = $mysqli->real_escape_string($_POST["UserName"]);
//     $password = $mysqli->real_escape_string($_POST["Password"]);

//     $sql = "SELECT * FROM login_tbl WHERE username = '".$user."' AND password = '".$password."' ";
    
//     $result = $mysqli-> query($sql);

//     if(mysqli_num_rows($result) == 1 ){
//         echo "Successfully login";
//     }

// $mysqli->close();

// if user submit button
if (isset($_POST['submit'])) {
    $user =  $_POST['username'];
    $pass =  $_POST['pass'];

    include_once  'database.php';
    include_once  'functions.php';

    //If any of the field is empty function will return true
    if (emptyInputLogin($user,$pass) === true) {
        header("Location:../webpage/Login.php?error=emptyField");
        exit();
    }

    loginUser($connect,$user,$pass);
} else {
    header("Location:../webpage/Login.php?error=error");
    exit();
}

