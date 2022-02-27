<?php

// if user submit button
if (isset($_POST['submit'])) {
    include_once 'database.php';
    include_once 'functions.php';

    $first =  $_POST['first'];
    $last =  $_POST['last'];
    $email =  $_POST['email'];
    $pass =  $_POST['pass'];


    //function for error handling

    //If any of the field is empty function will return true
    if (emptyInputSignUp($first, $last, $email, $pass) == true) {
        header("Location:../webpage/Login.php?error=emptyfield");
        exit();
    }
    // if user email is invalid return true
    if (invalidEmail($email) == true) {
        header("Location:../webpage/Login.php?error=invalidEmail");
        exit();
    }
    // // if password not match return true
    // if (passNotMatch($pass, $re_pass) == true) {
    //     header("Location:../webpage/Login.php?error=passnotmatch");
    //     exit();
    // }

    //if email alreadu exist return true
    if (emailExist($connect, $email) === true) {
        header("Location:../webpage/Login.php?error=emailExist");
        exit();
    }
    
    // create user in the database
    createUser($connect, $first, $last, $email, $pass);

} else {
    header("Location:../webpage/Login.php?error=error");
    exit();
}
