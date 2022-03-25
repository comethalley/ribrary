<?php

if(isset($_POST['deleteData'])){


    include '../functions/functions.php';
    include '../functions/database.php';

    $id = $_POST['user_id'];

    deleteUser($connect,$id);
}