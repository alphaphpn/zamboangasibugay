<?php
	include_once "../../../content/template-part/{$themename}/dashboard-navbar.php";
	include_once "../../../inc/core.php";
	include_once "../../../inc/srvr.php";
	include_once "../../../inc/cnndb.php";

	$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);

	$qry_profilez = "SELECT * FROM tbl_sysuser WHERE usercode=:profileidz LIMIT 1";
	$stmt_profilez = $cnn->prepare($qry_profilez);
	$profileidz = $_SESSION["usercode"];
	$stmt_profilez->bindParam(':profileidz', $profileidz);
	$stmt_profilez->execute();
	$row_profilez = $stmt_profilez->fetch(PDO::FETCH_ASSOC);

	$pusercode = $row_profilez["usercode"];
	$pusername = $row_profilez["username"];
	$pfullname = $row_profilez["fullname"];
	$psurname = $row_profilez["lname"];
	$pfirstname = $row_profilez["fname"];
	$pmiddlename = $row_profilez["mname"];
	$pemail = $row_profilez["uemail"];
	$paddress = $row_profilez["address"];
	$psecquest = $row_profilez["secquest"];
	$psecans = $row_profilez["secans"];
	$pmobilephone = $row_profilez["umobileno"];
	$pemployer = $row_profilez["cmpny"];
	$pjobposition = $row_profilez["cmpny_position"];
?>

<main class="page-content">
	<div class="container-fluid bg-light-opacity">
		<form id="user-add" method="post" class="needs-validation" novalidate>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">User Type *</span>
				</div>
				<input type="text" id="usertype" name="usertype" class="form-control" value="<?php echo $pjobposition; ?>" readonly>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Username *</span>
				</div>
				<input id="idxfieldtxt" type="text" class="form-control" placeholder="Username" name="idxfieldtxt" value="<?php echo $pusername; ?>" required autofocus>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">E-mail *</span>
				</div>
				<input id="idxfieldtxt" type="email" class="form-control" placeholder="E-mail" name="idxfieldtxt" value="<?php echo $pemail; ?>" required autofocus>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Phone *</span>
				</div>
				<input id="idxfieldtxt" type="tel" class="form-control" placeholder="Phone" name="idxfieldtxt" pattern="[0-9]{11}" value="<?php echo $pmobilephone; ?>" required autofocus>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Last Name *</span>
				</div>
				<input id="idxfieldtxt" type="text" class="form-control" placeholder="Last Name" name="idxfieldtxt" value="<?php echo $psurname; ?>" required autofocus>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">First Name *</span>
				</div>
				<input id="idxfieldtxt" type="text" class="form-control" placeholder="First Name" name="idxfieldtxt" value="<?php echo $pfirstname; ?>" required autofocus>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Middle Name</span>
				</div>
				<input id="idxfieldtxt" type="text" class="form-control" placeholder="Middle Name" name="idxfieldtxt" value="<?php echo $pmiddlename; ?>" autofocus>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Address *</span>
				</div>
				<textarea id="zaddress" class="form-control" placeholder="Address" name="zaddress" value="<?php echo $plsaddrloc; ?>" required autofocus></textarea>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>
			<input id="plsaddrloc" type="button" data-toggle="modal" data-target="#ymModalAddress" value="Select Address">

			<br><br>
			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Secuirty Question</span>
				</div>
				<input id="psecquest" type="text" class="form-control" placeholder="Secuirty Question" name="psecquest" value="<?php echo $psecquest; ?>" list="secquestList" required autofocus>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
				<datalist id="secquestList">
				<?php
					$stmtsecquest = $cnn->prepare("SELECT * FROM tbl_secquest GROUP BY secquest ORDER BY secquest ASC");
					$stmtsecquest->execute();
					$resultsecquest = $stmtsecquest->setFetchMode(PDO::FETCH_ASSOC);
					foreach ($stmtsecquest as $rowsecquest) {
						echo "<option value='".$rowsecquest['secquest']."'>";
					}
				?>
				</datalist>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Security Answer</span>
				</div>
				<input id="psecans" type="text" class="form-control" placeholder="Security Answer" name="psecans" value="<?php echo $psecans; ?>" required autofocus>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>

			<div class="row justify-content-end">
				<input type="submit" name="btnSave" value="Save" class="btn btn-info btn-sm m-2">
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