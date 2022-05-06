<?php
include '../includes/autoload-class.php';

// if (isset($_POST["view"])) {
    $user = new User();

    $data = $user->getNotification('1');

 
    // echo $newData;
    echo json_encode($data);
// }
