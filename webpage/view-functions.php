<?php

function connect()
{
    $dbServername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";

    $connect = new PDO("mysql:host=$dbServername;dbname=db_eread", $dbUsername, $dbPassword);

    // set the PDO error mode to exception
    $connect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    return $connect;
}

function setComments($date)
{
    if (isset($_POST['commentSubmit'])) {
        $uid = $_POST['uid'];
        $message = $_POST['message'];
        $rate = $_POST['rate'];
        $bookPath = $_POST['bookPath'];
        $userName = $_SESSION['first-name'];

        $sql = "INSERT INTO tbl_reviews (user_id,userRating,userComment,reviewDate,bookPath,userName) VALUES('$uid','$rate','$message','$date','$bookPath','$userName')";
        $stmt = connect()->query($sql);
        header("Location: " . $_SERVER['REQUEST_URI'] . "");
    }
}

function getComments()
{
    $currentPage = $_SERVER['REQUEST_URI'];
    $bookName = substr($currentPage, strpos($currentPage, "file=") + 5);
    $bookPath = $bookName;
    $sql = "SELECT * FROM tbl_reviews WHERE bookPath ='$bookPath'";
    $stmt = connect()->query($sql);

    while ($reviews_rows = $stmt->fetch()) {

        echo "<div class='comment-box'><p><b>";
        echo $reviews_rows['userName'] . "</b><br>";
        echo "<span>Rating:" . $reviews_rows['userRating'] . "</span><br>";
        echo $reviews_rows['reviewDate'] . "<br><br>";
        echo nl2br($reviews_rows['userComment']);
        echo "</p>";
        if (isset($_SESSION['id'])) {
            if ($_SESSION['id'] == $reviews_rows['user_id']) {
                echo "
                    <form class='edit-form' method='POST' action='view-edit-comment.php'>
                        <input type='hidden' name='review_id' value='" . $reviews_rows['review_id'] . "'>
                        <input type='hidden' name='user_id' value='" . $reviews_rows['user_id'] . "'>
                        <input type='hidden' name='currentPage' value='" . $currentPage . "'>
                        <input type='hidden' name='reviewDate' value='" . $reviews_rows['reviewDate'] . "'>
                        <input type='hidden' name='userComment' value='" . $reviews_rows['userComment'] . "'>
                        <button>Edit</button>
                    </form>";
            }
        }
        echo "</div>";
    }
}

function audioGetComments()
{
    $currentPage = $_SERVER['REQUEST_URI'];
    $bookName = substr($currentPage, strpos($currentPage, "audio_file=") + 11);
    $bookPath = $bookName;
    $sql = "SELECT * FROM tbl_reviews WHERE bookPath ='$bookPath'";
    $stmt = connect()->query($sql);

    while ($reviews_rows = $stmt->fetch()) {

        echo "<div class='comment-box'><p><b>";
        echo $reviews_rows['userName'] . "</b><br>";
        echo "<span>Rating:" . $reviews_rows['userRating'] . "</span><br>";
        echo $reviews_rows['reviewDate'] . "<br><br>";
        echo nl2br($reviews_rows['userComment']);
        echo "</p>";
        if (isset($_SESSION['id'])) {
            if ($_SESSION['id'] == $reviews_rows['user_id']) {
                echo "
                    <form class='edit-form' method='POST' action='view-edit-comment.php'>
                        <input type='hidden' name='review_id' value='" . $reviews_rows['review_id'] . "'>
                        <input type='hidden' name='user_id' value='" . $reviews_rows['user_id'] . "'>
                        <input type='hidden' name='currentPage' value='" . $currentPage . "'>
                        <input type='hidden' name='reviewDate' value='" . $reviews_rows['reviewDate'] . "'>
                        <input type='hidden' name='userComment' value='" . $reviews_rows['userComment'] . "'>
                        <button>Edit</button>
                    </form>";
            }
        }
        echo "</div>";
    }
}

function podSetComments($date)
{
    if (isset($_POST['commentSubmit'])) {
        $uid = $_POST['uid'];
        $message = $_POST['message'];
        $bookPath = $_POST['bookPath'];
        $userName = $_SESSION['first-name'];

        $sql = "INSERT INTO tbl_reviews (user_id,userRating,userComment,reviewDate,bookPath,userName) VALUES('$uid',0,'$message','$date','$bookPath','$userName')";
        $stmt = connect()->query($sql);
        header("Location: " . $_SERVER['REQUEST_URI'] . "");
    }
}

function podGetComments()
{
    $currentPage = $_SERVER['REQUEST_URI'];
    $bookName = substr($currentPage, strpos($currentPage, "file=") + 5);
    $bookPath = $bookName;
    $sql = "SELECT * FROM tbl_reviews WHERE bookPath ='$bookPath'";
    $stmt = connect()->query($sql);

    while ($reviews_rows = $stmt->fetch()) {

        echo "<div class='comment-box'><p><b>";
        echo $reviews_rows['userName'] . "</b><br>";
        echo $reviews_rows['reviewDate'] . "<br><br>";
        echo nl2br($reviews_rows['userComment']);
        echo "</p>";
        if (isset($_SESSION['id'])) {
            if ($_SESSION['id'] == $reviews_rows['user_id']) {
                echo "
                    <form class='edit-form' method='POST' action='view-edit-comment.php'>
                        <input type='hidden' name='review_id' value='" . $reviews_rows['review_id'] . "'>
                        <input type='hidden' name='user_id' value='" . $reviews_rows['user_id'] . "'>
                        <input type='hidden' name='currentPage' value='" . $currentPage . "'>
                        <input type='hidden' name='reviewDate' value='" . $reviews_rows['reviewDate'] . "'>
                        <input type='hidden' name='userComment' value='" . $reviews_rows['userComment'] . "'>
                        <button>Edit</button>
                    </form>";
            }
        }
        echo "</div>";
    }
}
function editComments(){
    if(isset($_POST['editSubmit'])){
        $review_id = $_POST['review_id'];
        $userComment = $_POST['userComment'];
        $currentPage = $_POST['currentPage'];
        
        $sql = "UPDATE tbl_reviews SET userComment='$userComment' WHERE review_id = '$review_id'";
        $result = connect()->query($sql);
        header("Location: ".$currentPage."");
    }
}

function deleteComments()
{
    if (isset($_POST['commentDelete'])) {
        $review_id = $_POST['review_id'];
        $currentPage = $_POST['currentPage'];

        $sql = "DELETE FROM tbl_reviews WHERE review_id='$review_id'";
        $result = connect()->query($sql);
        header("Location: " . $currentPage . "");
    }
}
function showRating(){
  $sql = "SELECT ROUND(AVG(userRating)) as avg FROM tbl_reviews WHERE bookPath='627f6dc3645889.46786491.mp3'";
  $result = connect()->query($sql);
  while ($reviews_rows = $result->fetch()) {
  echo $reviews_rows['avg'];
  }
}