<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location:admin-login.php");
} else {
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
    <title>USERS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="admin-dashboard-style.css">
</head>

<body>

    <main>
        <!-- include sidebar which in a seperate file -->
        <?php include 'sidebar.php'; ?>

        <div class="main-container">

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Email</th>
                    </tr>
                </thead>

                <tbody>
                    <?php

                    $data = displayUser($connect);
                    foreach ($data as $row) {
                        echo '<tr>';
                        echo '<th>' . $row["User_id"] . '</td>';
                        echo '<td>' . $row["firstname"] . '</td>';
                        echo '<td>' . $row["lastname"] . '</td>';
                        echo '<td>' . $row["Username"] . '</td>';
                        echo ' </tr>';
                    }

                    ?>
                </tbody>
            </table>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>