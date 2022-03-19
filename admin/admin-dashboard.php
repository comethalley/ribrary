<?php
    session_start();

    if (!isset($_SESSION['admin'])) {
        header("Location:admin-login.php");
    }else{
        include_once '../functions&db/functions.php';
        include_once '../functions&db/database.php';
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD</title>
    <link rel="stylesheet" href="admin-dashboard-style.css">
</head>
<body>
    
    <main>
        <!-- include sidebar which in a seperate file -->
       <?php include 'sidebar.php'; ?>

        <div class="main-container">
            <div class="user-count-container">          
                <?php echo getTotalUser($connect);?>
                <p>User Registered</p>
            </div>
        </div>
    </main>
</body>
</html>