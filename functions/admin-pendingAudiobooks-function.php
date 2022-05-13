<?php
include '../includes/autoload-class.php';
$admin = new Admin();

if (isset($_POST['accept-audiobook'])) {

    $audiobook_id = $_POST['audiobook_id'];

    if (!$audiobook_id) return;
    echo $audiobook_id;
    $admin->updateAudiobookStatus($audiobook_id, 'accepted');
}

if (isset($_POST['decline-audiobook'])) {
    $audiobook_id = $_POST['audiobook_id'];
    if (!$audiobook_id) return;

    $admin->updateAudiobookStatus($audiobook_id, 'decline');
}
