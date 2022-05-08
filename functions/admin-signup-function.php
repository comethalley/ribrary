<?php

// if user submit button
if ($_POST['email'] !== '' && $_POST['password'] !== ' ') {
include '../includes/autoload-class.php';

$fullname =  $_POST['fullname'];
$email =  $_POST['email'];
$re_pass =  $_POST['repeat-password'];
$pass =  $_POST['password'];


$admin = new Admin();

//function for error handling
//If any of the field is empty function will return true
if ($admin->emptyInputSignUp($fullname, $email, $pass, $re_pass) == true) {
    header("Location:../admin/sign-up.php?error=emptyfield");
    exit();
}
// // if user email is invalid return true
if ($admin->invalidEmail($email) == true) {
    header("Location:../admin/sign-up.php?error=invalidEmail");
    exit();
}
// // if password not match return true
if ($admin->passNotMatch($pass, $re_pass) == true) {
    header("Location:../admin/sign-up.php?error=passnotmatch");
    exit();
}

//if email alreadu exist return true
if ($admin->adminExist($email) == true) {
    header("Location:../admin/sign-up.php?error=emailExist");
    exit();
}

//     create admin in the database
$admin->createUser($fullname, $email, $pass);

}
// } else {
//     header("Location:../webpage/Login-and-SignUp-page.html?error=error");
//     exit();
// }
