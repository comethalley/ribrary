<!DOCTYPE html>
<html>

<head>
    <title>Webslesson Tutorial | Facebook Style Header Notification using PHP Ajax Bootstrap</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>


    <script>
        // $(document).ready(function() {

        // function load_unseen_notification(view = '') {
        //     $.ajax({
        //         url: "fetch.php",
        //         method: "POST",
        //         data: {
        //             view: view
        //         },
        //         dataType: "json",
        //         success: function(data) {
        //             // $('.dropdown-menu').html(data.notification);
        //             // if (data.unseen_notification > 0) {
        //             //     $('.count').html(data.unseen_notification);
        //             // }
        //             console.log(data)
        //         }
        //     });
        // }


        // load_unseen_notification()
        // load_unseen_notification();

        // $('#comment_form').on('submit', function(event) {
        //     event.preventDefault();
        //     if ($('#subject').val() != '' && $('#comment').val() != '') {
        //         var form_data = $(this).serialize();
        //         $.ajax({
        //             url: "insert.php",
        //             method: "POST",
        //             data: form_data,
        //             success: function(data) {
        //                 $('#comment_form')[0].reset();
        //                 load_unseen_notification();
        //             }
        //         });
        //     } else {
        //         alert("Both Fields are Required");
        //     }
        // });

        // $(document).on('click', '.dropdown-toggle', function() {
        //     $('.count').html('');
        //     load_unseen_notification('yes');
        // });

        // setInterval(function() {
        //     load_unseen_notification();;
        // }, 5000);

        // });

        function requestNotif() {
            fetch('fetch.php')
                .then(response => {
                    return response.json()
                })
                .then(data => console.log(data))
        }
        requestNotif();
        // setInterval(function() {
        //     requestNotif() 
        // }, 2000);


    </script>
</body>

</html>