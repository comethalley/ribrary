<?php

if (isset($_POST['accept-admin'])) {

    include '../includes/autoload-class.php';
    $admin = new Admin();

    $id = $_POST['admin_id'];
    $role = $_POST['role'];

    if (!$id) return;
    
    $admin->updateAdminRole($id, $role);
}
decline-admin