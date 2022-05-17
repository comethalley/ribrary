<?php
session_start();
include '../includes/autoload-class.php';
$user = new User();

if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $contact_no = $_POST['contact_no'];

    $user->updateUserData($firstname, $lastname, $email, $address, $contact_no, $_SESSION['id']);
}

if (isset($_POST['update-profile'])) {

    //file data
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    //seperate the filename and its extension - file
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    if ($fileError == 0) {
        $user->updateUserProfile($fileName, $fileActualExt, $fileTmpName, $_SESSION['id']);
    } else {
        echo "There was an error while uploading the file";
        exit();
    }
}
