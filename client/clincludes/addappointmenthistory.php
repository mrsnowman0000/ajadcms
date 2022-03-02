<?php
include_once '../../includes/ajadcmsDB.php';

if (isset($_POST['addtohistory'])) {

    $users_name = $_POST['name'];
    $users_email = $_POST['email'];
    $users_contact = $_POST['contact'];
    $service_type = $_POST['service_type'];
    $service_name = $_POST['service_name'];
    $service_price = str_replace(',', '', $_POST['service_price']);
    $appt_date = $_POST['appt_date'];
    $mop = $_POST['mop'];
    $amount_paid = str_replace(',', '', $_POST['amount_paid']); 
    $description = $_POST['description'];
    if ($mop == "full") {
        $amount_paid = $service_price;
    }
    $balance = $service_price - $amount_paid;

    if ($amount_paid <= 0 || $service_price <=0) {
        echo "<script>
                alert('Invalid input');
                window.location.href = '../scheduledappointments.php';
                </script>";
    } else {

        $sql = "INSERT INTO appt_history(users_name, users_email, users_contact, service_name,service_price,service_type, appt_date, mop, amount_paid, balance, appt_desc)
VALUES ('$users_name','$users_email','$users_contact','$service_name','$service_price','$service_type','$appt_date','$mop','$amount_paid','$balance','$description');";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            $id = $_POST['id'];
            $query = "delete from apprvd_appts where appt_id='" . $id . "'";
            $result2 = mysqli_query($conn, $query);

            if ($result2) {
                echo "<script>
            alert('Appointment Marked Done!');
            window.location.href = '../scheduledappointments.php';
            </script>";
            } else {
                echo "<script>
                alert('Failed To Delete From Approved Appointments!');
                window.location.href = '../scheduledappointments.php';
                </script>";
            }
        } else {
            echo "<script>
        alert('Data Not Saved!');
        window.location.href = '../scheduledappointments.php';
        </script>";
        }
    }
} else {
    header("location: ../scheduledappointments.php");
}
