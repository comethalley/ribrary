<?php

if(isset($_POST['updateData'])){
    $data = $_POST['realUserId'];
    $data1 = $_POST['first-name'];
    $data2 = $_POST['last-name'];
    $data3 = $_POST['email'];

    echo $data;
    echo $data1;
    echo $data2;
    echo $data3;
}

