<?php
session_start();

if (isset($_POST['upload-ebooks'])) {
    include '../includes/autoload-class.php';
    $admin = new Admin();

    $admin_name = $_SESSION["admin_name"];
    $categories = $_POST['categories'];
    $author = $_POST['author'];
    $synopsis = $_POST['synopsis'];
    $file = $_FILES['file'];
    $file2 = $_FILES['file2'];

    //file data
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    //file2 data 
    $file2Name = $_FILES['file2']['name'];
    $file2TmpName = $_FILES['file2']['tmp_name'];
    $file2Size = $_FILES['file2']['size'];
    $file2Error = $_FILES['file2']['error'];
    $file2Type = $_FILES['file2']['type'];

    //seperate the filename and its extension - file
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    //seperate the filename and its extension - file2
    $file2Ext = explode('.', $file2Name);
    $file2ActualExt = strtolower(end($file2Ext));

    $allowed = array('pdf');
    $allowed2 = array('png', 'jpg');

    echo $fileName;
    echo $file2Name;
    echo $author;
    echo $synopsis;
    echo $categories;
    if ($fileError === 0 && $file2Error === 0) {

        $admin->checkEbooks($allowed, $allowed2, $fileActualExt, $file2ActualExt, $fileName, $fileTmpName, $file2TmpName, $admin_name, $categories, $synopsis, $author);
    } else {
        echo "There was an error while uploading the file";
        exit();
    }
}
