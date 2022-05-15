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

    //Empty Sign up field
    function emptyInputSignUp($fullname, $email, $pass, $re_pass)
    {
        $result = "";
        if (empty($fullname) ||  empty($email) || empty($pass) || empty($re_pass)) {
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



    function adminExist($username)
    {
        //prepared statement
        $stmt = $this->connect()->prepare("SELECT * FROM tbl_admin WHERE email=?");

        //if execution fail
        if (!$stmt->execute([$username])) {
            header("Location:../admin/index.php?error=stmtfail");
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

    //update admin recent login

    function updateLoginDate($id)
    {
        $sql = "UPDATE tbl_admin SET recent_login = ? WHERE admin_id=?";
        $stmt = $this->connect()->prepare($sql);


        if (!$stmt->execute([$this->date, $id])) {
            header("Location:../admin/index.php?error=stmtfailDateUpdate");
            exit();
        }
    }


    function loginAdmin($username, $pass)
    {
        //pass the data to userExst
        $userExist = $this->adminExist($username);

        //check if it has data if not return false 
        if ($userExist == false) {
            header("Location:../admin/index.php?error=wrongUser");
            exit();
        }

        //hashed the password from database 
        $pwdHashed = $userExist['password'];
        $checkpwd = password_verify($pass, $pwdHashed) . "\n";

        //if pass from DB is same password from input
        if ($checkpwd !== '' && $checkpwd == 1) {

            //check if status is equals to pending
            if ($userExist['role'] == 'pending') {
                header("Location:../admin/index.php?error=pendingStatus");
                exit();
            }

            if ($userExist['role'] == 'decline') {
                header("Location:../admin/index.php?error=declineStatus");
                exit();
            }

            //start session and get data from userExist then store in session   
            session_start();

            $_SESSION["admin_name"] = $userExist["fullname"];
            $_SESSION["admin_id"] = $userExist["admin_id"];
            $_SESSION["role"] = $userExist["role"];

            $this->updateLoginDate($userExist["admin_id"]);
            $this->updateAdminStatus($userExist["admin_id"], 'online');

            //if role is 'main admin'
            if ($userExist["role"] == 'main admin') {
                header("Location:../admin/admin-dashboard.php?q=LoginSucesfully!");
                exit();
            }

            //if role is 'Admin1'
            if ($userExist["role"] == 'Admin1') {
                header("Location:../admin/admin-documents.php?q=LoginSucesfully!");
                exit();
            }

            //if role is 'Admin2'
            if ($userExist["role"] == 'Admin2') {
                header("Location:../admin/admin-podcast.php?q=LoginSucesfully!");
                exit();
            }
        } else {
            //if password not match from user
            header("Location:../admin/index.php?error=wrongPassword");
            exit();
        }
    }

    // create new admin to database
    function createUser($fullname, $email, $pass)
    {
        // sql statement
        $sql = "INSERT INTO tbl_admin (fullname,email,password,role) VALUES (?,?,?,?)";

        // prepared statement
        $stmt = $this->connect()->prepare($sql);

        //set role 
        $role = "pending";

        //hashed the password
        $hashedpwd = password_hash($pass, PASSWORD_DEFAULT);

        //if execution fail
        if (!$stmt->execute([$fullname, $email, $hashedpwd, $role])) {
            header("Location: ../admin/sign-up.php?error=stmtfail");
            $connect = null;
            exit();
        }

        //start session and store value
        session_start();
        $_SESSION["admin"] = $email;

        //if sucess creating user, go to this 👇 page
        header("Location:../admin/index.php?createdSuccesfully!");
        $connect = null;
        exit();
    }

    // get total users in database
    function getTotalUser()
    {
        $count = $this->connect()->query("SELECT count(*) FROM tbl_user")->fetchColumn();

        return $count;
        exit();
    }

    // get total accepted audioBook in database
    function getTotal($table)
    {
        $count = $this->connect()->query("SELECT count(*) FROM {$table} WHERE status = 'accepted'")->fetchColumn();

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
    function displayUploadedDocuments($displayAll = "notall", $start_from = 0, $num_per_page = 9)
    {
        if ($displayAll == "all") {
            $data = $this->connect()->query("SELECT * FROM tbl_research_documents ")->fetchAll();

            return $data;
        }
        $data = $this->connect()->query("SELECT * FROM tbl_research_documents WHERE status = 'pending' limit $start_from,$num_per_page")->fetchAll();

        return $data;

        exit();
    }

    //display all pending documents
    function displayAdmins($displayAll = "notall", $start_from = 0, $num_per_page = 9)
    {
        if ($displayAll == "all") {
            $data = $this->connect()->query("SELECT * FROM tbl_admin")->fetchAll();

            return $data;
        }
        $data = $this->connect()->query("SELECT * FROM tbl_admin  WHERE role = 'pending' limit $start_from,$num_per_page")->fetchAll();

        return $data;

        exit();
    }

    function displayAcceptedAdmins()
    {

        $data = $this->connect()->query("SELECT * FROM tbl_admin  WHERE role = 'Admin1' OR  role = 'Admin2'")->fetchAll();

        return $data;

        exit();
    }

    //update admin role 
    function updateAdminRole($id, $role)
    {
        $sql = "UPDATE tbl_admin SET role = ? WHERE admin_id=?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$role, $id])) {
            header("Location:../admin/admin-pendingAdmin.php?error=errorAccept");
            exit();
        }

        header("Location:../admin/admin-pendingAdmin.php?q=success");
        exit();
    }

    //update podcast status 
    function updatePodcastStatus($podcast_id, $status)
    {
        $sql = "UPDATE tbl_podcasts SET status = ? WHERE podcast_id=?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$status, $podcast_id])) {
            header("Location:../admin/admin-pendingPodcasts.php?error=errorAccept");
            exit();
        }

        header("Location:../admin/admin-pendingPodcasts.php?q=success");
        exit();
    }

    //update audiobook status 
    function updateAudiobookStatus($audiobook_id, $status)
    {
        $sql = "UPDATE tbl_audiobook SET status = ? WHERE audiobook_id=?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$status, $audiobook_id])) {
            header("Location:../admin/admin-pendingAudiobooks.php?error=errorAccept");
            exit();
        }

        header("Location:../admin/admin-pendingAudiobooks.php?q=success");
        exit();
    }

    //update admin role 
    function updateAdminStatus($id, $status)
    {
        $sql = "UPDATE tbl_admin SET admin_status = ? WHERE admin_id=?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$status, $id])) {
            header("Location:../admin/index.php?error=updateStatus");
            exit();
        }
    }


    //update document status
    function updateDocStatus($doc_id, $status, $message = '')
    {
        if ($status == 'decline') {
            $sql  = "UPDATE tbl_research_documents SET status= ?, message = ? WHERE doc_id=?";
            $stmt = $this->connect()->prepare($sql);

            //if execution fail
            if (!$stmt->execute([$status, $message, $doc_id])) {
                header("Location:../functions/admin-pendingDocs-function.php?error=updateStatus");
                $connect = null;
                exit();
            }
        }

        if ($status == 'accepted') {
            $sql  = "UPDATE tbl_research_documents SET status= ? WHERE doc_id=?";
            $stmt = $this->connect()->prepare($sql);

            //if execution fail
            if (!$stmt->execute([$status, $doc_id])) {
                header("Location:../functions/admin-pendingDocs-function.php?error=updateStatus");
                $connect = null;
                exit();
            }
        }
    }
    //function insert to notification table in database
    function notification($doc_name, $doc_file, $doc_path, $createdBy, $user_id, $status, $notif_status, $message = '')
    {

        if (!empty($message)) {
            $sql = "INSERT INTO tbl_notification (doc_name,doc_file ,doc_path ,createdBy ,date_and_time ,user_id,status,notif_status,message)
            VALUES (?,?,?,?,?,?,?,?,?);";

            // prepared statement
            $stmt = $this->connect()->prepare($sql);

            //if execution fail
            if (!$stmt->execute([$doc_name, $doc_file, $doc_path, $createdBy, $this->date, $user_id, $status, $notif_status, $message])) {
                header("Location:../admin/admin-documents.php?error=stmtfailnotif");
                $connect = null;
                exit();
            }
        } else {
            $sql = "INSERT INTO tbl_notification (doc_name,doc_file ,doc_path ,createdBy ,date_and_time ,user_id,status,notif_status)
        VALUES (?,?,?,?,?,?,?,?);";

            // prepared statement
            $stmt = $this->connect()->prepare($sql);

            //if execution fail
            if (!$stmt->execute([$doc_name, $doc_file, $doc_path, $createdBy, $this->date, $user_id, $status, $notif_status])) {
                header("Location:../admin/admin-documents.php?error=stmtfailnotif");
                $connect = null;
                exit();
            }
        }
    }

    //select specific document 
    function getResearchDocument($doc_id)
    {
        $data = $this->connect()->query("SELECT * FROM tbl_research_documents WHERE doc_id = '{$doc_id}'")->fetch();
        return $data;
        exit();
    }

    //decline document function
    function decline_documents($doc_id, $message)
    {
        $this->updateDocStatus($doc_id, 'decline', $message);

        //if sucess uploading file, go to this 👇 page
        header("Location: ../admin/admin-documents.php?q=success"); //change to docu later
        exit();
    }

    //insert accepted docs to tbl_accepted_docs
    function accept_documents($doc_id)
    {

        //call update status
        $this->updateDocStatus($doc_id, 'accepted');

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
    //insert podcasts to database
    function upload_podcasts($podcast_name, $podcast_path, $podcast_host, $createdBy, $categories)
    {

        $sql = "INSERT INTO tbl_podcasts(podcast_name,podcast_path,podcast_host,categories,date_and_time,status,uploaded_by)
    VALUES (?,?,?,?,?,?,?);";

        $status = 'pending';

        // prepared statement
        $stmt = $this->connect()->prepare($sql);

        //if execution fail
        if (!$stmt->execute([$podcast_name, $podcast_path, $podcast_host, $categories, $this->date, $status, $createdBy])) {
            header("Location:../admin/admin-podcast.php?error=stmtfail");
            $connect = null;
            exit();
        }

        //if sucess uploading file, go to this 👇 page
        header("Location: ../admin/admin-podcast.php?q=uploadsuccess"); //change to docu later
        exit();
    }

    //upload podcast function
    function checkPodcast($allowed, $fileActualExt, $fileError, $fileTmpName, $createdBy, $fileName, $podcast_host, $categories)
    {
        //check if the file extension is in the array $allowed
        if (in_array($fileActualExt, $allowed)) {
            //check if there is no error uploading the file
            if ($fileError === 0) {

                // $fileNameNew = uniqid ('', true).".".$fileActualExt;
                $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                $fileDestination = 'uploads/' . $fileNameNew;

                if (move_uploaded_file($fileTmpName, $fileDestination)) {
                    // $userId = $_SESSION["id"];
                    $this->upload_podcasts($fileName, $fileNameNew, $podcast_host, $createdBy, $categories);
                } else {
                    echo "move_uploaded_file error";
                }
            } else {
                echo "There was an error while uploading the file";
                echo $fileError;
            }
        } else {
            echo "You can't upload this type of file!";
        }
    }

    //insert audiobook to database
    function upload_audiobook($audiobook_name, $audiobook_path, $audiobook_cover_path, $narrator, $createdBy, $categories, $synopsis, $author)
    {

        $sql = "INSERT INTO tbl_audiobook(audiobook_name, audiobook_path, audiobook_cover_path,categories,author,synopsis, narrator, date_and_time, status, uploaded_by)
     VALUES (?,?,?,?,?,?,?,?,?,?);";

        $status = 'pending';

        // prepared statement
        $stmt = $this->connect()->prepare($sql);

        //if execution fail
        if (!$stmt->execute([$audiobook_name, $audiobook_path, $audiobook_cover_path, $categories, $author, $synopsis, $narrator, $this->date, $status, $createdBy])) {
            header("Location:../admin/admin-audiobook.php?error=stmtfail");
            $connect = null;
            exit();
        }

        //if sucess uploading file, go to this 👇 page
        header("Location: ../admin/admin-audiobook.php?q=uploadsuccess"); //change to docu later
        exit();
    }

    //upload audiobook function
    function checkAudiobook($allowed, $allowed2, $fileActualExt, $file2ctualExt, $filename, $fileTmpName, $file2TmpName, $narrator, $admin_name, $categories, $synopsis, $author)
    {
        //check if the file extension is in the array $allowed
        if (in_array($fileActualExt, $allowed) && in_array($file2ctualExt, $allowed2)) {

            //audiobook
            $fileNameNew = uniqid('', true) . "." . $fileActualExt;
            $fileDestination = 'uploads/' . $fileNameNew;

            //cover
            $fileNameNew2 = uniqid('', true) . "." . $file2ctualExt;
            $fileDestination2 = 'uploads/' . $fileNameNew2;

            if (move_uploaded_file($fileTmpName, $fileDestination) &&  move_uploaded_file($file2TmpName, $fileDestination2)) {

                $this->upload_audiobook($filename, $fileNameNew, $fileNameNew2, $narrator, $admin_name, $categories, $synopsis, $author);
            } else {
                echo "move_uploaded_file error";
            }
        } else {
            echo "You can't upload this type of file!";
        }
    }

    //insert ebooks to database
    function upload_ebooks($ebooks_name, $ebooks_path, $ebooks_cover_path, $createdBy, $categories, $synopsis, $author)
    {

        $sql = "INSERT INTO tbl_ebooks(ebooks_name, ebooks_path, ebooks_cover_path,categories,synopsis,author, date_and_time, status, uploaded_by)
     VALUES (?,?,?,?,?,?,?,?,?);";

        $status = 'pending';

        // prepared statement
        $stmt = $this->connect()->prepare($sql);

        //if execution fail
        if (!$stmt->execute([$ebooks_name, $ebooks_path, $ebooks_cover_path, $categories, $synopsis, $author, $this->date, $status, $createdBy])) {
            header("Location:../admin/admin-audiobook.php?error=stmtfail");
            $connect = null;
            exit();
        }

        //if sucess uploading file, go to this 👇 page
        header("Location: ../admin/admin-audiobook.php?q=uploadsuccess"); //change to docu later
        exit();
    }

    //upload ebooks function
    function checkEbooks($allowed, $allowed2, $fileActualExt, $file2ctualExt, $filename, $fileTmpName, $file2TmpName, $admin_name, $categories, $synopsis, $author)
    {
        //check if the file extension is in the array $allowed
        if (in_array($fileActualExt, $allowed) && in_array($file2ctualExt, $allowed2)) {

            //audiobook
            $fileNameNew = uniqid('', true) . "." . $fileActualExt;
            $fileDestination = 'uploads/' . $fileNameNew;

            //cover
            $fileNameNew2 = uniqid('', true) . "." . $file2ctualExt;
            $fileDestination2 = 'uploads/' . $fileNameNew2;

            if (move_uploaded_file($fileTmpName, $fileDestination) &&  move_uploaded_file($file2TmpName, $fileDestination2)) {

                $this->upload_ebooks($filename, $fileNameNew, $fileNameNew2, $admin_name, $categories, $synopsis, $author);
            } else {
                echo "move_uploaded_file error";
            }
        } else {
            echo "You can't upload this type of file!";
        }
    }


    //display all pending podcasts
    function displayPendingPodcasts($displayAll = "notall", $start_from = 0, $num_per_page = 9)
    {
        if ($displayAll == "all") {
            $data = $this->connect()->query("SELECT * FROM tbl_podcasts ")->fetchAll();

            return $data;
        }
        $data = $this->connect()->query("SELECT * FROM tbl_podcasts WHERE status = 'pending' limit $start_from,$num_per_page")->fetchAll();

        return $data;

        exit();
    }

    //display all pending audiobook
    function displayPendingAudiobooks($displayAll = "notall", $start_from = 0, $num_per_page = 9)
    {
        if ($displayAll == "all") {
            $data = $this->connect()->query("SELECT * FROM tbl_audiobook ")->fetchAll();

            return $data;
        }
        $data = $this->connect()->query("SELECT * FROM tbl_audiobook WHERE status = 'pending' limit $start_from,$num_per_page")->fetchAll();

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
        $this->updateAdminStatus($_SESSION["admin_id"], 'offline');
        session_unset($_SESSION["admin"]);
        session_destroy();

        //Go back to admin-login
        header("Location: ../admin/index.php");
    }
}
