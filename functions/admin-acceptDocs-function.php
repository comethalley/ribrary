<?php

if (isset($_POST['accept-docs'])) {

    include '../includes/autoload-class.php';
    $admin = new Admin();

    $doc_id = $_POST['doc_id'];
    $data = $admin->getUploadedDocs($doc_id);

    print_r($data);

    if (!$data) return;

    $admin->accept_documents($data['doc_name'], $data['doc_file'], $data['doc_path'], $data['createdBy'], $doc_id, $data['user_id']);
}
