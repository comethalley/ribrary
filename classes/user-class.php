<?php
class User extends Database

{
    private $date;

    function __construct()
    {
        date_default_timezone_set('Asia/Singapore');
        $this->date =  date('F d Y, h:i A');
    }

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

    //update User Status
    function updateUserStatus($id, $status)
    {

        $sql = "UPDATE tbl_user SET  user_status = ? WHERE User_id=?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$status, $id])) {
            header("Location:../webpage/Login-and-SignUp-page.html?error=errorUpdateStatus");
            exit();
        }
    }

    //update User Status
    function updateRecentLogin($id, $logs)
    {

        $sql = "UPDATE tbl_user SET recent_login = ? WHERE User_id=?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$logs, $id])) {
            header("Location:../webpage/Login-and-SignUp-page.html?error=errorUpdaRecentLogin");
            exit();
        }
    }

    //login audit 
    function auditTrail($userAction, $logs, $name, $email)
    {
        $action = $userAction == "in" ? "Logged in the system." : "Logged out.";

        $sql = "INSERT INTO tbl_audit_trailing (Date_and_Time, Name, Email,action) VALUES (?,?,?,?)";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$logs, $name, $email, $action])) {
            header("Location:../webpage/Login-and-SignUp-page.html?error=errorLoginAudit");
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
            $this->updateUserStatus($userExist['User_id'], 'online');

            //update recent login date in database to online
            $this->updateRecentLogin($userExist['User_id'], $this->date);

            //insert to audit
            $fullname = $userExist['firstname'] . " " . $userExist['lastname'];
            $this->auditTrail("in", $this->date, $fullname, $userExist['Username']);

            //start session and get data from userExist then store in session   
            session_start();
            $_SESSION["id"] = $userExist['User_id'];
            $_SESSION["first-name"] = $userExist['firstname'];
            $_SESSION["last-name"] = $userExist['lastname'];
            $_SESSION["email"] = $userExist['Username'];
            $_SESSION["profile"] = $userExist['user_profile'];


            //if sucess creating user, go to this 👇 page
            header("Location:../webpage/ebook-section.php?LoginSuccesfully");
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
    function logoutUser()
    {
        session_start();
        //change status in database to offline
        $this->updateUserStatus($_SESSION["id"], 'offline');

        //insert to audit
        $fullname =  $_SESSION["first-name"] . " " . $_SESSION["last-name"];
        $this->auditTrail("out", $this->date, $fullname, $_SESSION["email"]);

        //destroy session
        session_unset();
        session_destroy();

        //Go back to index
        header("Location: ../index.html");
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
    function createUser($first, $last, $email, $pass, $address, $contact_no, $gender)
    {
        $logs =  date('F d Y, h:i A');

        $defaultProfile = 'admin-logo.png';
        // sql statement
        $sql = "INSERT INTO tbl_user (firstname, lastname, Username,address,contact_no,gender,password,user_status,recent_login,user_profile,subscription)
         VALUES (?,?,?,?,?,?,?,?,?,?,?)";

        // prepared statement
        $stmt = $this->connect()->prepare($sql);

        //set status 
        $userStatus = "online";

        //set subscription
        $subscription = 'not subscribed';
        //hashed the password
        $hashedpwd = password_hash($pass, PASSWORD_DEFAULT);

        //if execution fail
        if (!$stmt->execute([$first, $last, $email, $address, $contact_no, $gender, $hashedpwd, $userStatus, $logs, $defaultProfile, $subscription])) {
            header("Location:../webpage/Login-and-SignUp-page.html?error=stmtfail");
            $connect = null;
            exit();
        }

        //get data from database
        $data = $this->emailExist($email);

        //start session and store value
        session_start();
        $_SESSION['id'] = $data['User_id'];
        $_SESSION["first-name"] = $first;
        $_SESSION["last-name"] = $last;
        $_SESSION["email"] = $email;
        $_SESSION["status"] = "online";
        $_SESSION["profile"] = $defaultProfile;

        //if sucess creating user, go to this 👇 page
        header("Location: ../webpage/ebook-section.php?LoginSucesfully!");
        $connect = null;
        exit();
    }

    //test display file in the database
    function displayAcceptedDocs($categories = '')
    {
        if (!empty($categories)) {
            $data = $this->connect()->query("SELECT * FROM tbl_research_documents WHERE status = 'accepted' AND categories = '{$categories}'")->fetchAll();
            return $data;
            exit();
        } else {
            $data = $this->connect()->query("SELECT * FROM tbl_research_documents WHERE status = 'accepted'")->fetchAll();
            return $data;
            exit();
        }
    }

    //function insert to notification table in database
    function notification($doc_name, $doc_file, $doc_path, $createdBy, $user_id, $status, $notif_status)
    {
        $sql = "INSERT INTO tbl_notification (doc_name,doc_file ,doc_path ,createdBy ,date_and_time ,user_id,status,notif_status)
   VALUES (?,?,?,?,?,?,?,?);";

        // prepared statement
        $stmt = $this->connect()->prepare($sql);

        //if execution fail
        if (!$stmt->execute([$doc_name, $doc_file, $doc_path, $createdBy, $this->date, $user_id, $status, $notif_status])) {
            header("Location:../webpage/upload-documents-section.php?error=stmtfailnotif");
            $connect = null;
            exit();
        }
    }

    //insert documents to database
    function upload_documents($doc_name, $doc_file, $doc_path, $createdBy, $id, $categories, $abstract)
    {

        $sql2 = "INSERT INTO tbl_research_documents (doc_name,doc_file, doc_path ,categories,abstract,createdBy ,date_and_time ,user_id ,status)
   VALUES (?,?,?,?,?,?,?,(SELECT User_id FROM tbl_user WHERE user_id = ?),?);";

        $status = 'pending';
        $notif_status = 'unread';

        // prepared statement
        $stmt = $this->connect()->prepare($sql2);

        //if execution fail
        if (!$stmt->execute([$doc_name, $doc_file, $doc_path, $categories, $abstract, $createdBy, $this->date, $id, $status])) {
            header("Location:../webpage/upload-documents-section.php?error=stmtfail");
            $connect = null;
            exit();
        }

        //call notification function
        $this->notification($doc_name, $doc_file, $doc_path, $createdBy, $id, $status, $notif_status);

        //if sucess uploading file, go to this 👇 page
        header("Location: ../webpage/upload-documents-section.php?q=uploadsuccess"); //change to docu later
        exit();
    }

    //upload documents funciton
    function checkDocuments($allowed, $fileActualExt, $fileError, $fileSize, $fileTmpName, $createdBy, $fileName, $categories, $abstract)
    {
        //check if the file extension is in the array $allowed
        if (in_array($fileActualExt, $allowed)) {
            //check if there is no error uploading the file
            if ($fileError === 0) {
                //check the file size
                if ($fileSize > 1000) {
                    // $fileNameNew = uniqid ('', true).".".$fileActualExt;
                    $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                    $fileDestination = 'uploads/' . $fileNameNew;

                    move_uploaded_file($fileTmpName, $fileDestination);

                    $userId = $_SESSION["id"];
                    $this->upload_documents($fileName, $fileTmpName, $fileNameNew, $createdBy, $userId, $categories, $abstract);
                } else {
                    echo "The file was too large";
                }
            } else {
                echo "There was an error while uploading the file";
            }
        } else {
            echo "You can't upload this type of file!";
        }
    }

    //get notifications 
    function getNotification($id)
    {
        // prepared statement
        $stmt = $this->connect()->prepare("SELECT * FROM tbl_notification  WHERE  user_id = ? ORDER BY notif_no DESC");

        //if did not execute error, else continue
        if (!$stmt->execute([$id])) {
            header("Location:../webpage/fetch.php?error=stmtfail");
            exit();
        }

        //fetch the result 
        $result = $stmt->fetchAll();

        // if has result return it, else return false 
        if ($result) {
            return $result;
        } else {
            $result = false;
            return $result;
        }
    }

    //get unread notification 
    function getUnreadNotif($id)
    {
        // prepared statement
        $stmt = $this->connect()->prepare("SELECT notif_status FROM tbl_notification  WHERE  user_id = ? AND notif_status = ?");

        $notif_status = "unread";
        //if did not execute error, else continue
        if (!$stmt->execute([$id, $notif_status])) {
            header("Location:../webpage/fetch.php?error=stmtfail");
            exit();
        }

        //fetch the result 
        $result = $stmt->fetchAll();

        // if has result return it, else return false 
        if ($result) {
            return $result;
        } else {
            $result = false;
            return $result;
        }
    }

    //get unread notification 
    function updateNotifStatus($id)
    {
        // prepared statement
        $stmt = $this->connect()->prepare("UPDATE tbl_notification  SET notif_status = ? WHERE  user_id = ? AND notif_status =?");

        $updatedStatus = "read";
        $notif_status = "unread";
        //if did not execute error, else continue
        if (!$stmt->execute([$updatedStatus, $id, $notif_status])) {
            header("Location:../webpage/fetch.php?error=stmtfail");
            exit();
        }
    }

    //update User profile
    function updateUserProfile($fileName, $fileActualExt, $fileTmpName, $id)
    {
        $fileNameNew = uniqid('', true) . "." . $fileActualExt;
        $fileDestination = 'uploads/' . $fileNameNew;

        if (move_uploaded_file($fileTmpName, $fileDestination)) {

            // prepared statement
            $stmt = $this->connect()->prepare("UPDATE tbl_user  SET user_profile = ? WHERE  User_id = ?");

            //if did not execute error, else continue
            if (!$stmt->execute([$fileNameNew, $id,])) {
                header("Location:../webpage/UserProf.php?error=stmtfail");
                exit();
            }

            header("Location:../webpage/UserProf.php?q=success");
            exit();
        } else {
            echo "move_uploaded_file error";
        }
    }

    //update User profile details
    function updateUserData($firstname, $lastname, $email, $address, $contact_no, $id)
    {
        // prepared statement
        $stmt = $this->connect()->prepare("UPDATE tbl_user  SET firstname = ?, lastname = ?, Username = ?, address =? , contact_no = ? WHERE  User_id = ?");

        //if did not execute error, else continue
        if (!$stmt->execute([$firstname, $lastname, $email, $address, $contact_no, $id])) {
            header("Location:../webpage/Userprof.php?error=stmtfail");
        }

        header("Location:../webpage/Userprof.php?q=success");
        exit();
    }

    //display audiobooks
    function displayAudioBooks($categories = '')
    {
        if (!empty($categories)) {
            $data = $this->connect()->query("SELECT * FROM tbl_audiobook WHERE status = 'accepted' AND categories = '{$categories}'")->fetchAll();
            return $data;
            exit();
        } else {
            $data = $this->connect()->query("SELECT * FROM tbl_audiobook WHERE status = 'accepted'")->fetchAll();
            return $data;
            exit();
        }
    }

    //display audiobooks
    function displayEbooks($categories = '')
    {
        if (!empty($categories)) {
            $data = $this->connect()->query("SELECT * FROM tbl_ebooks WHERE status = 'accepted' AND categories = '{$categories}'")->fetchAll();
            return $data;
            exit();
        } else {
            $data = $this->connect()->query("SELECT * FROM tbl_ebooks WHERE status = 'accepted'")->fetchAll();
            return $data;
            exit();
        }
    }

    //get specific audibooks data
    function getAudiobookData($audiobook_file)
    {
        $data = $this->connect()->query("SELECT * FROM tbl_audiobook WHERE status = 'accepted' AND audiobook_path = '{$audiobook_file}'")->fetch();
        return $data;
        exit();
    }

    //get specific ebook data
    function getEbookData($audiobook_file)
    {
        $data = $this->connect()->query("SELECT * FROM tbl_ebooks WHERE status = 'accepted' AND ebooks_path = '{$audiobook_file}'")->fetch();
        return $data;
        exit();
    }

    //get specific docu data
    function getDocuData($audiobook_file)
    {
        $data = $this->connect()->query("SELECT * FROM tbl_research_documents WHERE status = 'accepted' AND doc_path = '{$audiobook_file}'")->fetch();
        return $data;
        exit();
    }

    //display audiobooks
    function displayPodcasts($categories = '')
    {
        if (!empty($categories)) {
            $data = $this->connect()->query("SELECT * FROM tbl_podcasts WHERE status = 'accepted' AND categories = '{$categories}'")->fetchAll();
            return $data;
            exit();
        } else {
            $data = $this->connect()->query("SELECT * FROM tbl_podcasts WHERE status = 'accepted'")->fetchAll();
            return $data;
            exit();
        }
    }

    //insert to tickets table
    function tickets($subject, $email, $message, $id)
    {
        $sql = "INSERT INTO tbl_tickets (subject, email, body, user_id, date_and_time)
VALUES (?,?,?,(SELECT User_id FROM tbl_user WHERE user_id = ?),?);";

        // prepared statement
        $stmt = $this->connect()->prepare($sql);

        //if execution fail
        if (!$stmt->execute([$subject, $email, $message, $id, $this->date])) {
            header("Location:../webpage/ticket.php?error=stmtfailticket");
            $connect = null;
            exit();
        }
    }


    function searchAudiobook($data)
    {
        $data = $this->connect()->query("SELECT * FROM tbl_audiobook WHERE  status = 'accepted' AND (audiobook_name LIKE '{$data}%' OR author LIKE '{$data}%') ")->fetchAll();
        return $data;
        exit();
    }

    function searchEbook($data)
    {
        $data = $this->connect()->query("SELECT * FROM tbl_ebooks WHERE  status = 'accepted' AND (ebooks_name LIKE '{$data}%' OR author LIKE '{$data}%') ")->fetchAll();
        return $data;
        exit();
    }

    function searchPodcast($data)
    {
        $data = $this->connect()->query("SELECT * FROM tbl_podcasts WHERE  status = 'accepted' AND (podcast_name LIKE '{$data}%' OR podcast_host LIKE '{$data}%') ")->fetchAll();
        return $data;
        exit();
    }

    function searchDocument($data)
    {
        $data = $this->connect()->query("SELECT * FROM tbl_research_documents WHERE  status = 'accepted' AND (doc_name LIKE '{$data}%' OR createdBy LIKE '{$data}%') ")->fetchAll();
        return $data;
        exit();
    }
}
