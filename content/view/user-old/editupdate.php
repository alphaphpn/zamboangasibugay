<?php
	include_once "../../../content/template-part/{$themename}/dashboard-navbar.php";
	include_once "../../../content/template-part/{$themename}/dashboard-navbar-top.php";
	include_once "../../../inc/core.php";
	include_once "../../../inc/srvr.php";
	include_once "../../../inc/cnndb.php";

	$idedit = $_GET['id'];

	// search for duplicate
	$etblname = "tbl_sysuser";
	$edispid = "usercode";
	$qry_edit = "SELECT * FROM {$etblname} WHERE {$edispid}=:idedit LIMIT 1";
	$stmt_edit = $cnn->prepare($qry_edit);
	$stmt_edit->bindParam(':idedit', $idedit);
	$stmt_edit->execute();
	$row_curr = $stmt_edit->fetch(PDO::FETCH_ASSOC);

	$efield1 = $row_curr['username'];
	$efield2 = $row_curr['passcode'];
	$efield3 = $row_curr['img_url'];
	$efield4 = $row_curr['uemail'];
	$efield5 = $row_curr['umobileno'];
	$efield6 = $row_curr['xposition'];
	$efield7 = $row_curr['ustatz'];
	$efield8 = $row_curr['lname'];
	$efield9 = $row_curr['fname'];
	$efield10 = $row_curr['mname'];
	$efield11 = $row_curr['address'];
	$efield12 = $row_curr['cmpny'];
	$efield13 = $row_curr['cmpny_position'];
	$dimgpext9 = $row_curr['extname'];

	if ($efield3 == "") {
		$profpicsurrer = "../../../storage/img/no-image.jpg";
	} elseif ($dimgpext9 == "") {
		$profpicsurrer = $efield3;
	} else {
		$profpicsurrer = "../../../".$efield3;
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

<main class="page-content">
	<div class="container-fluid bg-light-opacity">
		<form id="user-edit" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<img id="imgogsrc3" class="img-thumbnail" src="<?php echo $profpicsurrer; ?>" data-toggle="modal" data-target="#ymModalImgPreview">
					</div>
				</div>
				<div class="col-md-9">
					<div class="form-group">
						<label for="profpic">Profile Picture:</label>
						<div class="input-group mb-3">
							<input type="file" id="profpic" name="profpic" class="form-control" placeholder="Upload File" accept="image/*">
						</div>
					</div>
				</div>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">User Type *</span>
				</div>
				<select id="usertype" class="form-control" name="usertype" required autofocus>
					<option value="" <?php if($efield6=='') echo 'selected="selected"'; ?>>- Select User Type -</option>
					<option value="Customer" <?php if($efield6=='Customer') echo 'selected="selected"'; ?>>Customer</option>
					<option value="Cashier" <?php if($efield6=='Cashier') echo 'selected="selected"'; ?>>Cashier</option>
					<option value="Administrator" <?php if($efield6=='Administrator') echo 'selected="selected"'; ?>>Administrator</option>
				</select>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Username</span>
				</div>
				<input id="idxfieldtxt" type="text" class="form-control" placeholder="Username" name="idxfieldtxt" value="<?php echo $efield1; ?>" readonly>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">E-mail</span>
				</div>
				<input id="idxfieldtxt" type="email" class="form-control" placeholder="E-mail" name="idxfieldtxt" value="<?php echo $efield4; ?>" readonly>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Phone</span>
				</div>
				<input id="idxfieldtxt" type="tel" class="form-control" placeholder="Phone" name="idxfieldtxt" pattern="[0-9]{11}" value="<?php echo $efield5; ?>" readonly>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Last Name *</span>
				</div>
				<input id="idxfieldtxt" type="text" class="form-control" placeholder="Last Name" name="idxfieldtxt" value="<?php echo $efield8; ?>" required autofocus>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">First Name *</span>
				</div>
				<input id="idxfieldtxt" type="text" class="form-control" placeholder="First Name" name="idxfieldtxt" value="<?php echo $efield9; ?>" required autofocus>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Middle Name</span>
				</div>
				<input id="idxfieldtxt" type="text" class="form-control" placeholder="Middle Name" name="idxfieldtxt" value="<?php echo $efield10; ?>" autofocus>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Address *</span>
				</div>
				<textarea id="zaddress" class="form-control" placeholder="Address" name="zaddress" value="<?php echo $efield11; ?>" required readonly autofocus></textarea>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>
			<input id="plsaddrloc" type="button" data-toggle="modal" data-target="#ymModalAddress" value="Add Address">

			<!-- Button Function -->
			<div class="row justify-content-end">
				<input type="button" name="btnCopyResetPW" id="btnCopyResetPW" class="btn btn-primary btn-sm m-2" value="Copy Reset Password">
				<input type="submit" name="btnUpdate" value="Update" class="btn btn-warning btn-sm m-2">
				<a href="../../../routes/user" class="btn btn-danger btn-sm m-2">Close</a>
			</div>
		</form>
	</div>
</main>

<?php

	include_once "../../../inc/address/index.php";

	try {
		if (isset($_POST['btnUpdate'])) {
			if (empty($_POST['idxfieldtxt'])) {
				$err_msg = "Please fill-up the form properly.";
			} else {
				// search for duplicate
				$stblname = "tbl_sysuser";
				$setstr_id = "id";
				$setstr_txt = "fieldtxt";

				$qry_insert = "UPDATE {$stblname} SET 
					{$setstr_txt}=:itxtfields, 
					WHERE {$setstr_id}=:idnow
				";
				$stmt_insert = $cnn->prepare($qry_insert);
				$idnow = $idedit;
				$itxtfields = $_POST['idxfieldtxt'];
				$stmt_insert->bindParam(':idnow', $idnow);
				$stmt_insert->bindParam(':itxtfields', $itxtfields);
				$stmt_insert->execute();

				$err_msg = "Update successfully.";
				echo "<script>alert('".$err_msg."');</script>";
			}
		}
	} catch (PDOException $error) {
		$err_msg = $error->getMessage();
		echo "<p>Error: {$err_msg}</p>";
		die;
	}