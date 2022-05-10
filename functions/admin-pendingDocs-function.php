<?php
include '../includes/autoload-class.php';
$admin = new Admin();

if (isset($_POST['accept-docs'])) {

    $doc_id = $_POST['doc_id'];
    $data = $admin->getUploadedDocs($doc_id);

    if (!$data) return;

    $admin->accept_documents($data['doc_name'], $data['doc_file'], $data['doc_path'], $data['createdBy'], $doc_id, $data['user_id']);
}

if (isset($_POST['decline-docs'])) {

    $doc_id = $_POST['doc_id'];
    $message = $_POST['decline-text'];

    if (!$doc_id) return;

    $admin->decline_documents($doc_id, $message);
}
