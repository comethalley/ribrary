<?php
//   $user = $_POST['username'];
//   echo $user;
if($_POST['username'] !== '' && $_POST['password'] !== ''){
    $username = $_POST['username'];
    $password = $_POST['password'];

    include_once  'database.php';
    include_once  'functions.php';


     //If any of the field is empty function will return true
     if (emptyInputLogin($username,$password) === true) {
        header("Location:../webpage/admin-login.php?error=emptyField");
        exit();
    }

    loginAdmin($connect,$username,$password);


}else{
    header("Location:../webpage/admin-login.php?error=emptyInput");
    exit();
}