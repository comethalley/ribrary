
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>

    <!-- icon script from fontawesome -->
    <script defer src="https://kit.fontawesome.com/86dc2a589d.js" crossorigin="anonymous"></script>

    <!-- CSS LINK -->
    <link rel="stylesheet" href="admin-style.css">
</head>

<body>

    <main>
        <!-- MAIN CONTAINER -->
        <div class="main-container">

            <!-- CONTAINER FOR PICTURE -->
            <div class="picture-container">
                <img src="../webpage/img/admin-image.png" alt="image" class="left-image">
            </div>

            <!-- CONTAINER FOR FORM -->
            <div class="login-container">

                <!-- IMAGE LOGO -->
                <img src="../webpage/img/admin-logo.png" alt="admin-logo" class="admin-logo">

                <!-- FORM -->
                <form action="../functions/admin-login-function.php" method="POST" class="admin-form">
                    <div class="input-container">
                        <span class="icon"><i class="fa fa-solid fa-user"></i></span>
                        <input type="text" name="username" id="username" placeholder="Username">
                    </div>

                    <div class="input-container">
                        <span class="icon"><i class="fa fa-solid fa-lock"></i></span>
                        <input type="password" name="password" id="password" placeholder="Password">
                    </div>

                    <button class="sign-in" name="btnSubmit">SIGN IN</button>
                </form>

                <!-- SIGNING IN CIRCLE  -->
                <div class="loading">

                </div>

                <!-- SIGNING IN MESSAGE -->
                <p class="logging-in">Signing In</p>
                <p class="wait">please wait ...</p>

                <!-- ERROR MESSAGE -->
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

    <!-- JAVASCRIPT FUNCTION  -->
    <script src="script.js"></script>
</body>

</html>