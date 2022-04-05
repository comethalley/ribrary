<?php

if(isset($_POST['deleteData'])){

    include '../includes/autoload-class.php';
    $admin = new Admin();

    $id = $_POST['user_id'];

    $admin->deleteUser($id);
}