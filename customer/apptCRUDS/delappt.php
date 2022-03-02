<?php

require_once '../../includes/ajadcmsDB.php';

if(isset($_GET['Del'])) {

    $id = $_GET['Del'];
    $query = "delete from req_appts where appt_id='".$id."'";
    $result = mysqli_query($conn,$query);

    
    if($result) {
        echo "<script>
            alert('Appointment Deleted!');
            window.location.href = '../customerportal.php';
            </script>";
    }
    else {
        echo "<script>
            alert('Data Not Deleted!');
            window.location.href = '../customerportal.php';
            </script>";
    }
}
else {
    header("location: ../customerportal.php");
}

