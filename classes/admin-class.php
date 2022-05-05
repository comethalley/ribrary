<?php

class Admin extends Database
{
    private $date;

    function __construct()
    {
        date_default_timezone_set('Asia/Singapore');
        $this->date =  date('F d Y, h:i A');
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
    function displayUploadedDocuments($displayAll = "notall", $start_from = 0, $num_per_page = 3)
    {
        if ($displayAll == "all") {
            $data = $this->connect()->query("SELECT * FROM tbl_uploaded_documents")->fetchAll();

            return $data;
        }
        $data = $this->connect()->query("SELECT * FROM tbl_uploaded_documents limit $start_from,$num_per_page")->fetchAll();

        return $data;

        exit();
    }

    //select specficif uploaded documents by id
    function getUploadedDocs($doc_id)
    {
        //prepared statement
        $stmt = $this->connect()->prepare("SELECT * FROM tbl_uploaded_documents WHERE doc_id=?");

        //if execution fail
        if (!$stmt->execute([$doc_id])) {
            header("Location:../admin/admin-documents.php?error=stmtfail");
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

        exit();
    }

    //insert accepted docs to tbl_accepted_docs
    function accept_documents($doc_name, $doc_file, $doc_path, $createdBy, $doc_id, $user_id)
    {

        $sql = "INSERT INTO tbl_accpt_docs (doc_name,doc_file ,doc_path ,createdBy ,date_and_time_accepted,doc_id ,user_id)
   VALUES (?,?,?,?,?,(SELECT doc_id FROM tbl_uploaded_documents WHERE doc_id = ?),(SELECT User_id FROM tbl_user WHERE user_id = ?));";

        $stmt = $this->connect()->prepare($sql);

        //if execution fail
        if (!$stmt->execute([$doc_name, $doc_file, $doc_path, $createdBy, $this->date, $doc_id, $user_id])) {
            header("Location:../functions/admin-acceptDocs-function.php?error=stmtfail");
            $connect = null;
            exit();
        }

        $sql2  = "UPDATE tbl_uploaded_documents SET status=?WHERE doc_id=?";
        $stmt2 = $this->connect()->prepare($sql2);

        $status = "accepted";
        //if execution fail
        if (!$stmt2->execute([$status, $doc_id])) {
            header("Location:../functions/admin-acceptDocs-function.php?error=stmt2fail");
            $connect = null;
            exit();
        }

        //if sucess uploading file, go to this 👇 page
        header("Location: ../admin/admin-documents.php?q=success"); //change to docu later
        exit();
    }

    //display all audit trail documents
    function displayAuditTrail($displayAll = "notall", $start_from = 0, $num_per_page = 3)
    {
        if ($displayAll == "all") {
            $data = $this->connect()->query("SELECT * FROM tbl_audit_trailing")->fetchAll();

            return $data;
        }
        $data = $this->connect()->query("SELECT * FROM tbl_audit_trailing limit $start_from,$num_per_page")->fetchAll();

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
