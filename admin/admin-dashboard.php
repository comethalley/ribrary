<?php
// start session
session_start();

if (isset($_SESSION['admin']) && $_SESSION['role'] == 'main admin') {

    include '../includes/autoload-class.php';
    $admin = new Admin();
} else {
    header("Location:index.php");
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

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <!-- Sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

            <div class="admin-container">
                <h2>Admins</h2>
                <table class="table">

                    <thead class="thead-dark">
                        <tr class="table-header">
                            <th scope="col">No.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        $data = $admin->displayAcceptedAdmins();
                        foreach ($data as $row) {
                        ?>
                            <tr>
                                <td> <?php echo $count ?></td>
                                <td> <?php echo $row["fullname"] ?></td>
                                <td> <?php echo $row["email"] ?></td>
                                <td> <?php echo $row["role"] ?></td>
                                <td> <?php echo $row["admin_status"] ?></td>
                            </tr>
                        <?php
                            $count++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- JAVASCRIPT FUNCTION -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script src="js/sidebar-script.js"></script>

    <script>
        const windowUrl = window.location.search;
        const url = new URLSearchParams(windowUrl);
        const keyword = url.get('q')

        if (keyword && keyword == "LoginSucesfully!") {
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
                title: 'Signed in successfully'
            })

        }
    </script>
</body>

</html>