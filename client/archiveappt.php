<?php include '../includes/navbar.php'; ?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/ajadcmsDB.php'; ?>

<div class="table-container">
	<h2>Archive</h2>
</div>

<body>
	<?php
	$sql = "SELECT * FROM appt_history WHERE archive > 0;";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	?>

	<div class="table-container">
		<table class="table table-bordered table-responsive-sm" id="example1" width="100%">
			<thead class="thead-dark">
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Date</th>
					<th>Service</th>
					<th>Price</th>
					<th>MOP</th>
					<th>Amount Paid</th>
					<th>Balance</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>

				<?php

				// output data of each row
				while ($row = mysqli_fetch_assoc($result)) {
					$id = $row['appt_id'];
					$name = $row['users_name'];
					$date = $row['appt_date'];
					$service = $row['service_name'];
					$service_price = $row['service_price'];
					$mop = $row['mop'];
					$amount_paid = $row['amount_paid'];
					$balance = $row['balance'];
					$appt_desc = $row['appt_desc'];
				?>

					<tr>
						<td> <?php echo $id ?> </td>
						<td> <?php echo $name ?> </td>
						<td> <?php echo $date ?> </td>
						<td> <?php echo $service ?> </td>
						<td>₱ <?php echo $service_price ?> </td>
						<td> <?php echo $mop ?> </td>
						<td>₱ <?php echo $amount_paid ?> </td>
						<td>₱ <?php echo $balance ?> </td>
						<td> <button class="btn btn-info" data-toggle="modal" data-target="#viewModal<?php echo $id ?>"><i class="fas fa-info-circle"></i> Details </button>
							<button class="btn btn-danger" data-toggle="modal" data-target="#deleteAppointmentModal<?php echo $id ?>"><i class="fa fa-trash"></i> Delete </button>
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
										<div>
											<label> Name: <?php echo $row['users_name'] ?></label>
										</div>

										<div>
											<label> E-mail: <?php echo $row['users_email'] ?></label>
										</div>

										<div>
											<label> Contact Number: <?php echo $row['users_contact'] ?></label>
										</div>

										<div>
											<label> Appointment Date: <?php echo $row['appt_date'] ?></label>
										</div>

										<div>
											<label> Appointment Type: <?php echo $row['service_type'] ?></label>
										</div>

										<div>
											<label> Service: <?php echo $row['service_name'] ?></label>
										</div>

										<div>
											<label> Price: <?php echo $row['service_price'] ?></label>
										</div>

										<div>
											<label> Mode of Payment: <?php echo $row['mop'] ?></label>
										</div>

										<div>
											<label> Amount Paid: <?php echo $row['amount_paid'] ?></label>
										</div>

										<div>
											<label> Balance: <?php echo $row['balance'] ?></label>
										</div>

										<div>
											<label> Description: <?php echo $row['appt_desc'] ?></label>
										</div>

									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-btn" data-dismiss="modal">Close</button>
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
										<div>
											<label> Name: <?php echo $row['users_name'] ?></label>
										</div>

										<div>
											<label> E-mail: <?php echo $row['users_email'] ?></label>
										</div>

										<div>
											<label> Contact Number: <?php echo $row['users_contact'] ?></label>
										</div>

										<div>
											<label> Appointment Date: <?php echo $row['appt_date'] ?></label>
										</div>

										<div>
											<label> Appointment Type: <?php echo $row['service_type'] ?></label>
										</div>

										<div>
											<label> Service: <?php echo $row['service_name'] ?></label>
										</div>

										<div>
											<label> Price: <?php echo $row['service_price'] ?></label>
										</div>

										<div>
											<label> Mode of Payment: <?php echo $row['mop'] ?></label>
										</div>

										<div>
											<label> Amount Paid: <?php echo $row['amount_paid'] ?></label>
										</div>

										<div>
											<label> Balance: <?php echo $row['balance'] ?></label>
										</div>

										<div>
											<label> Description: <?php echo $row['appt_desc'] ?></label>
										</div>

									</div>
									<div class="modal-footer">
										<a type="button" class="btn btn-success" href="clincludes/delarchive.php?Del=<?php echo $id ?> "> OK </a>
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

<?php include '../includes/footer.php'; ?>