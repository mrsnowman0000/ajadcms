<?php include '../includes/navbar.php'; ?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/ajadcmsDB.php'; ?>

<div class="table-container">
	<h2>Sales</h2>
</div>

<body>
	<?php
	$sql = "SELECT * FROM appt_history WHERE archive <= 0;";
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
						<td> <button class="btn btn-info" data-toggle="modal" data-target="#markdoneModal<?php echo $id ?>"><i class="fas fa-info-circle"></i> Details </button>
							<button class="btn btn-warning" data-toggle="modal" data-target="#editAppointmentModal<?php echo $id ?>"><i class="fas fa-pen"></i> Edit </button>
						</td>
					</tr>

					<!-- Modal for View Button -->
					<div class="modal fade" id="markdoneModal<?php echo $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
								<form action="clincludes/editSales.php" method="POST">
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
											<input type="text" name="appt_date" class="form-control" value="<?php echo $row['appt_date'] ?>" hidden>
										</div>

										<div class="form-group">
											<label> Appointment Type: <?php echo $row['appt_desc'] ?></label>
											<input type="datetime" name="appt_desc" class="form-control" value="<?php echo $row['appt_date'] ?>" hidden>
										</div>

										<div class="form-group">
											<label> Service: <?php echo $row['service_name'] ?></label>
											<input type="text" name="service_name" class="form-control" value="<?php echo $row['service_name'] ?>" hidden>
										</div>

										<div class="form-group">
											<label> Balance: <?php echo $row['balance'] ?></label>
											<input type="text"  name="balance" value="<?php echo $row['balance'] ?>" class="form-control" hidden>
										</div>

										<div class="form-group">
											<label> Service Price: </label>
											<input type="text" id="service_price<?php echo $row['appt_id'] ?>" name="service_price" value="<?php echo $row['service_price'] ?>" class="form-control" required>
										</div>

										<div class="form-group">
											<label> Mode of Payment: </label>
											<select class="form-control" name="mop" id="mop<?php echo $id ?>" onchange='CheckMOP(this.value)'>
												<option value="full">Full</option>
												<option value="installment">Installment</option>
											</select>
										</div>

										<div class="form-group">
											<!-- <label> Amount to be Paid: </label> -->
											<input type="text" name="new_amount_paid" id="new_amount_paid<?php echo $id ?>" class="form-control" style='display:none;' placeholder="Input Amount to Pay">
										</div>
										<input type="text"  name="amount_paid" value="<?php echo $row['amount_paid'] ?>" class="form-control" hidden>

									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-success" name="update"> Save Changes </button>
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
	$sql = "SELECT * FROM appt_history WHERE archive <= 0;";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	?>

		<?php while ($row = mysqli_fetch_assoc($result)) { ?>
			var element = document.getElementById('new_amount_paid' + <?php echo $row['appt_id'] ?>);

			if (val == 'installment') {
				element.style.display = 'block';
			} else {
				element.style.display = 'none';
			}

		<?php } ?>
	}
</script>


<?php
	$sql = "SELECT * FROM appt_history WHERE archive <= 0;";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	?>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>

	<script type="text/javascript">
		$('#new_amount_paid' + <?php echo $row['appt_id'] ?>).keyup(function(event) {

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
	$sql = "SELECT * FROM appt_history WHERE archive <= 0;";
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