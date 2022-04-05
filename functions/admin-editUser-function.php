<?php

if (isset($_POST['updateData'])) {
    include '../includes/autoload-class.php';
    $admin = new Admin();

    $id = $_POST['realUserId'];
    $fname = $_POST['first-name'];
    $lname = $_POST['last-name'];
    $username = $_POST['email'];

    //check if varable has value 
    if (empty($fname) || empty($lname) || empty($username)) {
        header("Location:../admin/admin-users.php?error=inputAllFields");
        exit();
    }

    $admin->updateUser($id, $fname, $lname, $username);
}
