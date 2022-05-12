<?php
include '../includes/autoload-class.php';
$admin = new Admin();

if (isset($_POST['accept-docs'])) {

    $doc_id = $_POST['doc_id'];

    if (!$doc_id) return;

    $admin->accept_documents($doc_id);
}

if (isset($_POST['decline-docs'])) {

    $doc_id = $_POST['doc_id'];
    $message = $_POST['decline-text'];

    if (!$doc_id) return;

    $admin->decline_documents($doc_id, $message);
}
