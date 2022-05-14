<?php
session_start();

if (!isset($_SESSION['admin_name'])) {
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload AudioBooks</title>

    <!-- GOOGLE FONT LINK -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <!-- LINK FOR INCON (FONTAWESOME) -->
    <script src="https://kit.fontawesome.com/86dc2a589d.js" crossorigin="anonymous"></script>

    <!-- Sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- CSS TYLES -->
    <link rel="stylesheet" href="css/admin-uploadAudiobook-style.css">
    <link rel="stylesheet" href="css/sidebar-style.css">
    <style>
        .logo-container {
            height: 5%;
        }
    </style>
</head>

<body>
    <main>
        <!-- include sidebar.php-->
        <?php include 'sidebar.php'; ?>
        <div class="main-container">
            <h1> Upload Audiobooks</h1>

            <form action="../functions/admin-uploadAudiobook-function.php" method="POST" enctype="multipart/form-data">

                <label for="audiobook"> Audiobook</label>
                <input type="file" name="file" id="audiobook" accept=".mp3" required>

                <label for="audiobook-cover">Cover</label>
                <input type="file" name="file2" id="audiobook-cover" accept=".jpg, .png" required>

                <label for="narrator">Narrator</label>
                <input type="text" name="narrator" id="narrator" placeholder="Narrator" required>

                <fieldset>

                    <div>
                        <input type="radio" id="fantasy" name="categories" value="fantasy" required>
                        <label for="fantasy">Fantasy</label>

                        <input type="radio" id="science-fiction" name="categories" value="science fiction">
                        <label for="science-fiction">Science Fiction</label>
                    </div>

                    <div>
                        <input type="radio" id="action-and-adventure" name="categories" value="action and adventure">
                        <label for="action-and-adventure">Action & Adventure</label>

                        <input type="radio" id="mystery" name="categories" value="mystery">
                        <label for="mystery">Mystery</label>
                    </div>

                    <div>
                        <input type="radio" id="action-and-adventure" name="categories" value="action and adventure">
                        <label for="action-and-adventure">Action & Adventure</label>
                    </div>

                    <div>

                    </div>
                </fieldset>



                <button name="upload-audiobook">Submit</button>
            </form>

            <!-- Test if audiobook display works -->
            <h1>Display audiobook(test)</h1>
            <?php
            include '../includes/autoload-class.php';
            $user = new User();

            $data = $user->displayAudioBooks();

            foreach ($data as $row) {
            ?>
                <p><?php echo $row['audiobook_name'] ?></p>

                <img src="../functions/uploads/<?php echo $row['audiobook_cover_path'] ?>" alt="">

                <audio controls src="../functions/uploads/<?php echo $row['audiobook_path'] ?>">
                    Your browser does not support the
                    <code>audio</code> element.
                </audio>

            <?php
            }
            ?>

        </div>
    </main>


    <!-- SWEET ALERT -->
    <script>
        const windowUrl = window.location.search;
        const url = new URLSearchParams(windowUrl);
        const keyword = url.get('q')

        if (keyword && keyword == "uploadsuccess") {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: 'Uploaded Succesfully'
            })

        }
    </script>

    <!-- SCRIPT -->
    <script src="js/sidebar-script.js"></script>

</body>

</html>