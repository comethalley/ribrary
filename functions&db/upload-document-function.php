<?php
if (isset($_POST['submit'])){

    $user = 'admin';
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('pdf','doc','docx');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize > 1000){
                $fileNameNew = uniqid ('', true).".".$fileActualExt;
                $fileDestination = 'uploads/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                header("Location: ../webpage/upload-document.php?uploadsuccess");

                //$sql = "INSERT INTO tbl_book (BookName,BookFile, createdBy) VALUES ('".$fileName."','".$fileTmpName."','".$user."',)";
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