<?php
require_once 'database.php';

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
function emptyInputLogin($user, $pass)
{
    $result = "";
    if (empty($user) || empty($pass)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// if not valid email 
function invalidEmail($email)
{
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
function emailExist($connect, $email)
{
    // prepared statement
    $stmt = $connect->prepare("SELECT * FROM tbl_user WHERE  Username = ?");

    //if did not execute error, else continue
    if (!$stmt->execute([$email])) {
        header("Location:../login.php?error=stmtfail");
        exit();
    }

    //fetch the result 
    $result = $stmt->fetch();

    // if has result return it, else return false 
    if ($result) {
        return $result;
    } else {
        $result = false;
        return $result;
    }

    //close connection
    $connect = null;
}


// create new user to database
function createUser($connect, $first, $last, $email, $pass)
{
    // sql statement
    $sql = "INSERT INTO tbl_user (firstname, lastname, Username,password) VALUES (?,?,?,?)";

    // prepared statement
    $stmt = $connect->prepare($sql);

    //hashed the password
    $hashedpwd = password_hash($pass, PASSWORD_DEFAULT);

    //if execution fail
    if(!$stmt->execute([$first, $last, $email,$hashedpwd])){
        header("Location:../login.php?error=stmtfail");
        $connect = null;
        exit();
    }

    //if sucess creating user, go to this 👇 page
    header("Location:../webpage/LandingPage.html?RegisteredSucesfully!");
    $connect = null;
    exit();
}

//login user 
function loginUser($connect, $username, $pass)
{
    //pass the data to userExst
    $userExist = emailExist($connect, $username);

    //check if it has data if not return false 
    if ($userExist == false) {
        header("Location:../webpage/Login.php?error=wrongUser");
        $connect = null;
        exit();
    }

    //hashed the password from database 
    $pwdHashed = $userExist['password'];
    $checkpwd = password_verify($pass, $pwdHashed) . "\n";

    //if checkpwd has vale and equals 1
    if ($checkpwd !== '' && $checkpwd == 1) {

        //start session and get data from userExist then store in session   
        session_start();
        $_SESSION["userFirst"] = $userExist["First_Name"];
        $_SESSION["userLast"] = $userExist["Last_Name"];

        //if sucess creating user, go to this 👇 page
        header("Location:../webpage/LandingPage.html?LoginSucesfully!");
        $connect = null;
        exit();
    } else {
        //if password not match from user
        header("Location:../webpage/Login.php?error=wrongPassword");
        $connect = null;
        exit();
    }
}

function upload_docu($connect, $fileName, $fileTmpName, $createdBy)
{
    //sql
    $sql = "INSERT INTO tbl_book (BookName,BookFile,createdBy) VALUES (?,?,?);";
    
    // prepared statement
    $stmt = $connect->prepare($sql);

    //if execution fail
    if(!$stmt->execute([$fileName, $fileTmpName, $createdBy])){
        header("Location:../login.php?error=stmtfail");
        $connect = null;
        exit();
    }
 
    //if sucess uploading file, go to this 👇 page
    header("Location: ../webpage/upload-document.php?uploadsuccess");
    exit();
}


function adminExist($connect, $username)
{
    //prepared statement
    $stmt = $connect->prepare("SELECT * FROM tbl_admin WHERE username=?");

    //if execution fail
    if(!$stmt->execute([$username])){
        header("Location:../admin/admin-login.php?error=stmtfail");
        exit();
    }

    //fetch the result
    $result = $stmt->fetch();

    //if has result return it, else return false
    if ($result) {
        return $result;
    } else {
        $result = false;
        return $result;
    }
    
    //close connection
    $connect = null;
}

function loginAdmin($connect, $username, $pass)
{
    //pass the data to userExst
    $userExist = adminExist($connect, $username);

    //check if it has data if not return false 
    if ($userExist == false) {
        header("Location:../admin/admin-login.php?error=wrongUser");
        exit();
    }

    //hashed the password from database 
    $passFromDB = $userExist['password'];

    //if pass from DB is same password from input
    if ($passFromDB == $pass) {

        //start session and get data from userExist then store in session   
        session_start();
        $_SESSION["admin"] = $userExist["username"];
      

        //if sucess creating user, go to this 👇 page
        header("Location:../admin/admin-dashboard.php?LoginSucesfully!");
        exit();
    } else {
        //if password not match from user
        header("Location:../admin/admin-login.php?error=wrongPassword");
        exit();
    }
}

// get total user in database
function getTotalUser($connect){
    $count = $connect->query("SELECT count(*) FROM tbl_user")->fetchColumn();

    return $count;
    exit();
}

function displayUser($connect){
    $data = $connect->query("SELECT * FROM tbl_user")->fetchAll();

    return $data;
    exit();
}