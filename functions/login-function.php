<?php

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

