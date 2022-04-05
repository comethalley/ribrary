<?php
//   $user = $_POST['username'];
//   echo $user;
if($_POST['username'] !== '' && $_POST['password'] !== ''){
    include '../includes/autoload-class.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    $admin = new Admin();
     //If any of the field is empty function will return true
     if ($admin->emptyInputLogin($username,$password) === true) {
        header("Location:../admin/admin-login.php?error=emptyField");
        exit();
    }

    $admin->loginAdmin($username,$password);


}else{
    header("Location:../admin/admin-login.php?error=emptyInput");
    exit();
}