<?php
include 'view-functions.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-color: #ddd;
            font-family: Arial, Helvetica, sans-serif;
        }
        textarea{
        width: 845px;
        height: 120px;
        font-size: 14px;
        background-color: #fff;
        resize: none;
        font-family: Arial;
        }
        button{
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
        #edit-box{
            width:850px;
            margin:auto;
        }
    </style>
</head>
<body>
<?php
    $review_id = $_POST['review_id'];
    $user_id = $_POST['user_id'];
    $reviewDate = $_POST['reviewDate'];
    $userComment = $_POST['userComment'];
    $currentPage = $_POST['currentPage'];
    echo "<h3>Edit Comment</h3>";
    echo "<div id='edit-box'><form method='POST' action='".editComments()."'>
        <input type='hidden' name='review_id' value='".$review_id."'>
        <input type='hidden' name='user_id' value='".$user_id."'>
        <input type='hidden' name='reviewDate' value='".$reviewDate."'>
        <input type='hidden' name='currentPage' value='".$currentPage."'>
        <textarea name='userComment' cols='30' rows='10'>".$userComment."</textarea></br>
        <button name='editSubmit'> Edit </button>
    </form></div>";
    ?>
</body>
</html>