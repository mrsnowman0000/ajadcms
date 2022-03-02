<?php
include_once '../../includes/ajadcmsDB.php';
$sql = "SELECT * FROM user_profile";

$result = mysqli_query($conn, $sql);
?>