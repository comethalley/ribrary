<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location:admin-login.php");
} else {
    include '../includes/autoload-class.php';
    $admin = new Admin();

    $admin = new Admin();

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }

    $num_per_page = 9;
    $start_from = ($page - 1) * 9;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Podcasts</title>

    <!-- GOOGLE FONT LINK -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <!-- LINK FOR INCON (FONTAWESOME) -->
    <script defer src="https://kit.fontawesome.com/86dc2a589d.js" crossorigin="anonymous"></script>


    <!-- CSS TYLES -->
    <link rel="stylesheet" href="css/admin-podcast-style.css">
    <link rel="stylesheet" href="css/sidebar-style.css">
</head>

<body>
    <main>
        <!-- include sidebar.php-->
        <?php include 'sidebar.php'; ?>
        <div class="main-container">
            <h1> Upload Podcast</h1>

            <div class="video-container">
                <video width="300" controls>
                    <source src="../functions/uploads/videoplayback.mp4" type="video/mp4">
                </video>

            </div>

            <form action="">
                <input type="file" accept=".mp4" id="podcast-video" required>
                <input type="text" required>
                <button>Submit</button>
            </form>



        </div>
    </main>



    <!-- SCRIPT -->
    <script src="js/sidebar-script.js"></script>
    <script>
        const file = document.querySelector('#podcast-video')

        if (file.files.length !== 0) {
            console.log(file)
        } else {
            console.log('empty')
        }
    </script>
</body>

</html>