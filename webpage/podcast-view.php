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
    <title>Podcast</title>
    <link rel="stylesheet" type="text/css" href="">

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
            height: 120px;
            font-size: 14px;
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
        .player{
            width: 600px;
            height: 400px;
            position: relative;
            margin:auto;
        }
        .player #audiobook-cover{
            width: 600px;
            height: 340px;
        }
        .player audio{
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="player">
        <video controls id="podcast-file">
            <source src="" type="audio/mp4">
        </video>
    </div>

    <?php
    $currentPage = $_SERVER['REQUEST_URI'];
    $bookName = substr($currentPage, strpos($currentPage, "file=") + 5);
    date_default_timezone_set('Asia/Singapore');
    $date =  date('F d Y, h:i A');

    
    if (isset($_SESSION['id'])) {
        echo "<div id='write-comment-box'><form method='POST' action='" . podSetComments($date) . "'>
                <input type='hidden' name='uid' value='" . $_SESSION['id'] . "'>
                <input type='hidden' name='date' value='" . date('Y-d-m H:i:s') . "'>
                <input type='hidden' name='currentPage' value='" . $currentPage . "'>
                <input type='hidden' name='bookPath' value='" . $bookName . "'></br>
                <textarea name='message' cols='30' rows='10'></textarea></br>
                <button type='submit'name='commentSubmit'> Comment </button>
                </form></div>";
    } else {
        echo "You need to be logged in to comment! <br><br>";
    }

    podGetComments();
    ?>
    <!-- SCRIPT -->
    <script>
        const url = window.location.search
        const urlParam = new URLSearchParams(url)
        // const audiobookCoverURL = urlParam.get('file')
        const podcastFileURL = urlParam.get('file')

        // const podcastFileURL = document.getElementById('audiobook-cover');
        const podcastFile = document.getElementById('podcast-file');

        if (podcastFileURL) {
            podcastFile.src = `../functions/uploads/${podcastFileURL}`;
            // audiobookFile.src = `../functions/uploads/${audiobookFileURL}`;

        }

    </script>
</body>

</html>