<?php

class Admin extends Database
{

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


    function adminExist($username)
    {
        //prepared statement
        $stmt = $this->connect()->prepare("SELECT * FROM tbl_admin WHERE username=?");

        //if execution fail
        if (!$stmt->execute([$username])) {
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


    function loginAdmin($username, $pass)
    {
        //pass the data to userExst
        $userExist = $this->adminExist($username);

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

    // get total users in database
    function getTotalUser()
    {
        $count = $this->connect()->query("SELECT count(*) FROM tbl_user")->fetchColumn();

        return $count;
        exit();
    }

    //dislay all users in admin-user
    function displayUser()
    {
        $data = $this->connect()->query("SELECT * FROM tbl_user")->fetchAll();

        return $data;
        exit();
    }

    //display all pending documents
    function displayPendingDocuments()
    {
        $data = $this->connect()->query("SELECT * FROM tbl_pending_book")->fetchAll();

        return $data;
        exit();
    }


    //udpate user in database
    function updateUser($id, $fname, $lname, $username)
    {
        $sql = "UPDATE tbl_user SET firstname = ?, lastname = ?, Username = ? WHERE User_id=?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$fname, $lname, $username, $id])) {
            header("Location:../admin/admin-users.php?error=errorEdit");
            exit();
        }

        header("Location:../admin/admin-users.php?error=UpdateSucess");
        exit();
    }

    //delete users in database
    function deleteUser($id)
    {
        $sql = "DELETE FROM tbl_user WHERE User_id=?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$id])) {
            header("Location:../admin/admin-users.php?error=errorDelete");
            exit();
        }

        header("Location:../admin/admin-users.php?error=DeleteSuccess");
        exit();
    }


    function adminLogout()
    {
        session_start();
        session_unset($_SESSION["admin"]);
        session_destroy();
       

        //Go back to admin-login
        header("Location: ../admin/index.php");
    }
}
