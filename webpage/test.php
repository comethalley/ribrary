<?php
    session_start();
    include '../includes/autoload-class.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
</head>
<body>
    <?php
    if(isset($_SESSION['first-name']) && isset($_SESSION['last-name']) && isset($_SESSION['email'])){

    ?>
    <div>
        <p><?php echo $_SESSION['first-name']; ?></p>
        <p><?php echo $_SESSION['last-name']; ?></p>
        <p><?php echo $_SESSION['id']; ?></p>
        <p><a href="../functions/logout-function.php">logout</a></p>
    </div>

    <?php
    }else{
    ?>
        <p><a href="Login-and-SignUp-page.html">sign in</a></p>
    <?php
    }
    ?>

</body>
</html>