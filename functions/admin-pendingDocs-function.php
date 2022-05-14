<?php
include '../includes/autoload-class.php';
$admin = new Admin();

if (isset($_POST['accept-docs'])) {

    $doc_id = $_POST['doc_id'];

    if (!$doc_id) return;
    $data = $admin->getResearchDocument($doc_id);
    if ($data) {
        $admin->notification($data['doc_name'], $data['doc_file'], $data['doc_path'], $data['createdBy'], $data['user_id'], 'accepted', 'unread');
    }

    $admin->accept_documents($doc_id);
}

if (isset($_POST['decline-docs'])) {

    $doc_id = $_POST['doc_id'];
    $message = $_POST['decline-text'];

    if (!$doc_id) return;
    $data = $admin->getResearchDocument($doc_id);
    if ($data) {
        $admin->notification($data['doc_name'], $data['doc_file'], $data['doc_path'], $data['createdBy'], $data['user_id'], 'declined', 'unread', $message);
    }

    $admin->decline_documents($doc_id, $message);
}
