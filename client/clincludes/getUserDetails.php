<?php
include_once '../../includes/ajadcmsDB.php';
$q = $_GET['q'];
$sql = "SELECT * FROM user_profile WHERE users_name = '".$q."'";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($result)) {
    echo $row['users_email'].'|'.$row['users_contact'];
}

?>