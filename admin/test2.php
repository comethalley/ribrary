<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link href='https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

</head>

<body>

    <div class="container">

        <div class="row" style="padding:50px;">
            <p>
            <h1>DataTable AJAX pagination using PHP and Mysqli</h1>
            </p>
            <div>
                <table id='empTable' class='display dataTable' width='100%'>
                    <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>Position</th>
                            <th>Age</th>
                            <th>Salary</th>
                            <th>Office</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>


    <script>
         $(document).ready(function(){
            var empDataTable = $('#empTable').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url':'ajax.php'
                },
                pageLength: 5,
                'columns': [
                    { data: 'name' },
                    { data: 'position' },
                    { data: 'age' },
                    { data: 'salary' },
                    { data: 'office' },
                ]
            });
        });
    </script>
</body>

</html>