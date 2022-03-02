<?php include 'cusincludes/customerheader.php'; ?>
<?php include 'cusincludes/customernavbar.php'; ?>
<?php include '../includes/ajadcmsDB.php'; ?>

<div class="table-container">
	<h2>Scheduled Appointments</h2>
</div>

<body>
	<?php
	$sql = "SELECT * FROM apprvd_appts WHERE users_email = '" . $_SESSION['name'] . "';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	?>

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
					<th>Appt Date</th>
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
					$date = $row['appt_date'];
				?>

					<tr>
						<td> <?php echo $id ?> </td>
						<td> <?php echo $name ?> </td>
						<td> <?php echo $email ?> </td>
						<td> <?php echo $contact ?> </td>
						<td> <?php echo $service ?> </td>
						<td> <?php echo $service_type ?> </td>
						<td> <?php echo $date ?> </td>
						<td> <button class="btn btn-info" data-toggle="modal" data-target="#viewModal<?php echo $id ?>"><i class="fas fa-info-circle"></i> Details </button>
							<button class="btn btn-danger" data-toggle="modal" data-target="#cancelModal<?php echo $id ?>"><i class="fas fa-times-circle"></i> Cancel </button>
						</td>
					</tr>

					<!-- Modal for View Button -->
					<div class="modal fade" id="viewModal<?php echo $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">

								<div class="modal-header">
									<h4 class="modal-title">Appointment Details</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<form action="clincludes/addscheduleappt.php" method="POST">
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
											<label> Type of Appointment: <?php echo $row['service_name'] ?></label>
											<input type="text" name="service_type" class="form-control" value="<?php echo $row['service_type'] ?>" hidden>
										</div>

										<div class="form-group">
											<label> Appointment Date: <?php echo $row['appt_date'] ?></label>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-btn" data-dismiss="modal">Close</button>
									</div>
								</form>
							</div>
						</div>
					</div>

					<!-- Modal for Cancel Button -->
					<div class="modal fade" id="cancelModal<?php echo $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">

								<div class="modal-header">
									<h4 class="modal-title">CONFIRM CANCELATION</h4>
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
											<label> Type of Appointment: <?php echo $row['service_name'] ?></label>
											<input type="text" name="service_type" class="form-control" value="<?php echo $row['service_type'] ?>" hidden>
										</div>

										<div class="form-group">
											<label> Appointment Date: <?php echo $row['appt_date'] ?></label>
										</div>
									</div>
									<div class="modal-footer">
										<a type="button" class="btn btn-success" href="apptCRUDS/cancelappt.php?Del=<?php echo $id ?> "> OK </a>
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