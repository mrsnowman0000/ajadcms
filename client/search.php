<console class="log">aefaasdf</console>
<?php
require_once '../../includes/ajadcmsDB.php';
$rollNo=$_REQUEST['rollNo'];
if($rollNo!==""){
    $sql = "SELECT * FROM user_profile WHERE users_id = '$rollNo';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $users_email = $row["users_email"];
    $users_name = $row["users_name"];
}

$hold = array ("$users_name","$users_email");
$myJSON =json_encode($hold);
echo $myJSON;
?>