<?php
include '../includes/autoload-class.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <!-- icon script from fontawesome -->
    <script defer src="https://kit.fontawesome.com/86dc2a589d.js" crossorigin="anonymous"></script>

    <!-- CSS LINK -->
    <link rel="stylesheet" href="css/admin-style.css">
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
                <form action="../functions/admin-signup-function.php" method="POST" class="signup-admin-form">
                    <div class="input-container">
                        <span class="icon"><i class="fa fa-solid fa-user"></i></span>
                        <input type="text" name="fullname" id="username" placeholder="Fullname">
                    </div>

                    <div class="input-container">
                        <span class="icon"><i class="fa fa-solid fa-envelope"></i></span>
                        <input type="text" name="email" id="username" placeholder="Email">
                    </div>

                    <div class="input-container">
                        <span class="icon"><i class="fa fa-solid fa-lock"></i></span>
                        <input type="password" name="repeat-password" id="username" placeholder="Password">
                    </div>

                    <div class="input-container">
                        <span class="icon"><i class="fa fa-solid fa-lock"></i></span>
                        <input type="password" name="password" id="password" placeholder="Repeat password">
                    </div>

                    <button class="sign-up" name="btnSubmit">SIGN UP</button>
                </form>

                <p class="create-account">Already have an account <a href="index.php" class="signup">Login</a></p>

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
    <script>
        const signUp = document.querySelector(".sign-up");
        const signUpForm = document.querySelector(".signup-admin-form");
        const adminLogo = document.querySelector(".admin-logo");
        const loading = document.querySelector(".loading");
        const errorMessage = document.querySelector('.errorMessage');
        const createAccount = document.querySelector('.create-account')

        signUp.addEventListener('click', function(e) {
            e.preventDefault()

            // HIDE LOGO AND FORM
            signUpForm.classList.add('hideDisplay');
            adminLogo.classList.add('hideDisplay');
            createAccount.classList.add('hideDisplay');

            // If has error message, hide it
            if (errorMessage) {
                errorMessage.classList.add('hideDisplay');
            }

            // Display loading 
            loading.style.display = "flex";
            document.querySelector('.logging-in').style.display = 'block';
            document.querySelector('.wait').style.display = 'block';

            setTimeout(() => {
                signUpForm.submit();
            }, 2000)

        })
    </script>
</body>

</html>