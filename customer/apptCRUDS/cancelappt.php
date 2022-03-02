<?php

require_once '../../includes/ajadcmsDB.php';

if(isset($_GET['Del'])) {

    $id = $_GET['Del'];
    $query = "delete from apprvd_appts where appt_id='".$id."'";
    $result = mysqli_query($conn,$query);

    
    if($result) {
        echo "<script>
            alert('Appointment Cancelled!');
            window.location.href = '../scheduledappointments.php';
            </script>";
    }
    else {
        echo "<script>
            alert('Error!');
            window.location.href = '../scheduledappointments.php';
            </script>";
    }
}
else {
    header("location: ../scheduledappointments.php");
}

