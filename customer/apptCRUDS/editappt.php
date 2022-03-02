<?php
require_once '../../includes/ajadcmsDB.php';

if (isset($_POST['update'])) {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $service = $_POST['service'];
    $service_type = $_POST['service_type'];
    $date = $_POST['appt_date'];

    $query = "UPDATE req_appts SET users_name='$name', users_email='$email', users_contact='$contact', service_name='$service', service_type='$service_type', appt_date='$date' WHERE appt_id='$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>
            alert('Data Saved Successfully!');
            window.location.href = '../customerportal.php';
            </script>";
    } else {
        echo "<script>
            alert('Data Not Saved!');
            window.location.href = '../customerportal.php';
            </script>";
    }
} else {
    header("location: ../customerportal.php");
}
