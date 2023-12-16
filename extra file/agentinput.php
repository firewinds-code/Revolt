<?php include 'include/header.php' ?>

<?php
if (!isset($_SESSION['IntUserId']) || $_SESSION['IntUserId'] == '') {
	session_destroy();
	header("location:login.php");
}
$myDB = new MysqliDb();

?>
<style>
	.error {
		color: red;
	}

	#data-container {
		display: block;
		background: #2a3f54;

		max-height: 250px;
		overflow-y: auto;
		z-index: 9999999;
		position: absolute;
		width: 100%;

	}

	#data-container li {
		list-style: none;
		padding: 5px;
		border-bottom: 1px solid #fff;
		color: #fff;
	}

	#data-container li:hover {
		background: #26b99a;
		cursor: pointer;
	}

	.form-control:focus {
		border-color: #d01010;
		outline: 0;
		box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(233, 102, 139, 0.6);

	}

	#overlay {
		position: fixed;
		top: 0;
		z-index: 100;
		width: 100%;
		height: 100%;
		display: none;
		background: rgba(0, 0, 0, 0.6);
	}

	.cv-spinner {
		height: 100%;
		display: flex;
		justify-content: center;
		align-items: center;
	}

	.spinner {
		width: 40px;
		height: 40px;
		border: 4px #ddd solid;
		border-top: 4px #2e93e6 solid;
		border-radius: 50%;
		animation: sp-anime 0.8s infinite linear;
	}

	@keyframes sp-anime {
		100% {
			transform: rotate(360deg);
		}
	}

	.is-hide {
		display: none;
	}
</style>

<?php
if (isset($_POST['submit']) && $_SESSION['IntUserId'] != '') {
	//echo "<pre>";
	//print_r($_POST);

	if (!$_SESSION['IntUserId'] || $_SESSION['IntUserId'] == '') {
		session_destroy();
		header("location:login.php");
	}
	//$query = "call insertdata_new('" . $_POST['mobile_number'] . "','" . $_POST['email_id'] . "','" . $_POST['customer_name'] . "','" . $_SESSION['IntUserId'] . "','" . $_POST['interaction_type'] . "','" . $_POST['brand'] . "','" . $_POST['product_type'] . "','" . $_POST['contact_reason'] . "','" . $_POST['contact_reason_type'] . "','" . $call_id . "','" . $_POST['serial_number'] . "','" . $_POST['model_no'] . "','" . date('Y-m-d', strtotime($_POST['purchase_date'])) . "','" . $_POST['warranty_status'] . "','" . $_POST['purchase_source'] . "','" . $_POST['call_status'] . "','" . $_POST['remark'] . "')";
	$insert['agent_id'] = $_SESSION['IntUserId'];
	if (isset($_POST['call_status']) && $_POST['call_status'] != '') {
		$insert['call_status'] = $_POST['call_status'];
	}
	if (isset($_POST['dealership_location']) && $_POST['dealership_location'] != '') {
		$insert['dealership_location'] = $_POST['dealership_location'];
	}
	if (isset($_POST['dealership']) && $_POST['dealership'] != '') {
		$insert['dealership'] = $_POST['dealership'];
	}
	if (isset($_POST['pincode']) && $_POST['pincode'] != '') {
		$insert['pincode'] = $_POST['pincode'];
	}
	if (isset($_POST['city']) && $_POST['city'] != '') {
		$insert['city'] = $_POST['city'];
	}
	if (isset($_POST['customer_name']) && $_POST['customer_name'] != '') {
		$insert['customer_name'] = $_POST['customer_name'];
	}
	if (isset($_POST['email_id']) && $_POST['email_id'] != '') {
		$insert['email_id'] = $_POST['email_id'];
	}
	if (isset($_POST['mobile_number']) && $_POST['mobile_number'] != '') {
		$insert['mobile_number'] = $_POST['mobile_number'];
	}
	if (isset($_POST['final_call_status']) && $_POST['final_call_status'] != '') {
		$insert['final_call_status'] = $_POST['final_call_status'];
	}
	if (isset($_POST['call_status_sub_sub_type']) && $_POST['call_status_sub_sub_type'] != '') {
		$insert['call_status_sub_sub_type'] = $_POST['call_status_sub_sub_type'];
	}
	if (isset($_POST['call_status_sub_type']) && $_POST['call_status_sub_type'] != '') {
		$insert['call_status_sub_type'] = $_POST['call_status_sub_type'];
	}
	if (isset($_POST['warranty_status']) && $_POST['warranty_status'] != '') {
		$insert['warranty_status'] = $_POST['warranty_status'];
	}
	if (isset($_POST['purchase_date']) && $_POST['purchase_date'] != '') {
		$insert['purchase_date'] = $_POST['purchase_date'];
	}
	if (isset($_POST['booking_id']) && $_POST['booking_id'] != '') {
		$insert['booking_id'] = $_POST['booking_id'];
	}
	if (isset($_POST['chasis_number']) && $_POST['chasis_number'] != '') {
		$insert['chasis_number'] = $_POST['chasis_number'];
	}
	if (isset($_POST['contact_reason_sub_sub_type']) && $_POST['contact_reason_sub_sub_type'] != '') {
		$insert['contact_reason_sub_sub_type'] = $_POST['contact_reason_sub_sub_type'];
	}
	if (isset($_POST['contact_reason_type']) && $_POST['contact_reason_type'] != '') {
		$insert['contact_reason_type'] = $_POST['contact_reason_type'];
	}
	if (isset($_POST['contact_reason']) && $_POST['contact_reason'] != '') {
		$insert['contact_reason'] = $_POST['contact_reason'];
	}
	if (isset($_POST['product_type']) && $_POST['product_type'] != '') {
		$insert['product_type'] = $_POST['product_type'];
	}
	if (isset($_POST['remark']) && $_POST['remark'] != '') {
		$insert['remark'] = $_POST['remark'];
	}
	if (isset($_POST['ResolutionProvided']) && $_POST['ResolutionProvided'] != '') {
		$insert['ResolutionProvided'] = $_POST['ResolutionProvided'];
	}
	if (isset($_POST['interaction_type']) && $_POST['interaction_type'] != '') {
		$insert['interaction_type'] = $_POST['interaction_type'];
	}
	if (isset($_POST['issue']) && $_POST['issue'] != '') {
		$insert['product_issue'] = $_POST['issue'];
	}
	if (isset($_POST['ticket_no']) && $_POST['ticket_no'] != '') {
		$insert['ticket_no'] = $_POST['ticket_no'];
	} else {
		$c1 = $_POST['mobile_number']; ////mobile
		$c2 = $_POST['contact_reason_type']; ////content reason sub type
		$c3 = $_POST['contact_reason_sub_sub_type'];   ////content reason sub sub type

		// $ow = select * from table_name where  c1=1 and c2=1 and c3=1

		$ow = "select * from client_data_new where  mobile_number='" . $c1 . "' and contact_reason_type='" . $c2 . "' and contact_reason_sub_sub_type='" . $c3 . "'";
		$myDB = new MysqliDb();
		$val = $myDB->query($ow);

		// print_r($val);
		// echo ($val[0]['ticket_no']);
		// exit;

		if (count($val) > 0) {
			// $ticketno = "oldticketno";
			$insert['ticket_no'] = $val[0]['ticket_no'];
		} else {

			$Query = "select max(ticket_id) as ticket_id from client_data_new";
			$myDB = new MysqliDb();
			$result = $myDB->query($Query);

			if ($result[0]['ticket_id'] != "" || $result[0]['ticket_id'] != null) {
				$last = $result[0]['ticket_id'] + 1;
				if ($c2 == "General Enquiry") {
					// $ticketno = newicketno generat with EQ
					$insert['ticket_no'] = 'RV' . date('m') . date('y') . $last;
					$insert['ticket_id'] = $last;
				} else {
					// $ticketno = newicketno generat with RV
					$insert['ticket_no'] = 'RV' . date('m') . date('y') . $last;
					$insert['ticket_id'] = $last;
				}
			} else {
				$insert['ticket_no'] = "RV" . date('m') . date('y') . "1";
				$insert['ticket_id'] = "1";
			}

			// if(c2="General Enquiry"){
			// 	$ticketno = newicketno generat with EQ
			// }else{
			// 	$ticketno = newicketno generat with RV
			// }

		}

		/*
		$Query = "select max(ticket_id) as ticket_id from revolt.client_data_new";
		$myDB = new MysqliDb();
		$result = $myDB->query($Query);
		//echo $result[0]['ticket_id'];
		//echo "</br>";
		if ($result[0]['ticket_id'] != "" || $result[0]['ticket_id'] != null) {
			$last = $result[0]['ticket_id'] + 1;
			//echo 'RV' . date('m') . date('y') . $last;
			//echo "</br>";
			$insert['ticket_no'] = 'RV' . date('m') . date('y') . $last;
			$insert['ticket_id'] = $last;
			//echo "</br>";
		} else {
			$insert['ticket_no'] = "RV" . date('m') . date('y') . "1";
			$insert['ticket_id'] = "1";
			//echo "</br>";
		}
		*/
	}

	//$queryInsert = "INSERT INTO agent_cti (" . implode(",", $keys) . ") VALUES (" . implode(",", $values) . ");";
	//$myDB = new MysqliDb();
	//$result = $myDB->query($queryInsert);

	$insert_history = "INSERT INTO input_history (ticket_no, agent_id, remark, ResolutionProvided,final_call_status,call_status)
	VALUES ('" . $insert['ticket_no'] . "', '" . $insert['agent_id'] . "','" . addslashes($insert['remark']) . "','" . addslashes($insert['ResolutionProvided']) . "','" . $insert['final_call_status'] . "','" . $insert['call_status'] . "')";

	$myDB->query($insert_history);

	$InsertedId = $myDB->insert('client_data_new', $insert);



	echo "<script>
					setTimeout(function(){ $('#msg').show();
						 }, 500);
					setTimeout(function(){ window.location.href= 'agentinput.php?ticket_no=" . $insert['ticket_no'] . "';}, 2000);
			</script>";
}
?>

<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<?php include 'include/leftmenu.php' ?>

			<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="clearfix"></div>

					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel">
								<div class="x_title">
									<h4> Agent Input</h4>
									<div class="clearfix"></div>
								</div>

								<div class="x_content">


									<div class="alert alert-success" id="Umsg" style="display:none">Data Update Successfully </div>
									<div class="alert alert-success" id="msg" style="display:none">Data Insert Successfully </div>
									<form id="searchform" data-parsley-validate class="form-horizontal " method="POST" action="" enctype="multipart/form-data" name="searchform">


										<div class="row">

											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">


													<input type="text" id="search_text" placeholder="Enter Mobile,Ticket Number for search from Mobile Number,Ticket Number" name="search_text" required class="form-control">

												</div>
											</div>

											<div class="col-md-4 col-sm-4 col-xs-12">
												<div class="form-group">
													<button type="button" name='UploadData' class="btn btn-success getdata"> <i class="fa fa-search"></i> Search</button>
												</div>
											</div>
										</div>

									</form>
									<div id="dtable1"></div>
									<hr>

									<div class="row " align="center" style="margin-bottom: 25px;">
										<div class="col-md-12 col-sm-12 col-xs-12 my-4">
											<button type="button" name='new_ticket' class="btn btn-success" id="new_ticket">New Ticket</button>

										</div>
									</div>
									<form id="firstform" data-parsley-validate class="form-horizontal " method="POST" action="agentinput.php" enctype="multipart/form-data" name="firstform" style="display: none;">

										<div class="form-group">
											<div class="row">
												<div class="col-md-3 col-sm-4 col-xs-12">
													<div class="form-group">
														<label>Ticket Number</label>
														<input type="text" id="ticket_no" readonly name="ticket_no" class="form-control ">
													</div>
												</div>
												<div class="col-md-3 col-sm-4 col-xs-12">
													<div class="form-group">
														<label>Customer Name</label>
														<input type="text" id="customer_name" placeholder="Enter Customer Name" name="customer_name" class="form-control ">
													</div>
												</div>
												<div class="col-md-3 col-sm-4 col-xs-12">
													<div class="form-group">
														<label>Mobile number</label>
														<input type="text" id="mobile_number" placeholder="Enter Mobile Number" name="mobile_number" class="form-control ">
													</div>
												</div>
												<div class="col-md-3 col-sm-4 col-xs-12">
													<div class="form-group">
														<label>Email ID</label>
														<input type="text" id="email_id" placeholder="Enter Email ID" name="email_id" class="form-control ">
													</div>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12">
												<div class="form-group">
													<label>Interaction Type</label>
													<?php
													$getinteraction_typeQuery = "SELECT interaction_type FROM interaction_type";
													$getinteraction_type = $myDB->query($getinteraction_typeQuery);
													?>
													<select class="form-control" name="interaction_type" id="interaction_type">
														<option value=""> Select Intraction Type</option>
														<!--<option value="Inbound"> Inbound</option>
														<option value="Email"> Email</option>
														<option value="Outcall Email"> Outcall Email</option>
														<option value="WhatsApp"> WhatsApp</option>
														<option value="WhatsApp Outcall Request">What'sapp Outcall Request</option>
														<option value="Outcall on Escalation"> Outcall on Escalation</option>
														<option value="Outcall on Escalation follow-up">Outcall on Escalation follow-up</option>
														<option value="Outcall on Abandoned">Outcall on Abandoned</option>
														<option value="Outcall on Disconnected">Outcall on Disconnected</option>
														<option value="Social Media">Social Media</option>
														<option value="National Consumer Helpline">National Consumer Helpline</option>--->
														<?php foreach ($getinteraction_type as $gvalue) { ?>
															<option value="<?php echo $gvalue['interaction_type'] ?>"> <?php echo $gvalue['interaction_type'] ?></option>
														<?php } ?>


													</select>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12">
												<div class="form-group">
													<label>Product Type</label>
													<select class="form-control" name="product_type" id="product_type">
														<option value=""> Select Product Type</option>
														<option value="300"> 300</option>
														<option value="400"> 400</option>
														<option value="Others"> Others</option>

													</select>
												</div>
											</div>


											<div class="col-md-4 col-sm-4 col-xs-12">
												<div class="form-group">
													<label>Contact Reason</label>
													<?php
													$getDocumentQuery = "SELECT distinct(contact_reason) FROM contact_reason";
													$getDocument = $myDB->query($getDocumentQuery);
													?>
													<select class="form-control" name="contact_reason" id="contact_reason" required>
														<option value=""> Select Contact Reason</option>
														<?php foreach ($getDocument as $gvalue) { ?>
															<option value="<?php echo $gvalue['contact_reason'] ?>"> <?php echo $gvalue['contact_reason'] ?></option>
														<?php } ?>

													</select>
												</div>
											</div>

											<div class="col-md-4 col-sm-4 col-xs-12">
												<div class="form-group">
													<label>Contact Reason Sub type</label>
													<select class="form-control" name="contact_reason_type" id="contact_reason_type" required>
														<option value=""> Select Contact Reason Type</option>


													</select>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12">
												<div class="form-group">
													<label>Contact Reason Sub Sub type</label>
													<select class="form-control" name="contact_reason_sub_sub_type" id="contact_reason_sub_sub_type" required>
														<option value=""> Select Contact Reason Type</option>


													</select>
												</div>
											</div>

											<div class="col-md-4 col-sm-4 col-xs-12" style="display: none;" id="issue_div">
												<div class="form-group">
													<label>Select issue</label>
													<select class="form-control" name="issue" id="issue">
														<option value=""> Select Product issue</option>
														<option value="Battery Issue"> Battery Issue</option>
														<option value="Remote issue"> Remote issue</option>
														<option value="Belt Broken"> Belt Broken</option>
														<option value="Spare Parts not available"> Spare Parts not available</option>
														<option value="Bike not Starting"> Bike not Starting</option>
														<option value="App Issues"> App Issues</option>
														<option value="Dealership not responding"> Dealership not responding</option>
														<option value="Sound Box Issues"> Sound Box Issues</option>
														<option value="Range Issues"> Range Issues</option>
														<option value="GPS Issue"> GPS Issue</option>
														<option value="Bike stopped while driving"> Bike stopped while driving</option>
														<option value="Motor Issues"> Motor Issues</option>
														<option value="Error 96 Displaying"> Error 96 Displaying</option>
														<option value="Accelerator not working"> Accelerator not working</option>
														<option value="Handle Damage"> Handle Damage</option>
														<option value="Charging Issues"> Charging Issues</option>
														<option value="Immobilizer issue"> Immobilizer issue</option>
														<option value="Horn Not Working"> Horn Not Working</option>
														<option value="Indicator not working"> Indicator not working</option>
														<option value="Brake Sensor issue"> Brake Sensor issue</option>
														<option value="Charger issue"> Charger issue</option>
														<option value="Others"> Others</option>

													</select>
												</div>
											</div>

											<div class="col-md-4 col-sm-4 col-xs-12">
												<div class="form-group">
													<label>Booking ID</label>
													<input type="text" id="booking_id" placeholder="Enter Booking ID" name="booking_id" class="form-control ">
												</div>
											</div>

											<div class="col-md-4 col-sm-4 col-xs-12">
												<div class="form-group">
													<label>Chasis Number</label>
													<input type="text" id="chasis_number" placeholder="Enter Chasis Number" name="chasis_number" class="form-control ">
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12">
												<div class="form-group">
													<label>City</label>
													<?php
													$getDocumentQuery = "SELECT distinct(city) FROM city_master";
													$getDocument = $myDB->query($getDocumentQuery);
													?>
													<select class="form-control" name="city" id="city">
														<option value=""> Select city</option>
														<?php foreach ($getDocument as $gvalue) { ?>
															<option value="<?php echo $gvalue['city'] ?>"> <?php echo $gvalue['city'] ?></option>
														<?php } ?>

													</select>
												</div>
											</div>

											<div class="col-md-4 col-sm-4 col-xs-12">
												<div class="form-group">
													<label>Pincode</label>
													<select class="form-control" name="pincode" id="pincode">
														<option value=""> Select pincode</option>


													</select>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12">
												<div class="form-group">
													<label>Purchase Date</label>
													<div class='input-group date' id='myDatepicker1'>
														<input type='text' class="form-control" name="purchase_date" id="purchase_date" required placeholder="Select From Date" />
														<span class="input-group-addon">
															<span class="glyphicon glyphicon-calendar"></span>
														</span>
													</div>
												</div>
											</div>

										</div>
										<div class="row">


											<div class="col-md-4 col-sm-4 col-xs-12">
												<div class="form-group">
													<label>Warranty Status</label>
													<select class="form-control" name="warranty_status" id="warranty_status">
														<option value=""> Select Warranty Status</option>
														<option value="In-warranty (less than 5 yrs.)"> In-warranty (less than 5 yrs.)</option>
														<option value="Out of Warranty (Accidental Insurance)"> Out of Warranty (Accidental Insurance)</option>

													</select>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12">
												<div class="form-group">
													<label>Dealership</label>
													<?php
													$getDocumentQuery = "SELECT distinct(dealership) FROM dealership";
													$getDocument = $myDB->query($getDocumentQuery);
													?>
													<select class="form-control" name="dealership" id="dealership">
														<option value=""> Select Dealership</option>
														<?php foreach ($getDocument as $gvalue) { ?>
															<option value="<?php echo $gvalue['dealership'] ?>"> <?php echo $gvalue['dealership'] ?></option>
														<?php } ?>

													</select>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12">
												<div class="form-group">
													<label>Dealership Location</label>
													<select class="form-control" name="dealership_location" id="dealership_location">
														<option value=""> Select dealership location</option>


													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-3 col-sm-3 col-xs-12">
												<div class="form-group">
													<label>Call Status</label>
													<select class="form-control" name="call_status" id="call_status">
														<option value=""> Select Call Status</option>
														<option value="Resolved"> Resolved</option>
														<option value="Follow-up"> Follow-up </option>
														<option value="Escalation"> Escalation</option>
													</select>
												</div>
											</div>
											<div class="col-md-3 col-sm-3 col-xs-12">
												<div class="form-group">
													<label>Priority</label>
													<select class="form-control" name="call_status_sub_type" id="call_status_sub_type">
														<option value="NA"> Select Call Status</option>
													</select>
												</div>
											</div>
											<div class="col-md-3 col-sm-3 col-xs-12">
												<div class="form-group">
													<label>Call Status Sub Sub type</label>
													<select class="form-control" name="call_status_sub_sub_type" id="call_status_sub_sub_type">
														<option value="NA"> Select Call Status</option>
													</select>
												</div>
											</div>
											<div class="col-md-3 col-sm-3 col-xs-12">
												<div class="form-group">
													<label>Final Call Status</label>
													<select class="form-control" name="final_call_status" id="final_call_status">
														<option value="NA"> NA</option>
														<option value="Closed"> Closed</option>
													</select>
												</div>
											</div>

										</div>
										<div class="row">

											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label>Customer Remarks</label>
													<textarea id="message" required="required" class="form-control" name="remark" id="remar1k"></textarea>
												</div>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label>Resolution Provided</label>
													<textarea id="ResolutionProvided" required="required" class="form-control" name="ResolutionProvided" id="ResolutionProvided"></textarea>
												</div>
											</div>
										</div>
										<div class="row" align="center">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<button type="submit" name='submit' class="btn btn-success" id="submit">Submit</button>
												<!--<button type="submit" name='update' class="btn btn-success" id="update">Update</button>-->
											</div>

										</div>

								</div>
								</form>
								<hr>
								<div id="remark"></div>
								<hr>
								<div id="dtable2" style="display: none;">

								</div>
								<div id="dtable_old" style="display: none;">

								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>

	<?php include 'include/footer.php' ?>
	<script>
		// Wait for the DOM to be ready
		function getContact(contactvalue, contactreasontype) {

			$.ajax({
				url: 'get_subtype.php',
				type: 'GET',
				data: {
					contact_reason: contactvalue
				},
				dataType: 'json',
				success: function(response) {
					//alert(response);
					$("#contact_reason_type").html(response);
					if (contactreasontype != '') {
						$("form[name='firstform']").find("select[name='contact_reason_type']:first").val(contactreasontype);
					}
				}
			});
		}


		$(document).ready(function() {
			// Initialize form validation on the registration form.
			// It has the name attribute "registration"
			$("form[name='firstform']").validate({
				// Specify validation rules
				rules: {
					email_id: {
						required: true,
						email: true
					},
					call_status: {
						required: true,

					},
					booking_id: {
						required: true,
					},
					mobile_number: {
						required: true,
						number: true,
						minlength: 10,
						maxlength: 10

					},
					issue: {
						required: true,
					},

				},
				// Specify validation error messages
				messages: {
					mobile_number: {
						required: "Please Enter Mobile Number",
						minlength: "Mobile must be at least 10 digit long",
						maxlength: "Mobile number no more 10 digit",
						number: "Mobile number must be only number"
					},
					email_id: "Please enter a valid email address",
					call_status: "Please Select Call status",
				},
				// Make sure the form is submitted to the destination defined
				// in the "action" attribute of the form when valid
				submitHandler: function(form) {
					form.submit();
				}
			});
		});
	</script>
	<script>
		$(document).ready(function() {
			//$("#update").hide(300);
			//$("#submit").hide(300);

			$(".getdata").click(function() {
				$("#dtable1").html('');
				$('#firstform').hide();
				$('#dtable2').hide();
				$('#dtable_old').hide();
				$("#ticket_no").val();
				$('#firstform')[0].reset();
				var search_text = $("#search_text").val();
				if (search_text == '') {
					alert("Please enter mobile number");
					return false;
				}
				$("#overlay").fadeIn(300)
				$.ajax({
					type: 'GET',

					dataType: 'json',
					url: 'search_new.php',
					data: {
						search_text: search_text,
						type: 'product'
					},
					success: function(json) {
						if (json.status == true) {
							//alert("User Delete Successfully");
							$("#dtable1").html(json.dtable);

						} else {
							alert("Oops! No data Found");
						}
					}
				}).done(function() {
					setTimeout(function() {
						$("#overlay").fadeOut(300);

						$('#example').dataTable({
							dom: 'Bfrtip',
							buttons: [
								'excelHtml5',
							],
							scrollX: 300,
							responsive: true,
						});

					}, 500);
				});
			});
			$("#msg").hide();
			$("#Umsg").hide();

		});
	</script>

	<div id="overlay">
		<div class="cv-spinner">
			<span class="spinner"></span>
		</div>
	</div>

	<script>
		//fetch search datatable data 
		function getFormData(id, ticket_no) {
			// alert(ticket_no);


			$.ajax({
				type: "GET",
				dataType: "json",
				url: "search_form_data.php",
				data: {
					id: id,
					ticket_no: ticket_no,
					// type: "product",
				},
				success: function(json) {
					// console.log(json);
					console.log(json.client_data);
					if (json.status == true) {
						$('#firstform').show();

						$("#city").select2({
							placeholder: "Select a city",
							allowClear: true
						});
						$("#pincode").select2({
							placeholder: "Select a Pincode",
							allowClear: true
						});

						$("#ticket_no").val(json.client_data.ticket_no);
						$("#customer_name").val(json.client_data.customer_name);
						$("#mobile_number").val(json.client_data.mobile_number);
						$("#email_id").val(json.client_data.email_id);
						$("#interaction_type").val(json.client_data.interaction_type);
						$("#product_type").val(json.client_data.product_type);
						$("#contact_reason").val(json.client_data.contact_reason);
						$.ajax({
							url: 'et_bind.php',
							type: 'GET',
							data: {
								contact_reason: json.client_data.contact_reason,
								type: 'subtype'
							},
							dataType: 'json',
							success: function(response) {
								//alert(response);
								$("#contact_reason_type").html(response);
								$("#contact_reason_type").val(
									json.client_data.contact_reason_type
								);
								$.ajax({
									url: 'et_bind.php',
									type: 'GET',
									data: {
										type: 'subsubtype',
										contact_reason: json.client_data.contact_reason,
										contact_reason_type: json.client_data.contact_reason_type
									},
									dataType: 'json',
									success: function(response1) {
										$("#contact_reason_sub_sub_type").html(response1);
										$("#contact_reason_sub_sub_type").val(
											json.client_data.contact_reason_sub_sub_type
										);
									}
								});
							}
						});

						$("#chasis_number").val(json.client_data.chasis_number);
						$("#city").val(json.client_data.city);
						$("#pincode").val(json.client_data.pincode);
						$("#purchase_date").val(json.client_data.purchase_date);
						$("#warranty_status").val(json.client_data.warranty_status);
						$("#dealership").val(json.client_data.dealership);
						$("#booking_id").val(json.client_data.booking_id);
						alert(json.client_data.product_issue)
						if (json.client_data.product_issue) {
							$('#issue_div').show();
							$("#issue").val(json.client_data.product_issue);
						} else {
							$('#issue_div').hide();
						}
						$.ajax({
							url: 'et_bind.php',
							type: 'GET',
							data: {
								type: 'dealership',
								dealership: json.client_data.dealership,
							},
							dataType: 'json',
							success: function(response) {
								// console.log(response)
								$("#dealership_location").html(response);
								$("#dealership_location").val(json.client_data.dealership_location);
							}
						});

						$("#call_status").val(json.client_data.call_status);
						if (json.client_data.call_status == "Follow-up") {
							//alert("1");
							$('#call_status_sub_type').empty().append('<option value="NA"> NA</option><option value="High Priority">High Priority</option><option value="Low Priority">Low Priority</option>');
						}
						if (json.client_data.call_status == "Escalation") {
							//alert("2");
							$('#call_status_sub_type').empty().append('<option value="NA"> NA</option><option value="High">High</option><option value="Low">Low</option><option value="Medium">Medium</option>');

						}
						if (json.client_data.call_status == "Resolved") {
							//alert("3");
							$('#call_status_sub_type').empty().append('<option value="NA"> NA</option>');

						}
						$("#call_status_sub_type").val(json.client_data.call_status_sub_type);
						if (json.client_data.call_status_sub_type == "High Priority") {
							//alert("1");
							$('#call_status_sub_sub_type').empty().append('<option value="NA"> NA</option><option value="Dealer">Dealer</option><option value="Revolt Hub Sales">Revolt Hub Sales</option><option value=" Revolt Hub Finance"> Revolt Hub Finance</option><option value="Call Centre">Call Centre</option> <option value="Revolt CRM">Revolt CRM</option>');
						}
						if (json.client_data.call_status_sub_type == "Low Priority") {
							//alert("2");
							$('#call_status_sub_sub_type').empty().append('<option value="NA"> NA</option><option value="Revolt Hub Sales">Revolt Hub Sales</option><option value=" Revolt Hub Finance"> Revolt Hub Finance</option><option value="Call Centre">Call Centre</option><option value="Revolt CRM">Revolt CRM</option>');

						}
						if (json.client_data.call_status_sub_type == "High" || json.client_data.call_status_sub_type == "Low" || json.client_data.call_status_sub_type == "Medium" || json.client_data.call_status_sub_type == "NA") {
							//alert("3");
							$('#call_status_sub_sub_type').empty().append('<option value="NA"> NA</option>');

						}
						$("#call_status_sub_sub_type").val(
							json.client_data.call_status_sub_sub_type
						);
						$("#final_call_status").val(json.client_data.final_call_status);

						$('#dtable2').show();
						$("#dtable2").html(json.history_tbl);
						$('#dtable_old').show();
						$("#dtable_old").html(json.history_tbl_old);
					}
				},
			});
		}
	</script>


	<script>
		//bring option on change
		$(document).ready(function() {

			$("#city").change(function() {
				var city = $(this).val();
				// /alert(contact_reason);
				//return false;
				$.ajax({
					url: 'et_bind.php',
					type: 'GET',
					data: {
						city: city,
						type: 'city'
					},
					dataType: 'json',
					success: function(response) {
						//alert(response);
						$("#pincode").html(response);
					}
				});
			});
			$("#contact_reason").change(function() {
				var contact_reason = $(this).val();
				// /alert(contact_reason);
				//return false;
				$.ajax({
					url: 'et_bind.php',
					type: 'GET',
					data: {
						contact_reason: contact_reason,
						type: 'subtype'
					},
					dataType: 'json',
					success: function(response) {
						//alert(response);
						$("#contact_reason_type").html(response);
						$("#contact_reason_sub_sub_type").val('');
					}
				});
			});


			$("#contact_reason_type").change(function() {
				var contact_reason = $("#contact_reason").val();
				var contact_reason_type = $("#contact_reason_type").val();
				//var sub_type_id = $(this).val();
				$.ajax({
					url: 'et_bind.php',
					type: 'GET',
					data: {
						type: 'subsubtype',
						contact_reason: contact_reason,
						contact_reason_type: contact_reason_type
					},
					dataType: 'json',
					success: function(response) {
						$("#contact_reason_sub_sub_type").html(response);
					}
				});
			});
			$("#dealership").change(function() {
				var dealership = $("#dealership").val();
				//var sub_type_id = $(this).val();
				$.ajax({
					url: 'et_bind.php',
					type: 'GET',
					data: {
						type: 'dealership',
						dealership: dealership,
					},
					dataType: 'json',
					success: function(response) {
						$("#dealership_location").html(response);
					}
				});
			});
			$("#call_status").change(function() {
				var call_status = $("#call_status").val();

				//var sub_type_id = $(this).val();
				if (this.value == "Follow-up") {
					//alert("1");
					$('#call_status_sub_type').empty().append('<option value="NA"> NA</option><option value="High Priority">High Priority</option><option value="Low Priority">Low Priority</option>');
				}
				if (this.value == "Escalation") {
					//alert("2");
					$('#call_status_sub_type').empty().append('<option value="NA"> NA</option><option value="High">High</option><option value="Low">Low</option><option value="Medium">Medium</option>');

				}
				if (this.value == "Resolved") {
					//alert("3");
					$('#call_status_sub_type').empty().append('<option value="NA"> NA</option>');

				}
			});
			$("#call_status_sub_type").change(function() {
				var call_status_sub_type = $("#call_status_sub_type").val();

				//var sub_type_id = $(this).val();
				if (this.value == "High Priority") {
					//alert("1");
					$('#call_status_sub_sub_type').empty().append('<option value="NA"> NA</option><option value="Dealer">Dealer</option><option value="Revolt Hub Sales">Revolt Hub Sales</option><option value=" Revolt Hub Finance"> Revolt Hub Finance</option><option value="Call Centre">Call Centre</option> <option value="Revolt CRM">Revolt CRM</option>');
				}
				if (this.value == "Low Priority") {
					//alert("2");
					$('#call_status_sub_sub_type').empty().append('<option value="NA"> NA</option><option value="Revolt Hub Sales">Revolt Hub Sales</option><option value=" Revolt Hub Finance"> Revolt Hub Finance</option><option value="Call Centre">Call Centre</option><option value="Revolt CRM">Revolt CRM</option>');

				}
				if (this.value == "High" || this.value == "Low" || this.value == "Medium" || this.value == "NA") {
					//alert("3");
					$('#call_status_sub_sub_type').empty().append('<option value="NA"> NA</option>');

				}
			});
		});
	</script>
	<script>
		$('#myDatepicker1').datetimepicker({
			format: 'YYYY-MM-DD'
		});
	</script>

	<script>
		//newticket click
		$("#new_ticket").click(function() {
			$('#firstform').show();
			$('#firstform').trigger("reset");
			$('#dtable2').hide();
			$('#dtable_old').hide();
		});
	</script>


	<script>
		//bring option on change
		$("#contact_reason_sub_sub_type").change(function() {
			var sub_sub = $("#contact_reason_sub_sub_type").val();
			$('#issue_div').hide();
			if (sub_sub == "Service Quality" || sub_sub == "Spare Part Availability") {
				$('#issue_div').show();
			}
		});
	</script>


	<!-- modal for ticket -->

	<button type="button" class="btn btn-primary" style="display:none" data-toggle="modal" data-target=".bs-example-modal-sm" id="ModelId">Small modal</button>

	<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title" id="myModalLabel2"></h4>
				</div>
				<div class="modal-body">
					<h4 id="tno"></h4>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				</div>

			</div>
		</div>
	</div>
	<?php

	if (isset($_REQUEST['ticket_no']) && $_REQUEST['ticket_no'] != "") { ?>

		<script>
			$('#tno').html("");
			$('#tno').html("Ticket Number is : <?php echo $_REQUEST['ticket_no'] ?>");
			$('#ModelId').click();
		</script>
	<?php } ?>

	<?php include 'form_data.js' ?>