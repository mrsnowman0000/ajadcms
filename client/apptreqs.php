<?php include '../includes/navbar.php'; ?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/ajadcmsDB.php'; ?>

<style>
	* {
		box-sizing: border-box;
	}

	body {
		font: 16px Arial;
	}

	/*the container must be positioned relative:*/
	.autocomplete {
		position: relative;
		display: inline-block;
	}

	input {
		border: 1px solid transparent;
		background-color: #f1f1f1;
		padding: 10px;
		font-size: 16px;
	}

	input[type=text] {
		background-color: #f1f1f1;
		width: 100%;
	}

	input[type=submit] {
		background-color: DodgerBlue;
		color: #fff;
		cursor: pointer;
	}

	.autocomplete-items {
		position: absolute;
		border: 1px solid #d4d4d4;
		border-bottom: none;
		border-top: none;
		z-index: 99;
		/*position the autocomplete items to be the same width as the container:*/
		top: 100%;
		left: 0;
		right: 0;
	}

	.autocomplete-items div {
		padding: 10px;
		cursor: pointer;
		background-color: #fff;
		border-bottom: 1px solid #d4d4d4;
	}

	/*when hovering an item:*/
	.autocomplete-items div:hover {
		background-color: #e9e9e9;
	}

	/*when navigating through the items using the arrow keys:*/
	.autocomplete-active {
		background-color: DodgerBlue !important;
		color: #ffffff;
	}
</style>

<div class="table-container">
	<h2>Appointments
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
			<form action="clincludes/addappointments.php" autocomplete="off" method="POST">

				<div class="modal-body">
					<div class="form-group">

						<!-- <label> Name </label> -->
						<!-- <input type="hidden" id="id" name="id"> -->
						<div class="autocomplete" style="width:100%;">
							<label>Name </label>
							<input id="name" type="text" name="name" placeholder="Select from Dropdown" onchange="showUserDetails()">
						</div>
						<br>
						<label> E-mail </label>
						<input type="text" name="email" id="users_email" class="form-control" required>

						<br>
						<label> Contact Number </label>
						<input type="text" name="contact" id="users_contact" class="form-control" required>

						<br>
						<label> Service </label>
						<input type="text" name="service_name" class="form-control" required>

						<br>
						<label> Appointment Date </label>
						<input type="text" name="appt_date" id="datepickerapptreq" class="form-control" required>

						<br>
						<label> Type of Appointment: </label>
						<select class="form-control" name="service_type" placeholder="Select from Dropdown">s
							<option value="ortho">Ortho</option>
							<option value="others">Others</option>
						</select>
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


<body>

	<?php
	$sql = "SELECT * FROM req_appts;";
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
					<th>Appointment Date</th>
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
						<td> <button class="btn btn-success" data-toggle="modal" data-target="#approveAppointmentModal<?php echo $id ?>"><i class="fas fa-tasks"></i> Approve </button>
							<button class="btn btn-warning" data-toggle="modal" data-target="#editAppointmentModal<?php echo $id ?>"><i class="fas fa-pen"></i> Edit </button>
							<button class="btn btn-danger" data-toggle="modal" data-target="#deleteAppointmentModal<?php echo $id ?>"><i class="fa fa-trash"></i> Delete </button>
						</td>
					</tr>

					<!-- Modal for APPROVE Button -->
					<div class="modal fade" id="approveAppointmentModal<?php echo $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
											<label> Service: <?php echo $row['service_name'] ?></label>
											<input type="text" name="service_name" class="form-control" value="<?php echo $row['service_name'] ?>" hidden>
										</div>

										<div class="form-group">
											<label> Type of Appointment: <?php echo $row['service_name'] ?></label>
											<input type="text" name="service_type" class="form-control" value="<?php echo $row['service_type'] ?>" hidden>
										</div>

										<div class="form-group">
											<label> Appointment Date: <?php echo $row['appt_date'] ?></label>
											<input type="datetime" name="appt_date" class="form-control" value="<?php echo $row['appt_date'] ?>" hidden>

										</div>
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-success" name="addschedule"> Approve </button>
										<button type="button" class="btn btn-btn" data-dismiss="modal">Cancel</button>
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
								<form action="clincludes/editAppointments.php" method="POST">
									<div class="modal-body">
										<div class="form-group">
											<input type="text" name="id" class="form-control" id="id" value="<?php echo $id ?>" hidden>

											<label> Name </label>
											<input type="text" name="name" class="form-control" value="<?php echo $row['users_name'] ?>" required>

											<br>
											<label> E-mail </label>
											<input type="text" name="email" class="form-control" value="<?php echo $row['users_email'] ?>" required>

											<br>
											<label> Contact Number </label>
											<input type="text" name="contact" class="form-control" value="<?php echo $row['users_contact'] ?>" required>

											<br>
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
											<label> Appointment Date: <?php echo $row['appt_date'] ?></label>
										</div>
									</div>
									<div class="modal-footer">
										<a type="button" class="btn btn-success" href="clincludes/delAppointment.php?Del=<?php echo $id ?> "> OK </a>
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

<script>
	function autocomplete(inp, arr) {
		/*the autocomplete function takes two arguments,
		the text field element and an array of possible autocompleted values:*/
		var currentFocus;
		/*execute a function when someone writes in the text field:*/
		inp.addEventListener("input", function(e) {
			var a, b, i, val = this.value;
			/*close any already open lists of autocompleted values*/
			closeAllLists();
			if (!val) {
				return false;
			}
			currentFocus = -1;
			/*create a DIV element that will contain the items (values):*/
			a = document.createElement("DIV");
			a.setAttribute("id", this.id + "autocomplete-list");
			a.setAttribute("class", "autocomplete-items");
			/*append the DIV element as a child of the autocomplete container:*/
			this.parentNode.appendChild(a);
			/*for each item in the array...*/
			for (i = 0; i < arr.length; i++) {
				/*check if the item starts with the same letters as the text field value:*/
				if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
					/*create a DIV element for each matching element:*/
					b = document.createElement("DIV");
					/*make the matching letters bold:*/
					b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
					b.innerHTML += arr[i].substr(val.length);
					/*insert a input field that will hold the current array item's value:*/
					b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
					/*execute a function when someone clicks on the item value (DIV element):*/
					b.addEventListener("click", function(e) {
						/*insert the value for the autocomplete text field:*/
						inp.value = this.getElementsByTagName("input")[0].value;
						/*close the list of autocompleted values,
						(or any other open lists of autocompleted values:*/
						closeAllLists();
					});
					a.appendChild(b);
				}
			}
		});
		/*execute a function presses a key on the keyboard:*/
		inp.addEventListener("keydown", function(e) {
			var x = document.getElementById(this.id + "autocomplete-list");
			if (x) x = x.getElementsByTagName("div");
			if (e.keyCode == 40) {
				/*If the arrow DOWN key is pressed,
				increase the currentFocus variable:*/
				currentFocus++;
				/*and and make the current item more visible:*/
				addActive(x);
			} else if (e.keyCode == 38) { //up
				/*If the arrow UP key is pressed,
				decrease the currentFocus variable:*/
				currentFocus--;
				/*and and make the current item more visible:*/
				addActive(x);
			} else if (e.keyCode == 13) {
				/*If the ENTER key is pressed, prevent the form from being submitted,*/
				e.preventDefault();
				if (currentFocus > -1) {
					/*and simulate a click on the "active" item:*/
					if (x) x[currentFocus].click();
				}
			}
		});

		function addActive(x) {
			/*a function to classify an item as "active":*/
			if (!x) return false;
			/*start by removing the "active" class on all items:*/
			removeActive(x);
			if (currentFocus >= x.length) currentFocus = 0;
			if (currentFocus < 0) currentFocus = (x.length - 1);
			/*add class "autocomplete-active":*/
			x[currentFocus].classList.add("autocomplete-active");
		}

		function removeActive(x) {
			/*a function to remove the "active" class from all autocomplete items:*/
			for (var i = 0; i < x.length; i++) {
				x[i].classList.remove("autocomplete-active");
			}
		}

		function closeAllLists(elmnt) {
			/*close all autocomplete lists in the document,
			except the one passed as an argument:*/
			var x = document.getElementsByClassName("autocomplete-items");
			for (var i = 0; i < x.length; i++) {
				if (elmnt != x[i] && elmnt != inp) {
					x[i].parentNode.removeChild(x[i]);
				}
			}
		}
		/*execute a function when someone clicks in the document:*/
		document.addEventListener("click", function(e) {
			closeAllLists(e.target);
		});
	}

	/*An array containing all the country names in the world:*/
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			// document.getElementById("txtHint").innerHTML=this.responseText;
			var names = this.responseText;
			var arrayNames = names.split('|');
			console.log(arrayNames.length);
			autocomplete(document.getElementById("name"), arrayNames);
		}
	}
	xmlhttp.open("GET", "clincludes/getUsers.php", true);
	xmlhttp.send();
</script>

<script>
	function showUserDetails() {
		// var str = String(val).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
		var str = $('#name').val();
		console.log(str);
		// if (str=="") 
		// {
		// 	return;
		// }
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var details = this.responseText;
				var arrayDetails = details.split('|');
				console.log(arrayDetails);
				document.getElementById('users_email').value = arrayDetails[0];
				document.getElementById('users_contact').value = arrayDetails[1];
			}
		}

		xmlhttp.open("GET", "clincludes/getUserDetails.php?q=" + str, true);
		xmlhttp.send();
	}
</script>


<script>
  var today = new Date();
	$('#datepickerapptreq').datetimepicker({
		sideBySide: true,
		format :"YYYY-MM-DD HH:mm:[00]",
    defaultDate: today,
	});
</script>