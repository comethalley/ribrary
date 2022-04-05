<?php
// start session
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location:admin-login.php");
} else {
    include '../includes/autoload-class.php';
    $admin = new Admin();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD</title>

    <!-- GOOGLE FONT LINK -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <!-- LINK FOR INCON (FONTAWESOME) -->
    <script defer src="https://kit.fontawesome.com/86dc2a589d.js" crossorigin="anonymous"></script>

    <!-- CSS TYLES -->
    <link rel="stylesheet" href="css/sidebar-style.css">
    <link rel="stylesheet" href="css/admin-dashboard-style.css">
</head>

<body>

    <main>
        <!-- Include sidebar.php-->
        <?php include 'sidebar.php'; ?>

        <div class="main-container">
            <h1 class="overview">Dashboard</h1>

            <div class="count-container">

                <!-- Display Total Users -->
                <div class="user-count-container">
                    <p class="title">Total Users</p>
                    <p class="count"><?php echo $admin->getTotalUser(); ?></p>

                    <div class="image"><i class="fa fa-solid fa-users"></i></div>
                </div>

                <!-- Display Total Books -->
                <div class="user-count-container">
                    <p class="title">Total Books</p>
                    <p class="count"><?php echo  $admin->getTotalUser(); ?></p>

                    <div class="image book"><i class="fa fa-solid fa-book"></i></div>
                </div>

                 <!-- Display Pending-->
                <div class="user-count-container">
                    <p class="title">Pending books</p>
                    <p class="count"><?php echo $admin->getTotalUser() ?></p>

                    <div class="image"><i class="fa fa-solid fa-users"></i></div>
                </div>

                <div class="user-count-container">
                    <p class="title">Total User</p>
                    <p class="count"><?php echo $admin->getTotalUser() ?></p>

                    <div class="image"><i class="fa fa-solid fa-users"></i></div>
                </div>

            </div>
        </div>
    </main>

    <!-- JAVASCRIPT FUNCTION -->
    <script src="js/sidebar-script.js"></script>
</body>

</html>