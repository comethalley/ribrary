<?php
session_start();
session_unset();
session_destroy();

//Go back to admin-login
header("Location: ../admin/admin-login.php");