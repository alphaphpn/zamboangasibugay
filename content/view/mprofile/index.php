<?php
	include_once "../../content/theme/{$themename}/frontend-navbar.php";
	// include_once "../../content/theme/{$themename}/slick-home-banner.php";

	include_once "../../inc/core.php";
	include_once "../../inc/srvr.php";
	$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
	$cnn_profilez = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);

	$qry_profilez = "SELECT * FROM tbl_sysuser WHERE usercode=:profileidz LIMIT 1";
	$stmt_profilez = $cnn_profilez->prepare($qry_profilez);
	$profileidz = $_SESSION["usercode"];
	$stmt_profilez->bindParam(':profileidz', $profileidz);
	$stmt_profilez->execute();
	$row_profilez = $stmt_profilez->fetch(PDO::FETCH_ASSOC);

	$pimgurl = $row_profilez["img_url"];
	$pusercode = $row_profilez["usercode"];
	$pusername = $row_profilez["username"];
	$pfullname = $row_profilez["fullname"];
	$psurname = $row_profilez["lname"];
	$pfirstname = $row_profilez["fname"];
	$pmiddlename = $row_profilez["mname"];
	$pemail = $row_profilez["uemail"];
	$pimglnkurl = $row_profilez["img_url"];
	$paddress = $row_profilez["address"];

	$psecquest = $row_profilez["secquest"];
	$psecans = $row_profilez["secans"];

	$pmobilephone = $row_profilez["umobileno"];
	$pemployer = $row_profilez["cmpny"];
	$pjobposition = $row_profilez["cmpny_position"];

	$extname = $row_profilez['extname'];

	if ($pimglnkurl == "") {
		$profpicsurrer = "../../storage/img/no-image.jpg";
	} elseif ($extname == "") {
		$profpicsurrer = $pimglnkurl;
	} else {
		$profpicsurrer = "../../".$pimglnkurl;
	}
?>

<script>
	window.addEventListener('load', function() {
		document.querySelector('#profpic').addEventListener('change', function() {
			if (this.files && this.files[0]) {
				var img = document.querySelector('#imgogsrc3');
				img.onload = () => {
					URL.revokeObjectURL(img.src);  // no longer needed, free memory
				}
				img.src = URL.createObjectURL(this.files[0]); // set src to blob url

				var img2 = document.querySelector('#profvwimgfl3');
				img2.onload = () => {
					URL.revokeObjectURL(img2.src);  // no longer needed, free memory
				}
				img2.src = URL.createObjectURL(this.files[0]); // set src to blob url
			}
		});
	});
</script>

<div class="pt-5 pb-5 mt-5">
	<div class="container mt-3">
		<div class="row">
			<div class="col-sm-3">
				<ul class="nav flex-column">
					<li class="nav-item">
						<a class="nav-link text-body" href="#">Profile</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-body" href="#">Payment</a>
					</li>
					<li class="nav-item">
						<a class="nav-link disabled" href="#">Promissory</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-body" href="#">Notification</a>
					</li>
				</ul>
			</div>
			<div class="col-sm-9">
				<div class="card">
					<div class="card-header">
						<label>Profile</label>
						<div class="float-right">
							<a href="">Refresh</a>
						</div>
					</div>
					<div class="card-body">
						<p class="text-danger">(*) Required field</p>
						<form id="userprofilec" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<img id="imgogsrc3" class="img-thumbnail" src="<?php echo $profpicsurrer; ?>" data-toggle="modal" data-target="#ymModalItemPreview">
									</div>
								</div>
								<div class="col-md-9 mt-auto">
									<div class="form-group">
										<label for="profpic" style="width: -webkit-fill-available;">Profile Picture: <?php echo $profpicsurrer; ?></label>
										<div class="input-group mb-3">
											<input type="file" id="profpic" name="profpic" class="form-control" placeholder="Upload File" accept="image/*">
											<div class="valid-feedback">Valid.</div>
											<div class="invalid-feedback">Please fill out this field.</div>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="pusercode">* User ID:</label>
										<div class="input-group mb-3">
											<input type="text" class="form-control" id="pusercode" placeholder="User ID" name="pusercode" autofocus required readonly value="<?php echo $pusercode; ?>">
											<div class="valid-feedback">Valid.</div>
											<div class="invalid-feedback">Please fill out this field.</div>
										</div>
									</div>

									<div class="form-group">
										<label for="pusername">* Username:</label>
										<div class="input-group mb-3">
											<input type="text" class="form-control" id="pusername" placeholder="Username" name="pusername" autofocus required readonly value="<?php echo $pusername; ?>">
											<div class="valid-feedback">Valid.</div>
											<div class="invalid-feedback">Please fill out this field.</div>
										</div>
									</div>

									<div class="form-group">
										<label for="plname">* Last Name / Surname / Family Name:</label>
										<div class="input-group mb-3">
											<input type="text" class="form-control" id="plname" placeholder="Last Name / Surname / Family Name" name="plname" autofocus required value="<?php echo $psurname; ?>">
											<div class="valid-feedback">Valid.</div>
											<div class="invalid-feedback">Please fill out this field.</div>
										</div>
									</div>

									<div class="form-group">
										<label for="pfname">* First Name / Given Name:</label>
										<div class="input-group mb-3">
											<input type="text" class="form-control" id="pfname" placeholder="First Name / Given Name" name="pfname" autofocus required value="<?php echo $pfirstname; ?>">
											<div class="valid-feedback">Valid.</div>
											<div class="invalid-feedback">Please fill out this field.</div>
										</div>
									</div>

									<div class="form-group">
										<label for="pmname">Middle Name:</label>
										<div class="input-group mb-3">
											<input type="text" class="form-control" id="pmname" placeholder="Middle Name" name="pmname" value="<?php echo $pmiddlename; ?>">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="pemail">* E-mail:</label>
										<div class="input-group mb-3">
											<input type="text" class="form-control" id="pemail" placeholder="E-mail" name="pemail" autofocus required readonly disabled value="<?php echo $pemail; ?>">
											<div class="valid-feedback">Valid.</div>
											<div class="invalid-feedback">Please fill out this field.</div>
										</div>
									</div>

									<div class="form-group">
										<label for="pmobilephone">* Phone / Mobile:</label>
										<div class="input-group mb-3">
											<input type="text" class="form-control" id="pmobilephone" placeholder="Phone / Mobile" name="pmobilephone" value="<?php echo $pmobilephone; ?>" autofocus required>
											<div class="valid-feedback">Valid.</div>
											<div class="invalid-feedback">Please fill out this field.</div>
										</div>
									</div>

									<div class="form-group d-none">
										<label for="pemployer">Company / Employer:</label>
										<div class="input-group mb-3">
											<input type="text" class="form-control" id="pemployer" placeholder="Company / Employer" name="pemployer" value="<?php echo $pemployer; ?>" autofocus>
										</div>
									</div>

									<div class="form-group d-none">
										<label for="pjobposition">Job Title / Position:</label>
										<div class="input-group mb-3">
											<input type="text" class="form-control" id="pjobposition" placeholder="Job Title / Position" name="pjobposition" value="<?php echo $pjobposition; ?>" autofocus>
										</div>
									</div>

									<div class="form-group">
										<label for="pfullname">Fullname:</label>
										<div class="input-group mb-3">
											<input type="text" class="form-control" id="pfullname" placeholder="Fullname" name="pfullname" autofocus readonly disabled value="<?php echo $pfullname; ?>">
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="zaddress">* Address:</label>
								<div class="input-group mb-3">
									<textarea class="form-control" id="zaddress" placeholder="Address" name="zaddress" autofocus required><?php echo $paddress; ?></textarea>
									<div class="input-group-append">
										<button id="updaddress" class="btn btn-success" type="button" data-toggle="modal" data-target="#ymModalAddress">Update Address</button>
									</div>
									<div class="valid-feedback">Valid.</div>
									<div class="invalid-feedback">Please fill out this field.</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="psecquest">* Security Question</label>
										<div class="input-group mb-3">
											<input type="text" class="form-control" id="psecquest" placeholder="Security Question" name="psecquest" autofocus required value="<?php echo $psecquest; ?>" list="secquestList">
											<div class="valid-feedback">Valid.</div>
											<div class="invalid-feedback">Please fill out this field.</div>

											<datalist id="secquestList">
											<?php
												$stmtsecquest = $cnn->prepare("SELECT * FROM tbl_secquest GROUP BY secquest ORDER BY secquest ASC");
												$stmtsecquest->execute();
												$resultsecquest = $stmtsecquest->setFetchMode(PDO::FETCH_ASSOC);
												foreach ($stmtsecquest as $rowsecquest) {
													echo "<option value='".htmlspecialchars($rowsecquest['secquest'])."'>";
												}
											?>
											</datalist>
										</div>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label for="psecans">* Security Answer</label>
										<div class="input-group mb-3" id="show_hide_password3">
											<input type="password" class="form-control" id="psecans" placeholder="Security Answer" name="psecans" autofocus required value="<?php echo $psecans; ?>">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<i class="fa fa-eye-slash" aria-hidden="true" onclick="PwHideShow3()"></i>
												</span>
											</div>
											<div class="valid-feedback">Valid.</div>
											<div class="invalid-feedback">Please fill out this field.</div>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<?php include_once "update.php"; ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<a href="../chngepss/" class="btn btn-block btn-primary">
											Change Password <i class='fas fa-user-lock'></i>
										</a>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<button id="btnUpdateProfile" type="submit" class="btn btn-block btn-info" name="btnUpdateProfile">
											Update <i class='fas fa-user-edit'></i>
										</button>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="card-footer">
						<div class="row">
							<div class="col-sm-6 mb-2"></div>
							<div class="col-sm-6 mb-2 text-right">
								<a href="../../" class="text-dark text-decoration-none">
									<i>&#8592;</i> Go to Homepage
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal" id="ymModalItemPreview">
	<div class="modal-dialog">
		<div class="modal-content">
			<button type="button" class="close text-right mr-1" data-dismiss="modal">&times;</button>
			<div class="modal-body">
				<img id="profvwimgfl3" src="<?php echo $pimglnkurl; ?>">
			</div>
		</div>
	</div>
</div>/

<?php
	include_once "../../inc/address/index.php";

	if ( empty($geomap) ) {
		echo "<p align='center'>Can't Load Map.</p>";
	} else {
		echo '<iframe class="responsive-iframe" src="https://maps.google.com/maps?q='.$geomap.'&t=&z=15&ie=UTF8&iwloc=&output=embed" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>';
	}
?>