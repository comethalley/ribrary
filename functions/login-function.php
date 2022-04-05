<?php

// if user submit button
if (isset($_POST['submit'])) {
    include '../includes/autoload-class.php';

    $email =  $_POST['email'];
    $pass =  $_POST['pass'];

    $user = new User();

    //If any of the field is empty function will return true
    if ($user->emptyInputLogin($email,$pass) === true) {
        header("Location:../webpage/Login-and-SignUp-page.html?error=emptyField");
        exit();
    }

    $user->loginUser($email,$pass);
} else {
    header("Location:../webpage/Login-and-SignUp-page.html?error=error");
    exit();
}

