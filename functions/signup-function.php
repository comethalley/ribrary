<?php

// if user submit button
if (isset($_POST['submit'])) {
    include '../includes/autoload-class.php';

    $first =  $_POST['fname'];
    $last =  $_POST['lname'];
    $email =  $_POST['email'];
    $pass =  $_POST['pass'];
    $re_pass =  $_POST['re-pass'];

    $user = new User();


    //function for error handling

    //If any of the field is empty function will return true
    if ($user->emptyInputSignUp($first, $last, $email, $pass,$re_pass) == true) {
        header("Location:../webpage/Login-and-SignUp-page.html?error=emptyfield");
        exit();
    }
    // if user email is invalid return true
    if ($user->invalidEmail($email) == true) {
        header("Location:../webpage/Login-and-SignUp-page.html?error=invalidEmail");
        exit();
    }
    // if password not match return true
    if ($user->passNotMatch($pass, $re_pass) == true) {
        header("Location:../webpage/Login-and-SignUp-page.html?error=passnotmatch");
        exit();
    }

    //if email alreadu exist return true
    if ($user->emailExist($email) == true) {
        header("Location:../webpage/Login-and-SignUp-page.html?error=emailExist");
        exit();
    }
    
    // create user in the database
   $user->createUser($first, $last, $email, $pass);

} else {
    header("Location:../webpage/Login-and-SignUp-page.html?error=error");
    exit();
}
