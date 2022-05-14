<!DOCTYPE html>
<html lang="en">
<?php
include 'view-functions.php';
date_default_timezone_set('Asia/Manila');
session_start();


?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a7e3800dc5.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/view.css">
    <title>View</title>

    <!-- BOOTSTRAP ICON -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #ddd;
            font-family: Arial, Helvetica, sans-serif;
        }

        .comment-box {
            width: 812px;
            padding: 20px;
            margin-bottom: 4px;
            background-color: #fff;
            border-radius: 4px;
            position: relative;
            margin:auto;
            margin-bottom: 4px;
        }
        #write-comment-box{
            width:850px;
            margin:auto;
        }
        textarea {
            width: 845px;
            font-size: 14px;
            height: 120px;
            background-color: #fff;
            resize: none;
        }

        .comment-box p {
            font-size: 14px;
            line-height: 16px;
            color: #282828;
            font-weight: 100;
        }

        .edit-form {
            position: absolute;
            top: 0px;
            right: 0px;
        }

        .edit-form button {
            border: none;
            width: 40px;
            height: 20px;
            color: #282828;
            background-color: #fff;
            opacity: 0.7;
        }

        .edit-form button:hover {
            opacity: 1;
        }

        .delete-form {
            position: absolute;
            top: 0px;
            right: 60px;
        }

        .delete-form button {
            border: none;
            width: 40px;
            height: 20px;
            color: #282828;
            background-color: #fff;
            opacity: 0.7;
        }

        .delete-form button:hover {
            opacity: 1;
        }

        form button {
            width: 100px;
            height: 30px;
            background-color: #282828;
            border: none;
            color: #fff;
            font-family: Arial;
            font-weight: 400;
            cursor: pointer;
            margin-bottom: 60px;
        }
    </style>
</head>

<body>

    <div class="zoom-container">
        Zoom
        <button class="zoom out">-</button>
        <span class="view">125%</span>
        <button class="zoom in">+</button>
    </div>

    <div class="prev">
        <button class="btn" id="prev-page">
            <i class="leftarrow"></i>
        </button>
    </div>

    <div class="next">
        <button class="btn" id="Next-page">
            <i class="rightarrow"></i>
        </button>
    </div>

    <div class="canvas">
        <canvas id="pdf-render">

        </canvas>
    </div>

    <div class="page">
        <span class="page-info">
            Page <span id="page-num"></span> of <span id="page-count"></span>
        </span>
    </div>

    <?php
    $currentPage = $_SERVER['REQUEST_URI'];
    $bookName = substr($currentPage, strpos($currentPage, "=") + 1);
    date_default_timezone_set('Asia/Singapore');
    $date =  date('F d Y, h:i A');

    
    if (isset($_SESSION['id'])) {
        echo "<div id='write-comment-box'><form method='POST' action='" . setComments($date) . "'>
                <input type='hidden' name='uid' value='" . $_SESSION['id'] . "'>
                <input type='hidden' name='date' value='" . date('Y-d-m H:i:s') . "'>
                <input type='hidden' name='currentPage' value='" . $currentPage . "'>
                <input type='hidden' name='bookPath' value='" . $bookName . "'></br>
                <textarea name='message' cols='30' rows='10'></textarea></br>
                <label for='rate'>Rating</label>
                <select name='rate'>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select></br>
                <button type='submit'name='commentSubmit'> Comment </button>
                </form></div>";
    } else {
        echo "You need to be logged in to comment! <br><br>";
    }

    getComments();
    ?>

    <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
    <script src="js/view.js"></script>


</body>

</html>