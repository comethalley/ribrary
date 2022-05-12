<?php
session_start();

if (isset($_POST['upload-podcast'])) {
    include '../includes/autoload-class.php';
    $admin = new Admin();

    $admin_name = $_SESSION["admin_name"];
    $host = $_POST['channel'];
    $file = $_FILES['file'];
  
    //file data
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    //seperate the filename and its extension
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));


    // print_r($fileActualExt);
    //allowed documents
    $allowed = array('pdf','jpg','png','mp4');

    $admin->checkPodcast($allowed,$fileActualExt,$fileError,$fileTmpName,$admin_name,$fileName,$host);
   
}
