<?php
session_start();

if (isset($_POST['submit'])) {
    include '../includes/autoload-class.php';
    $user = new User();

    $subject = $_POST['subject'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $data = $user->emailExist($email);
    if (!$data) {
        header("Location:../webpage/ticket.php?error=emailError");
        exit();
    }

    if ($data['User_id'] !== $_SESSION['id']) {
        header("Location:../webpage/ticket.php?error=emailWrong");
        exit();
    }

    $user->tickets($subject, $email, $message, $_SESSION['id']);
    header("Location:../webpage/ticket.php?q=success");
    exit();
}
