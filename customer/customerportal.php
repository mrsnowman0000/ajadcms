<?php include 'cusincludes/customerheader.php'; ?>
<?php include 'cusincludes/customernavbar.php'; ?>
<?php include '../includes/ajadcmsDB.php'; ?>

<?php
$sql = "SELECT * FROM user_profile WHERE users_email = '" . $_SESSION['name'] . "';";
$user = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($user);
?>

<?php
$sql = "SELECT * FROM req_appts WHERE users_email = '" . $_SESSION['name'] . "';";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
?>

<div class="table-container">
    <h2>Appointment Requests
        <button type="button" class="btn btn btn-primary float-right" data-toggle="modal" data-target="#addappointment"><i class="fas fa-edit"></i> Add Appointment </button>
    </h2>
</div>

<!-- Modal for ADD Button -->
<div class="modal fade" id="addappointment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Appointment Request</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <?php

            // output data of each row
            while ($row = mysqli_fetch_assoc($user)) {
                $userid = $row['users_id'];
                $username = $row['users_name'];
                $useremail = $row['users_email'];
                $usercontact = $row['users_contact'];

            ?>

                <form action="apptCRUDS/addappt.php" autocomplete="off" method="POST">
                    <div class="modal-body">
                        <div class="form-group">

                        <!-- <label> Name: <?php echo $username ?> </label> -->
                        <input type="text" name="username"  class="form-control" value="<?php echo $username ?>" hidden>

                        <!-- <br> -->
                        <!-- <label> E-mail: <?php echo $useremail ?> </label> </label> -->
                        <input type="text" name="email" value="<?php echo $useremail ?>" class="form-control" hidden>

                        <!-- <br> -->
                        <!-- <label> Contact Number: <?php echo $usercontact ?> </label> </label> -->
                        <input type="text" name="contact" value="<?php echo $usercontact ?>" class="form-control" hidden>

                        <!-- <br> -->
						<label> Type of Appointment: </label>
						<select class="form-control" name="service_type">
							<option value="ortho">Ortho</option>
							<option value="others">Others</option>
						</select>

                        <br>
                        <label> Service </label>
                        <input type="text" name="service_name" class="form-control" required>

                        <br>
                        <label> Appointment Date </label>
                        <input type="datetime-local" name="appt_date" class="form-control" required>
                    </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success">Submit</button>
            <button type="button" data-dismiss="modal" class="btn">Cancel</button>
        </div>
        </form>
    </div>
</div>
</div>
<?php }  ?>


<body>
    <div class="table-container">
        <table class="table table-bordered table-responsive-sm" id="example1" width="100%">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact No</th>
                    <th>Service</th>
                    <th>Type</th>
                    <th>Appointment Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                <?php

                // output data of each row
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['appt_id'];
                    $name = $row['users_name'];
                    $email = $row['users_email'];
                    $contact = $row['users_contact'];
                    $service = $row['service_name'];
                    $service_type = $row['service_type'];
                    $appt_date = $row['appt_date'];
                ?>

                    <tr>
                        <td> <?php echo $id ?> </td>
                        <td> <?php echo $name ?> </td>
                        <td> <?php echo $email ?> </td>
                        <td> <?php echo $contact ?> </td>
                        <td> <?php echo $service ?> </td>
                        <td> <?php echo $service_type ?> </td>
                        <td> <?php echo $appt_date ?> </td>
                        <td> <button class="btn btn-warning" data-toggle="modal" data-target="#editAppointmentModal<?php echo $id ?>"><i class="fas fa-pen"></i> Edit </button>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#deleteAppointmentModal<?php echo $id ?>"><i class="fa fa-trash"></i> Delete </button>
                        </td>
                    </tr>

                    <!-- Modal for EDIT Button -->
                    <div class="modal fade" id="editAppointmentModal<?php echo $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h4 class="modal-title">Appointment Details</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="apptCRUDS/editappt.php" method="POST">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="text" name="id" class="form-control" id="id" value="<?php echo $id ?>" hidden>

                                            <!-- <label> Name </label> -->
                                            <input type="text" name="name" class="form-control" value="<?php echo $row['users_name'] ?>" hidden>

                                            <!-- <br>
                                            <label> E-mail </label> -->
                                            <input type="text" name="email" class="form-control" value="<?php echo $row['users_email'] ?>" hidden>

                                            <!-- <br>
                                            <label> Contact Number </label> -->
                                            <input type="text" name="contact" class="form-control" value="<?php echo $row['users_contact'] ?>" hidden>

                                            <!-- <br> -->
                                            <label> Service </label>
                                            <input type="text" name="service" class="form-control" value="<?php echo $row['service_name'] ?>" required>

                                            <br>
                                            <label> Type </label>
                                            <input type="text" name="service_type" class="form-control" value="<?php echo $row['service_type'] ?>" required>

                                            <br>
                                            <label> Appointment Date</label>
                                            <input type="datetime-local" name="appt_date" class="form-control" value="<?php echo $row['appt_date'] ?>" required>

                                            <br>
                                            <label> Type of Appointment: </label>
                                            <select class="form-control" name="service_type" placeholder="Select from Dropdown">s
                                                <option value="ortho">Ortho</option>
                                                <option value="others">Others</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success" name="update"> Save Changes </button>
                                        <button type="button" class="btn btn-btn" data-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for DELETE Button -->
                    <div class="modal fade" id="deleteAppointmentModal<?php echo $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h4 class="modal-title">CONFIRM DELETION</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="POST">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="text" name="id" class="form-control" id="id" value="<?php echo $id ?>" hidden>
                                            <label> Name: <?php echo $row['users_name'] ?></label>
                                        </div>

                                        <div class="form-group">
                                            <label> E-mail: <?php echo $row['users_email'] ?></label>
                                        </div>

                                        <div class="form-group">
                                            <label> Contact Number: <?php echo $row['users_contact'] ?></label>
                                        </div>

                                        <div class="form-group">
                                            <label> Service: <?php echo $row['service_name'] ?></label>
                                        </div>

                                        <div class="form-group">
                                            <label> Appointment Type: <?php echo $row['service_type'] ?></label>
                                        </div>

                                        <div class="form-group">
                                            <label> Appointment Date: <?php echo $row['appt_date'] ?></label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a type="button" class="btn btn-success" href="apptCRUDS/delappt.php?Del=<?php echo $id ?> "> OK </a>
                                        <button type="button" class="btn btn-btn" data-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php }  ?>
            </tbody>

        </table>

    </div>
</body>


<?php include 'cusincludes/customerfooter.php'; ?>