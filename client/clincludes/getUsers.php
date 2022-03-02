<?php
include_once '../../includes/ajadcmsDB.php';
    $sql = "SELECT users_name FROM user_profile;";
    $result = mysqli_query($conn, $sql);
    
    while($row = mysqli_fetch_array($result)) {
        echo $row['users_name'].'|';
    }

?>