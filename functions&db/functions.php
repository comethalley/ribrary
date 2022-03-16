<?php

//Empty field
function emptyInputSignUp($first, $last, $email, $pass)
{
    $result = "";
    if (empty($first) || empty($last) || empty($email) || empty($pass)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

//Empty field
function emptyInputLogin($user,$pass){
    $result = "";
    if (empty($user) || empty($pass) ) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// if not valid email 
function invalidEmail($email) {
    $result = "";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// if password match
// function passNotMatch($pass,$re_pass) {
//     $result = "";
//     if ($pass !== $re_pass) {
//         $result = true;
//     } else {
//         $result = false;
//     }
//     return $result;
// }


//if email exist 
function emailExist($connect,$email) {
    //template
    $sql = "SELECT * FROM tbl_user WHERE  Username = ?;";

    //prepared statement
    $stmt = mysqli_stmt_init($connect);

    //check if preparation fail 
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location:../login.php?error=stmtfail");
        exit();
    }

    //assign the variable to the placeholder and execute
    mysqli_stmt_bind_param($stmt,"s",$email);
    mysqli_stmt_execute($stmt);

    //get the result from database 
    $result = mysqli_stmt_get_result($stmt);

    // fetch the result then return it
    if($result = mysqli_fetch_assoc($result)){

        return $result;

    }else{
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}


// create new user to database
function createUser($connect,$first, $last, $email,$pass) {
    //template
    $sql = "INSERT INTO tbl_user (firstname,lastname,Username, password) VALUES (?,?,?,?);";
    //prepared statement
    $stmt = mysqli_stmt_init($connect);

    //check if preparation fail 
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location:../login.php?error=stmtfail");
        exit();
    }
    //hash the password 
    $hashedpwd = password_hash($pass,PASSWORD_DEFAULT);

    //assign the variable to the placeholder and execute
    mysqli_stmt_bind_param($stmt,"ssss",$first, $last, $email,$hashedpwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    //pass the data to userExist
    $userExist = emailExist($connect,$email,$pass);

    //start session and get data from userExist then store in session   
    session_start();
    $_SESSION["userFirst"] = $userExist["First_Name"];
    $_SESSION["userLast"] = $userExist["Last_Name"];

    //if sucess creating user, go to this 👇 page
    header("Location:../webpage/LandingPage.html?RegisteredSucesfully!");
    exit();
}

//login user 
function loginUser($connect,$username,$pass){
    //pass the data to userExst
    $userExist = emailExist($connect,$username);

    //check if it has data if not return false 
    if($userExist == false){
        header("Location:../webpage/Login.php?error=wrongUser");
        exit();
    }

    //hashed the password from database 
    $pwdHashed = $userExist['password'];
    $checkpwd = password_verify($pass,$pwdHashed)."\n";

    //if checkpwd has vale and equals 1
    if($checkpwd !== '' && $checkpwd == 1){

        //start session and get data from userExist then store in session   
        session_start();
        $_SESSION["userFirst"] = $userExist["First_Name"];
        $_SESSION["userLast"] = $userExist["Last_Name"];

        //if sucess creating user, go to this 👇 page
        header("Location:../webpage/LandingPage.html?LoginSucesfully!");
        exit();

    }else{
        //if password not match from user
        header("Location:../webpage/Login.php?error=wrongPassword");
        exit();
    }

}

function upload_docu($connect, $fileName, $fileTmpName, $createdBy) {
    //template
    $sql = "INSERT INTO tbl_book (BookName,BookFile,createdBy) VALUES (?,?,?);";
    //prepared statement
    $stmt = mysqli_stmt_init($connect);

    //check if preparation fail 
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: ../webpage/upload-document.php?uploadfailed");
    exit();
    }

    //assign the variable to the placeholder and execute
    mysqli_stmt_bind_param($stmt,'sss',$fileName, $fileTmpName, $createdBy);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);


    //if sucess uploading file, go to this 👇 page
    header("Location: ../webpage/upload-document.php?uploadsuccess");
    exit();
}


function adminExist($connect,$username) {
    //template
    $sql = "SELECT * FROM tbl_admin WHERE  username = ?;";

    //prepared statement
    $stmt = mysqli_stmt_init($connect);

    //check if preparation fail 
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location:../admin-login.php?error=stmtfail");
        exit();
    }

    //assign the variable to the placeholder and execute
    mysqli_stmt_bind_param($stmt,"s",$username);
    mysqli_stmt_execute($stmt);

    //get the result from database 
    $result = mysqli_stmt_get_result($stmt);

    // fetch the result from database and return it
    if($result = mysqli_fetch_assoc($result)){
        return $result;
    }else{
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function loginAdmin($connect,$username,$pass){
    //pass the data to userExst
    $userExist = adminExist($connect,$username);

    //check if it has data if not return false 
    if($userExist == false){
        header("Location:../webpage/admin-login.php?error=wrongUser");
        exit();
    }

    //hashed the password from database 
    $passFromDB = $userExist['password'];

    //conditional
    if($passFromDB == $pass){

        //start session and get data from userExist then store in session   
        session_start();
        $_SESSION["userFirst"] = $userExist["First_Name"];
        $_SESSION["userLast"] = $userExist["Last_Name"];

        //if sucess creating user, go to this 👇 page
        header("Location:../webpage/LandingPage.html?LoginSucesfully!");
        exit();

    }else{
        //if password not match from user
        header("Location:../webpage/admin-login.php?error=wrongPassword");
        exit();
    }


}