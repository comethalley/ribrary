//dbcon.php
<?php
$conn = new mysqli('localhost','root','','db_eread');
if ($conn->connect_error) {
    die('Error : ('. $conn->connect_errno .') '. $conn->connect_error);
}
?>