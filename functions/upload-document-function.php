<?php
session_start();

if (isset($_POST['submit'])) {
    include '../includes/autoload-class.php';

    $fulllname = $_SESSION["first-name"] . ' ' . $_SESSION["last-name"];
    $createdBy = $fulllname;
    $categories = $_POST['categories'];
    $abstract = $_POST['abstract'];
    $file = $_FILES['file'];

    $user = new User();

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
    $allowed = array('pdf', 'doc', 'docx');


    $user->checkDocuments($allowed,$fileActualExt,$fileError,$fileSize,$fileTmpName,$createdBy,$fileName,$categories,$abstract);
   
}
