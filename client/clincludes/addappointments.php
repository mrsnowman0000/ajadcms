<?php
include_once '../../includes/ajadcmsDB.php';

$users_name = $_POST['name'];
$users_email = $_POST['email'];
$users_contact = $_POST['contact'];
$service_name = $_POST['service_name'];
$appt_date = $_POST['appt_date'];
$service_type = $_POST['service_type'];

$sql = "INSERT INTO req_appts(users_name, users_email, users_contact, service_name, appt_date, service_type)
VALUES ('$users_name','$users_email','$users_contact','$service_name','$appt_date','$service_type');";

$result = mysqli_query($conn, $sql);

if($result) {
    echo "<script>
        alert('Request Sent. Thank you!');
        window.location.href = '../apptreqs.php';
        </script>";
}
else {
    echo "<script>
        alert('Data Not Saved!');
        window.location.href = '../apptreqs.php';
        </script>";
}
