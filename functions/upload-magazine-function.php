<?php
session_start();

if (isset($_POST['submit'])){
    include_once 'database.php';
    include_once 'functions.php';

    $fulllname = $_SESSION["first-name"].' '.$_SESSION["last-name"];
    $createdBy = $fulllname;
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

    //allowed documents
    $allowed = array('pdf');

    //check if the file extension is in the array $allowed
    if (in_array($fileActualExt, $allowed)) {
        //check if there is no error uploading the file
        if ($fileError === 0) {
            //check the file size
            if ($fileSize > 1000){
                // $fileNameNew = uniqid ('', true).".".$fileActualExt;
                $fileNameNew = uniqid ('', true).".".$fileActualExt;
                $fileDestination = 'uploads/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                $userId = $_SESSION["id"];
                upload_docu($connect, $fileName, $fileTmpName,$fileNameNew, $createdBy,$userId);
            } else {
                echo "The file was too large";
            }
        } else{
            echo "There was an error while uploading the file";
        }
    } else {
        echo "You can't upload this type of file!";
    }
}
?>