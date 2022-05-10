<?php
include '../includes/autoload-class.php';
$admin = new Admin();

if (isset($_POST['accept-admin'])) {

    $id = $_POST['admin_id'];
    $role = $_POST['role'];

    if (!$id) return;

    $admin->updateAdminRole($id, $role);
}

if (isset($_POST['decline-admin'])) {
    $id = $_POST['admin_id'];

    if (!$id) return;
    $admin->updateAdminRole($id, 'decline');
}
