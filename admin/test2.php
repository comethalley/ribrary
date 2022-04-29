<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location:admin-login.php");
} else {
    include '../includes/autoload-class.php';
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
    <title>Document</title>

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- DATATABLES -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <style>
        .container {
            width: 100%;
        }
    </style>
</head>

<body>


    <div class="container">
        <table id="table_id" class="display table">
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
                $data = $admin->displayPendingDocuments('', $start_from, $num_per_page);
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

        <?php
        $data = $admin->displayPendingDocuments("all");
        $total_record = count($data);

        $total_page = ceil($total_record / $num_per_page);
        ?>

        <?php
        if ($page > 1) {
        ?>
            <a href='test2.php?page=<?php echo $page - 1;?>' class="btn btn-primary"> Previous</a>
        <?php
        }
        ?>

        <?php
        for ($i = 1; $i < $total_page; $i++) {
        ?>
            <a href='test2.php?page=<?php echo $i; ?>' class="btn btn-primary"> <?php echo $i; ?> </a>
        <?php
        }
        ?>

        <?php
        if ($i > $page) {
        ?>
            <a href='test2.php?page=<?php echo $page +1; ?>' class="btn btn-primary"> Next</a>
        <?php
        }
        ?>


    </div>


    <script>
        $(document).ready(function() {

            $('#table_id').DataTable({
                paging: false,
                scrollY: false, //400
                searching: true,

            });
        });
    </script>
</body>

</html>