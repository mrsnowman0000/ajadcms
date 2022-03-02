<?php
require_once '../../includes/ajadcmsDB.php';

if (isset($_POST['update'])) {

    $id = $_POST['id'];
    $mop = $_POST['mop'];
    $service_price = str_replace(',', '', $_POST['service_price']);
    $amount_paid = str_replace(',', '', $_POST['amount_paid']);
    $new_amount_paid = str_replace(',', '', $_POST['new_amount_paid']);
    $balance = str_replace(',', '', $_POST['balance']);
    $total_amount_paid;
    if ($mop == "full") {
        $new_amount_paid = $balance;
        $total_amount_paid = $service_price;
    } else {

        $total_amount_paid = $amount_paid + $new_amount_paid;
    }
    $balance = $service_price - $total_amount_paid;

    if ($new_amount_paid <= 0) {
        echo "<script>
                alert('Invalid input');
                window.location.href = '../sales.php';
                </script>";
    } else {
        $query = "UPDATE appt_history SET mop='$mop', amount_paid='$total_amount_paid', balance='$balance' WHERE appt_id='$id'";
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
} else {
    header("location: ../sales.php");
}
