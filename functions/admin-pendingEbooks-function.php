<?php
include '../includes/autoload-class.php';
$admin = new Admin();

if (isset($_POST['accept-ebooks'])) {

    $ebooks_id = $_POST['ebooks_id'];

    if (!$ebooks_id) return;
    $admin->updateEbookStatus($ebooks_id, 'accepted');
}

if (isset($_POST['decline-ebooks'])) {
    $ebooks_id = $_POST['ebooks_id'];
    if (!$ebooks_id) return;
    $admin->updateEbookStatus($ebooks_id, 'decline');
}
