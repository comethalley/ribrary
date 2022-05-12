<?php
include 'view-functions.php';
function editComments(){
    if(isset($_POST['editSubmit'])){
        $review_id = $_POST['review_id'];
        $user_id = $_POST['user_id'];
        $reviewDate = $_POST['reviewDate'];
        $userComment = $_POST['userComment'];
        
        $sql = "UPDATE tbl_reviews SET userComment='$userComment' WHERE review_id = '$review_id'";
        $result = connect()->query($sql);
        header("Location: ".$_SERVER['REQUEST_URI']."");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    textarea{
    width: 845px;
    height: 120px;
    background-color: #fff;
    resize: none;
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
    </style>
</head>
<body>
<?php
    $review_id = $_POST['review_id'];
    $user_id = $_POST['user_id'];
    $reviewDate = $_POST['reviewDate'];
    $userComment = $_POST['userComment'];

    echo "<form method='POST' action='".editComments()."'>
        <input type='hidden' name='review_id' value='".$review_id."'>
        <input type='hidden' name='user_id' value='".$user_id."'>
        <input type='hidden' name='reviewDate' value='".$reviewDate."'>
        <textarea name='userComment' cols='30' rows='10'>".$userComment."</textarea></br>
        <button name='editSubmit'> Edit </button>
    </form>";
    ?>
</body>
</html>