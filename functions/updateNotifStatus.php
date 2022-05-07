<?php
include '../includes/autoload-class.php';
session_start();

$user = new User();

$data = $user->updateNotifStatus($_SESSION["id"]);
