<?php
// header("Refresh:0");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>

    <script src="https://kit.fontawesome.com/86dc2a589d.js" crossorigin="anonymous"></script>
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet"> -->
    <link rel="stylesheet" href="admin-style.css">


</head>

<body>

    <main>
        <div class="main-container">
            <div class="picture-container">

            </div>

            <div class="login-container">

                <img src="../webpage/img/admin-logo.png" alt="admin-logo" class="admin-logo">

                <form action="../functions&db/admin-login-function.php" method="POST" class="admin-form">
                    <!-- <label for="username"></label> -->
                    <div class="input-container">
                        <span class="icon"><i class="fa fa-solid fa-user"></i></span>
                        <input type="text" name="username" id="username" placeholder="Username">
                    </div>


                    <!-- <label for="password"></label> -->
                    <div class="input-container">
                        <span class="icon"><i class="fa fa-solid fa-lock"></i></span>
                        <input type="password" name="password" id="password" placeholder="Password">
                    </div>

                    <button class="sign-in" name="btnSubmit">SIGN IN</button>


                </form>
                <div class="loading">
                    
                </div>

                <p class="logging-in">Signing In</p>
                <?php
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "wrongPassword") {
                        echo '<p class="errorMessage">Wrong password!</p>';
                    } else if ($_GET["error"] == "wrongUser") {
                        echo '<p class="errorMessage">Username does not exist!!</p>';
                    } else if ($_GET["error"] == "emptyInput") {
                        echo '<p class="errorMessage">Empty fields !!</p>';
                    }
                }
                ?>

            </div>
        </div>
    </main>


    <script src="script.js"></script>
</body>

</html>