<?php
session_start();

if (!isset($_SESSION['admin_name'])) {
    header("Location:index.php");
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
    <title>Pending Ebooks</title>

    <!-- GOOGLE FONT LINK -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!-- LINK FOR INCON (FONTAWESOME) -->
    <script defer src="https://kit.fontawesome.com/86dc2a589d.js" crossorigin="anonymous"></script>

    <!-- Sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- JQUERY -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->

    <!-- DATATABLES -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <!-- CSS TYLES -->
    <link rel="stylesheet" href="css/admin-pending-style.css">
    <link rel="stylesheet" href="css/sidebar-style.css">

    <style>
        <?php
        if ($_SESSION["role"] == 'main admin') {

        ?>.list:nth-of-type(2) {
            border-left: 5px solid transparent;
        }

        .list:nth-of-type(2) .link:nth-of-type(1) {
            background-color: transparent;
        }

        /* ----------------------------- */
        .list:nth-of-type(7) {
            border-left: 5px solid #4980ff;
            padding-left: 1.688em;
        }

        .list:nth-of-type(7) .link:nth-of-type(1) {
            background-color: #4980ff;
            border-radius: 8px;
        }

        <?php
        } else {
        ?>.list:nth-of-type(2) {
            border-left: 5px solid transparent;
        }

        .list:nth-of-type(2) .link:nth-of-type(1) {
            background-color: transparent;
        }

        /* ----------------------------- */
        .list:nth-of-type(4) {
            border-left: 5px solid #4980ff;
            padding-left: 1.688em;
        }

        .list:nth-of-type(4) .link:nth-of-type(1) {
            background-color: #4980ff;
            border-radius: 8px;
        }

        <?php
        }
        ?>
    </style>
</head>

<body>
    <main>
        <!-- include sidebar.php-->
        <?php include 'sidebar.php'; ?>
        <div class="main-container">

            <!-- Display User from database -->
            <div class="table-container">
                <!-- <button class="action">dsd</button> -->
                <h2>Pending Ebooks</h2>

                <table class="table" id="table_id">

                    <thead>
                        <tr class="table-header">
                            <th scope="col">No.</th>
                            <th scope="col">Ebooks Name</th>
                            <th scope="col">Ebooks File</th>
                            <th scope="col">Ebooks Cover</th>
                            <th scope="col">Categories</th>
                            <th scope="col">Author</th>
                            <th scope="col">Date and Time</th>
                            <th scope="col">Uploaded By</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody class="action">

                        <?php
                        $data = $admin->displayPending('tbl_ebooks', '', $start_from, $num_per_page);
                        $count = $start_from + 1;
                        foreach ($data as $row) {

                        ?>

                            <tr>
                                <td> <?php echo $count ?></td>
                                <td> <?php echo $row["ebooks_name"] ?></td>
                                <td><a href='../functions/uploads/<?php echo $row["ebooks_path"] ?>' target="_thapa">View</a></td>
                                <td> <a href='../functions/uploads/<?php echo $row["ebooks_cover_path"] ?>' target="_thapa">View</a></td>
                                <td> <?php echo $row["categories"] ?></td>
                                <td> <?php echo $row["author"] ?></td>
                                <td> <?php echo $row["date_and_time"] ?></td>
                                <td> <?php echo $row["uploaded_by"] ?></td>
                                <td>
                                    <input type="hidden" name="doc_id" value="<?php echo $row["ebooks_id"] ?>">
                                    <button type="button" class="btn btn-outline-success acceptBtn"> Accept</button>
                                    <button type="button" class="btn btn-outline-danger declineBtn">Decline</button>

                                </td>

                            </tr>
                        <?php
                            $count++;
                        }
                        ?>
                    </tbody>
                </table>

                <!-- ACCEPT MODAL -->
                <div class="modal fade" id="acceptModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form action="../functions/admin-pendingEbooks-function.php" method="POST">

                                <!-- DISPLAY -->
                                <div class="modal-body">

                                    <input type="hidden" name="ebooks_id" id="ebooks_id_accept">
                                    Are you sure you want to accept?
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" name="accept-ebooks" class="btn btn-primary">Yes</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <!-- DECLINE MODAL -->
                <div class="modal fade" id="declineModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form action="../functions/admin-pendingEbooks-function.php" method="POST">

                                <!-- DISPLAY -->
                                <div class="modal-body">

                                    <input type="hidden" name="ebooks_id" id="ebooks_id_decline">
                                    Are you sure you want to decline?
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" name="decline-ebooks" class="btn btn-primary">Done</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <!-- TOAST/ POP UP MODAL -->
                <div class="toast-container hidden">
                    <div class="toast-display">
                        <i class="bi bi-check-circle-fill"></i>
                        <p class="toast-sucess">Success <br> <span class="toast-sucess-subtext">changes successfuly</span></p>
                        <button class="close-toast"><i class="bi bi-x-lg"></i></button>
                    </div>
                </div>




                <!-- PAGE BUTTON  -->
                <div class="pagination">
                    <?php
                    $data = $admin->displayPending("tbl_ebooks", "all");
                    $total_record = count($data);

                    $total_page = ceil($total_record / $num_per_page);
                    ?>

                    <?php
                    if ($page > 1) {
                    ?>
                        <a href='admin-documents.php?page=<?php echo $page - 1; ?>' class="btn btn-primary page"> Previous</a>
                    <?php
                    }
                    ?>

                    <?php
                    for ($i = 1; $i < $total_page; $i++) {
                    ?>
                        <a href='admin-documents.php?page=<?php echo $i; ?>' class="btn btn-primary page"> <?php echo $i; ?> </a>
                    <?php
                    }
                    ?>

                    <?php
                    if ($i > $page) {
                    ?>
                        <a href='admin-documents.php?page=<?php echo $page + 1; ?>' class="btn btn-primary page"> Next</a>
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

    <script>
        const action = document.querySelector('.action');
        const showToast = document.querySelector('.show-toast')
        const toastContainer = document.querySelector('.toast-container')
        const closeToast = document.querySelector('.close-toast');

        const url = window.location.search
        const urlParam = new URLSearchParams(url)
        const success = urlParam.get('q')

        if (success && success == 'success') {
            toastContainer.classList.remove('hidden')

            setTimeout(() => {
                toastContainer.classList.add('hidden')
            }, 3000)
        }

        //Accept button function 
        action.addEventListener('click', function(e) {
            if (e.target.classList.contains('acceptBtn')) {
                $('#acceptModal').modal('show');
                const docId = e.target.closest('td').firstElementChild.value
                document.querySelector('#ebooks_id_accept').value = docId;
            }

            if (e.target.classList.contains('declineBtn')) {
                $('#declineModal').modal('show');
                const docId = e.target.closest('td').firstElementChild.value
                document.querySelector('#ebooks_id_decline').value = docId;
            }
        })

        closeToast.addEventListener('click', function() {
            toastContainer.classList.add('hidden')
        })
    </script>
    <script src="js/sidebar-script.js"></script>
</body>

</html>