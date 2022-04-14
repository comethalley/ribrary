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

    function updateUserStatus($id,$status){
        

        $sql = "UPDATE tbl_user SET  user_status = ? WHERE User_id=?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$status, $id])) {
            header("Location:../webpage/Login-and-SignUp-page.html?error=errorUpdateStatus");
            exit();
        }
        
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
            // exit();
        }

        //hashed the password from database 
        $pwdHashed = $userExist['password'];
        $checkpwd = password_verify($pass, $pwdHashed) . "\n";

        //if checkpwd has vale and equals 1
        if ($checkpwd !== '' && $checkpwd == 1) {

            //update status in database to online
            $this->updateUserStatus($userExist['User_id'],'online');
         
            //start session and get data from userExist then store in session   
            session_start();   
            $_SESSION["id"] = $userExist['User_id'];  
            $_SESSION["first-name"] = $userExist['firstname'];
            $_SESSION["last-name"] = $userExist['lastname'];
            $_SESSION["email"] = $userExist['Username'];
          

            //if sucess creating user, go to this 👇 page
            header("Location:../webpage/books-section.html?LoginSucesfully!");
            // $connect = null;
            exit();
        } else {
            //if password not match from user
            header("Location:../webpage/Login-and-SignUp-page.html?error=wrongPassword");
            // $connect = null;
            exit();
        }
    }

    //logout User
    function logoutUser(){
        session_start();
        //change status in database to offline
        $this->updateUserStatus($_SESSION["id"],'offline');
        
        //destroy session
        session_unset($_SESSION["id"]);
        session_unset($_SESSION["first-name"]);
        session_unset($_SESSION["last-name"]);
        session_unset($_SESSION["email"]);

        //Go back to admin-login
        header("Location: ../webpage/Login-and-SignUp-page.html");
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
    function createUser($first, $last, $email, $pass)
    {
        // sql statement
        $sql = "INSERT INTO tbl_user (firstname, lastname, Username,password,user_status) VALUES (?,?,?,?,?)";

        // prepared statement
        $stmt = $this->connect()->prepare($sql);

        //set status 
        $userStatus = "online";

        //hashed the password
        $hashedpwd = password_hash($pass, PASSWORD_DEFAULT);

        //if execution fail
        if (!$stmt->execute([$first, $last, $email, $hashedpwd, $userStatus])) {
            header("Location:../webpage/Login-and-SignUp-page.html?error=stmtfail");
            $connect = null;
            exit();
        }

        //start session and store value
        session_start();
        $_SESSION["first-name"] = $first;
        $_SESSION["last-name"] = $last;
        $_SESSION["email"] = $email;
        $_SESSION["status"] = "online";

        //if sucess creating user, go to this 👇 page
        header("Location: ../webpage/test.php?LoginSucesfully!");
        $connect = null;
        exit();
    }
}
