<?php
class User extends Database
{
    //Empty field
    function emptyInputLogin($email, $pass)
    {
        $result = "";
        if (empty($email) || empty($pass)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    //if email exist 
    function emailExist($email)
    {
        // prepared statement
        $stmt = $this->connect()->prepare("SELECT * FROM tbl_user WHERE  Username = ?");

        //if did not execute error, else continue
        if (!$stmt->execute([$email])) {
            header("Location:../webpage/Login-and-SignUp-page.html?error=stmtfail");
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
        // $connect = null;
    }

    //login user 
    function loginUser($email, $pass)
    {
        //pass the data to userExst
        $userExist = $this->emailExist($email);

        //check if it has data if not return false 
        if ($userExist == false) {
            header("Location:../webpage/Login-and-SignUp-page.html?error=wrongUser");
            // $connect = null;
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
            header("Location:../index.html?LoginSucesfully!");
            // $connect = null;
            exit();
        } else {
            //if password not match from user
            header("Location:../webpage/Login-and-SignUp-page.html?error=wrongPassword");
            // $connect = null;
            exit();
        }
    }

    //Empty field
    function emptyInputSignUp($first, $last, $email, $pass, $re_pass)
    {
        $result = "";
        if (empty($first) || empty($last) || empty($email) || empty($pass) || empty($re_pass)) {
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
    function passNotMatch($pass, $re_pass)
    {
        $result = "";
        if ($pass !== $re_pass) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    // create new user to database
    function createUser( $first, $last, $email, $pass)
    {
        // sql statement
        $sql = "INSERT INTO tbl_user (firstname, lastname, Username,password) VALUES (?,?,?,?)";

        // prepared statement
        $stmt = $this->connect()->prepare($sql);

        //hashed the password
        $hashedpwd = password_hash($pass, PASSWORD_DEFAULT);

        //if execution fail
        if (!$stmt->execute([$first, $last, $email, $hashedpwd])) {
            header("Location:../webpage/Login-and-SignUp-page.html?error=stmtfail");
            $connect = null;
            exit();
        }

        //if sucess creating user, go to this 👇 page
        header("Location:../index.html?LoginSucesfully!");
        $connect = null;
        exit();
    }
}
