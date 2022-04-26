<?php
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
    <title>DOCUMENTS</title>

    <!-- GOOGLE FONT LINK -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- LINK FOR INCON (FONTAWESOME) -->
    <script defer src="https://kit.fontawesome.com/86dc2a589d.js" crossorigin="anonymous"></script>

    <!-- CSS TYLES -->
    <link rel="stylesheet" href="css/admin-documents-style.css">
    <link rel="stylesheet" href="css/sidebar-style.css">
</head>

<body>
    <main>
        <!-- include sidebar.php-->
        <?php include 'sidebar.php'; ?>
        <div class="main-container">

            <!-- Display User from database -->
            <div class="table-container">
                <!-- <button class="action">dsd</button> -->
                <h1>Pending documents</h1>

                <table class="table">

                    <thead>
                        <tr class="table-header">
                            <th scope="col">No.</th>
                            <th scope="col">Book ID</th>
                            <th scope="col">Book name</th>
                            <th scope="col">Book File</th>
                            <th scope="col">Uploaded By</th>
                            <th scope="col">User_id</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody class="action">

                        <?php
                        $data = $admin->displayPendingDocuments();
                        $count = 1;
                        foreach ($data as $row) {
                        ?>
                            <tr>
                                <td> <?php echo $count ?></td>
                                <td> <?php echo $row["Book_id"] ?></td>
                                <td> <?php echo $row["BookName"] ?></td>

                                <td><a href='../functions/uploads/<?php echo $row["BookPath"] ?>' target="_thapa">View</a></td>
                                <td> <?php echo $row["createdBy"] ?></td>
                                <td> <?php echo $row["User_id"] ?></td>
                                <td>
                                    <button type="button" class="btn btn-outline-success">Accept</button>
                                    <button type="button" class="btn btn-outline-danger">Decline</button>

                                </td>

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



    <!-- BOOTSTRAP JS PLUGIN -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <!-- SCRIPT -->
    <script src="js/sidebar-script.js"></script>
</body>

</html>