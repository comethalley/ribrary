<?php
date_default_timezone_set('Asia/Singapore');
$date =  date('F d Y, h:i A');
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

function deleteComments()
{
    if (isset($_POST['commentDelete'])) {
        $review_id = $_POST['review_id'];

        $sql = "DELETE FROM tbl_reviews WHERE review_id='$review_id'";
        $result = connect()->query($sql);
        header("Location: " . $_SERVER['REQUEST_URI'] . "");
    }
}

function getComments()
{
    $currentPage = $_SERVER['REQUEST_URI'];
    $bookName = substr($currentPage, strpos($currentPage, "=") + 1);
    $bookPath = $bookName;
    $sql = "SELECT * FROM tbl_reviews WHERE bookPath ='$bookPath'";
    $stmt = connect()->query($sql);

    while ($reviews_rows = $stmt->fetch()) {

        echo "<div class='comment-box'><p>";
        echo $reviews_rows['userName'] . "<br>";
        echo "<span>Rating:" . $reviews_rows['userRating'] . "</span><br>";
        echo $reviews_rows['reviewDate'] . "<br>";
        echo nl2br($reviews_rows['userComment']);
        echo "</p>";
        if (isset($_SESSION['id'])) {
            if ($_SESSION['id'] == $reviews_rows['user_id']) {
                echo "<form class='delete-form' method='POST' action='" . deleteComments() . "'>
                    <input type='hidden' name='review_id' value='" . $reviews_rows['review_id'] . "'>
                    <button type='submit' name='commentDelete'>Delete</button>
                    </form>
                    <form class='edit-form' method='POST' action='view-edit-comment.php'>
                        <input type='hidden' name='review_id' value='" . $reviews_rows['review_id'] . "'>
                        <input type='hidden' name='user_id' value='" . $reviews_rows['user_id'] . "'>
                        <input type='hidden' name='reviewDate' value='" . $reviews_rows['reviewDate'] . "'>
                        <input type='hidden' name='userComment' value='" . $reviews_rows['userComment'] . "'>
                        <button>Edit</button>
                    </form>";
            }
        }
        echo "</div>";
    }
}
