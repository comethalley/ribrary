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
    <title>Audit Trail</title>

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

    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- DATATABLES -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

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
                <h2><b>Audit Trail</b></h2>

                <table class="table" id="table_id">

                    <thead>
                        <tr class="table-header">
                            <th scope="col">#</th>
                            <th scope="col">Date and Time</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action Made</th>

                        </tr>
                    </thead>

                    <tbody class="action">

                        <?php
                        $data = $admin->displayAuditTrail('', $start_from, $num_per_page);
                        $count = $start_from + 1;
                        foreach ($data as $row) {
                        ?>
                            <tr>
                                <td> <?php echo $count?></td>
                                <td> <?php echo $row["Date_and_Time"] ?></td>
                                <td> <?php echo $row["Name"] ?></td>
                                <td> <?php echo $row["Email"] ?></td>
                                <td> <?php echo $row["action"] ?></td>


                            </tr>
                        <?php
                            $count++;
                        }
                        ?>
                    </tbody>

                </table>

                <!-- PAGE BUTTON  -->
                <div class="pagination">
                    <?php
                    $data = $admin->displayAuditTrail("all");
                    $total_record = count($data);

                    $total_page = ceil($total_record / $num_per_page);
                    ?>

                    <?php
                    if ($page > 1) {
                    ?>
                        <a href='admin-audit-trail.php?page=<?php echo $page - 1; ?>' class="btn btn-primary page"> Previous</a>
                    <?php
                    }
                    ?>

                    <?php
                    for ($i = 1; $i < $total_page; $i++) {
                    ?>
                        <a href='admin-audit-trail.php?page=<?php echo $i; ?>' class="btn btn-primary page"> <?php echo $i; ?> </a>
                    <?php
                    }
                    ?>

                    <?php
                    if ($i > $page) {
                    ?>
                        <a href='admin-audit-trail.php?page=<?php echo $page + 1; ?>' class="btn btn-primary page"> Next</a>
                    <?php
                    }
                    ?>
                </div>

            </div>
        </div>
    </main>


    <!-- DATATABLES SCRIPT -->
    <script>
        $(document).ready(function() {

            $('#table_id').DataTable({
                paging: false,
                scrollY: false, //400
                searching: true,

            });
        });
    </script>

    <!-- SCRIPT -->
    <script src="js/sidebar-script.js"></script>
</body>

</html>