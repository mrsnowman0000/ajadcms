<?php
require_once '../../includes/ajadcmsDB.php';

if (isset($_POST['update'])) {

    $id = $_POST['id'];
        $query = "UPDATE appt_history SET archive=1 WHERE appt_id='$id'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "<script>
            alert('Data Saved Successfully!');
            window.location.href = '../sales.php';
            </script>";
        } else {
            echo "<script>
            alert('Data Not Saved!');
            window.location.href = '../sales.php';
            </script>";
        }
    }
 else {
    header("location: ../sales.php");
}
