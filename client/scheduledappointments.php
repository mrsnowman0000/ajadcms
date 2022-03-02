<?php include '../includes/navbar.php'; ?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/ajadcmsDB.php'; ?>

<div class="table-container">
	<h2>Scheduled Appointments</h2>
</div>

<body>
	<?php
	$sql = "SELECT * FROM apprvd_appts;";
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
					<th>Actions</th>
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
						<td> <button class="btn btn-success" data-toggle="modal" data-target="#markdoneModal<?php echo $id ?>"><i class="fas fa-clipboard-check"></i> Mark Done </button>
							<button class="btn btn-danger" data-toggle="modal" data-target="#CancelAppt<?php echo $id ?>"><i class="fas fa-times-circle"></i> Cancel </button>
						</td>
					</tr>

					<!-- Modal for MARK DONE Button -->
					<div class="modal fade" id="markdoneModal<?php echo $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">

								<div class="modal-header">
									<h4 class="modal-title">Appointment Details</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<form action="clincludes/addappointmenthistory.php" method="POST">
									<div class="modal-body">
										<div class="form-group">
											<input type="text" name="id" class="form-control" id="id" value="<?php echo $id ?>" hidden>
											<label> Name: <?php echo $row['users_name'] ?></label>
											<input type="text" name="name" class="form-control" value="<?php echo $row['users_name'] ?>" hidden>
										</div>

										<div class="form-group">
											<label> E-mail: <?php echo $row['users_email'] ?></label>
											<input type="text" name="email" class="form-control" value="<?php echo $row['users_email'] ?>" hidden>
										</div>

										<div class="form-group">
											<label> Contact Number: <?php echo $row['users_contact'] ?></label>
											<input type="text" name="contact" class="form-control" value="<?php echo $row['users_contact'] ?>" hidden>
										</div>

										<div class="form-group">
											<label> Date: <?php echo $row['appt_date'] ?></label>
											<input type="datetime" name="appt_date" class="form-control" value="<?php echo $row['appt_date'] ?>" hidden>
										</div>

										<div class="form-group">
											<label> Type of Appointment: <?php echo $row['service_name'] ?></label>
											<input type="text" name="service_type" class="form-control" value="<?php echo $row['service_type'] ?>" hidden>
										</div>

										<div class="form-group">
											<label> Service: <?php echo $row['service_name'] ?></label>
											<input type="text" name="service_name" class="form-control" value="<?php echo $row['service_name'] ?>" hidden>
										</div>

										<div class="form-group">
											<label> Service Price: </label>
											<input type="text" id="service_price<?php echo $row['appt_id'] ?>" name="service_price" class="form-control" required>
										</div>

										<div class="form-group">
											<label> Mode of Payment: </label>
											<select class="form-control" name="mop" id="mop<?php echo $id ?>" onchange='CheckMOP(this.value)'>
												<option>Select Mode of Payment</option>
												<option value="full">Full</option>
												<option value="installment">Installment</option>
											</select>
										</div>

										<div class="form-group">
											<!-- <label> Amount to be Paid: </label> -->
											<input type="text" name="amount_paid" id="amount_paid<?php echo $id ?>" class="form-control" style='display:none;' placeholder="Input Amount to Pay">
										</div>

										<div class="form-group">
											<label> Description: </label>
											<input type="text" name="description" class="form-control">
										</div>

									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-success" name="addtohistory"> OK </button>
										<button type="button" class="btn btn-btn" data-dismiss="modal">Cancel</button>
									</div>
								</form>
							</div>
						</div>
					</div>

					<!-- Modal for Cancel Button -->
					<div class="modal fade" id="CancelAppt<?php echo $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
										<a type="button" class="btn btn-success" href="clincludes/delschedappt.php?Del=<?php echo $id ?> "> OK </a>
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

<script type="text/javascript">
	function CheckMOP(val) {

		<?php
		$sql = "SELECT * FROM apprvd_appts;";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		?>
		<?php while ($row = mysqli_fetch_assoc($result)) { ?>
			var element = document.getElementById('amount_paid' + <?php echo $row['appt_id'] ?>);

			if (val == 'installment') {
				element.style.display = 'block';
			} else {
				element.style.display = 'none';
			}

		<?php } ?>
	}
</script>


<?php
$sql = "SELECT * FROM apprvd_appts;";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
?>
<?php while ($row = mysqli_fetch_assoc($result)) { ?>

	<script type="text/javascript">
		$('#amount_paid' + <?php echo $row['appt_id'] ?>).keyup(function(event) {

			// skip for arrow keys
			if (event.which >= 37 && event.which <= 40) {
				event.preventDefault();
			}

			var currentVal = $(this).val();
			var testDecimal = testDecimals(currentVal);
			if (testDecimal.length > 1) {
				console.log("You cannot enter more than one decimal point");
				currentVal = currentVal.slice(0, -1);
			}
			$(this).val(replaceCommas(currentVal));
		});

		function testDecimals(currentVal) {
			var count;
			currentVal.match(/\./g) === null ? count = 0 : count = currentVal.match(/\./g);
			return count;
		}

		function replaceCommas(yourNumber) {
			var components = yourNumber.toString().split(".");
			if (components.length === 1)
				components[0] = yourNumber;
			components[0] = components[0].replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
			if (components.length === 2)
				components[1] = components[1].replace(/\D/g, "");
			return components.join(".");
		}
	</script>
<?php } ?>


<?php
$sql = "SELECT * FROM apprvd_appts;";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
?>
<?php while ($row = mysqli_fetch_assoc($result)) { ?>

	<script type="text/javascript">
		$('#service_price' + <?php echo $row['appt_id'] ?>).keyup(function(event) {

			// skip for arrow keys
			if (event.which >= 37 && event.which <= 40) {
				event.preventDefault();
			}

			var currentVal = $(this).val();
			var testDecimal = testDecimals(currentVal);
			if (testDecimal.length > 1) {
				console.log("You cannot enter more than one decimal point");
				currentVal = currentVal.slice(0, -1);
			}
			$(this).val(replaceCommas(currentVal));
		});

		function testDecimals(currentVal) {
			var count;
			currentVal.match(/\./g) === null ? count = 0 : count = currentVal.match(/\./g);
			return count;
		}

		function replaceCommas(yourNumber) {
			var components = yourNumber.toString().split(".");
			if (components.length === 1)
				components[0] = yourNumber;
			components[0] = components[0].replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
			if (components.length === 2)
				components[1] = components[1].replace(/\D/g, "");
			return components.join(".");
		}
	</script>
<?php } ?>