<?php
//   $user = $_POST['username'];
//   echo $user;
if ($_POST['username'] !== '' && $_POST['password'] !== '') {
    include '../includes/autoload-class.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $admin = new Admin();

    //If any of the field is empty function will return true
    if ($admin->emptyInputLogin($email, $password) === true) {
        header("Location:../admin/index.php?error=emptyField");
        exit();
    }
    // // if user email is invalid return true
    if ($admin->invalidEmail($email) == true) {
        header("Location:../admin/index.php?error=invalidEmail");
        exit();
    }

    $admin->loginAdmin($email, $password);
} else {
    header("Location:../admin/index.php?error=emptyInput");
    exit();
}
