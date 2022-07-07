<?php
	include_once "../../../content/template-part/{$themename}/dashboard-navbar.php";
	include_once "../../../inc/address/index.php";

	$idedit = trim($_GET['id']);

	// search for duplicate
	$qry_edit = "SELECT * FROM {$tblname} WHERE {$prim_id}=:idedit LIMIT 1";
	$stmt_edit = $cnn->prepare($qry_edit);
	$stmt_edit->bindParam(':idedit', $idedit);
	$stmt_edit->execute();
	$row_curr = $stmt_edit->fetch(PDO::FETCH_ASSOC);

	$lname = $row_curr['lname'];
	$fname = $row_curr['fname'];
	$mname = $row_curr['mname'];
	$xposition = $row_curr['xposition'];
	$ulevpos = $row_curr['ulevpos'];
	$address = $row_curr['address'];
	$createdby = $row_curr['createdby'];
	$cmpny = $row_curr['cmpny'];
	$cmpny_position = $row_curr['cmpny_position'];
	$timeZone = $row_curr['timeZone'];

	try {
		if (isset($_POST['btnUpdate'])) {
			if (empty(trim($_POST['idx_lname'])) || empty(trim($_POST['idx_fname'])) || empty(trim($_POST['idx_mname'])) || empty(trim($_POST['idx_cmpny']))) {
				$err_msg = "Please fill-up the form properly.";
				echo "<script>alert('{$err_msg}');</script>";
			} else {
				// search for duplicate
				$qry_insert = "UPDATE {$tblname} SET 
					fullname=:itxtfullname, 
					lname=:itxtlname, 
					fname=:itxtfname, 
					mname=:itxtmname, 
					xposition=:itxtxposition, 
					ulevpos=:itxtulevpos, 
					address=:itxtaddress, 
					createdby=:itxtcreatedby, 
					cmpny=:itxtcmpny, 
					cmpny_position=:itxtcmpnyposition, 
					timeZone=:itxttimeZone
					WHERE {$prim_id}=:idnow
				";
				$stmt_insert = $cnn->prepare($qry_insert);
				$itxt_lname = trim($_POST['idx_lname']);
				$itxt_fname = trim($_POST['idx_fname']);
				$itxt_mname = trim($_POST['idx_mname']);
				$itxt_xposition = trim($_POST['idx_xposition']);

				include_once "../../../inc/acctype/acctype.php";
				$itxt_ulevpos = $currposit;

				if (empty(trim($itxt_mname))) {
					$itxt_fullname = trim($itxt_fname.' '.$itxt_lname);
				} else {
					$itxt_fullname = trim($itxt_fname.' '.substr($itxt_mname,0,1).'. '.$itxt_lname);
				}
				$itxt_address = trim($_POST['zaddress']);
				$itxt_createdby = trim($_POST['idx_createdby']);
				$itxt_cmpny = trim($_POST['idx_cmpny']);
				$itxt_cmpny_position = trim($_POST['idx_cmpny_position']);
				$itxt_timeZone = trim($_POST['idx_timeZone']);

				$stmt_insert->bindParam(':itxtfullname', $itxt_fullname);
				$stmt_insert->bindParam(':itxtlname', $itxt_lname);
				$stmt_insert->bindParam(':itxtfname', $itxt_fname);
				$stmt_insert->bindParam(':itxtmname', $itxt_mname);
				$stmt_insert->bindParam(':itxtxposition', $itxt_xposition);
				$stmt_insert->bindParam(':itxtulevpos', $itxt_ulevpos);
				$stmt_insert->bindParam(':itxtaddress', $itxt_address);
				$stmt_insert->bindParam(':itxtcreatedby', $itxt_createdby);
				$stmt_insert->bindParam(':itxtcmpny', $itxt_cmpny);
				$stmt_insert->bindParam(':itxtcmpnyposition', $itxt_cmpny_position);
				$stmt_insert->bindParam(':itxttimeZone', $itxt_timeZone);

				$stmt_insert->bindParam(':idnow', $idedit);
				$stmt_insert->execute();

				$err_msg = "Update successfully.";
				echo "<script>alert('{$err_msg}');window.location='../../../routes/{$foldername}/editupdate?id={$idedit}'</script>";
			}
		}
	} catch (PDOException $error) {
		$err_msg = $error->getMessage();
		echo "<p>Error: {$err_msg}</p>";
		die;
	}
?>

<main class="page-content">
	<div class="container-fluid bg-light-opacity">
		<form method="post" class="needs-validation" novalidate>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Account Type *</span>
				</div>
				<select id="idx_xposition" class="form-control" name="idx_xposition" value="<?php echo $xposition; ?>" required autofocus>
					<?php include_once "../../../inc/acctype/index.php"; ?>
				</select>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Lastname</span>
				</div>
				<input id="idx_lname" name="idx_lname" type="text" class="form-control" placeholder="Lastname" required value="<?php echo $lname; ?>">
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Firstname</span>
				</div>
				<input id="idx_fname" name="idx_fname" type="text" class="form-control" placeholder="Firstname" required value="<?php echo $fname; ?>">
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Middle Name</span>
				</div>
				<input id="idx_mname" name="idx_mname" type="text" class="form-control" placeholder="Middle Name" value="<?php echo $mname; ?>">
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Company</span>
				</div>
				<input id="idx_cmpny" name="idx_cmpny" type="text" class="form-control" placeholder="Company" value="<?php echo $cmpny; ?>" list="cmpnyList">
				<datalist id="cmpnyList">
				<?php
					$stmtcreaby = $cnn->prepare("SELECT * FROM tbl_sysuser ORDER BY cmpny DESC");
					$stmtcreaby->execute();
					foreach ($stmtcreaby as $rowcreaby) {
						echo "<option value='".$rowcreaby['cmpny']."'>";
					}
				?>
				</datalist>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Position</span>
				</div>
				<input id="idx_cmpny_position" name="idx_cmpny_position" type="text" class="form-control" placeholder="Position" value="<?php echo $cmpny_position; ?>" list="cmpnyPositionList">
				<datalist id="cmpnyPositionList">
				<?php
					$stmtcreaby = $cnn->prepare("SELECT * FROM tbl_sysuser ORDER BY cmpny_position DESC");
					$stmtcreaby->execute();
					foreach ($stmtcreaby as $rowcreaby) {
						echo "<option value='".$rowcreaby['cmpny_position']."'>";
					}
				?>
				</datalist>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Time Zone</span>
				</div>
				<input id="idx_timeZone" name="idx_timeZone" type="text" class="form-control" placeholder="Time Zone" value="<?php echo $timeZone; ?>" list="timeZoneList">
				<datalist id="timeZoneList">
				<?php
					$stmtcreaby = $cnn->prepare("SELECT * FROM tbl_sysuser ORDER BY timeZone DESC");
					$stmtcreaby->execute();
					foreach ($stmtcreaby as $rowcreaby) {
						echo "<option value='".$rowcreaby['timeZone']."'>";
					}
				?>
				</datalist>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Master User</span>
				</div>
				<input id="idx_createdby" name="idx_createdby" type="text" class="form-control" placeholder="Master User" value="<?php echo $createdby; ?>" list="userList">
				<datalist id="userList">
				<?php
					$stmtcreaby = $cnn->prepare("SELECT * FROM tbl_sysuser ORDER BY usercode DESC");
					$stmtcreaby->execute();
					foreach ($stmtcreaby as $rowcreaby) {
						echo "<option value='".$rowcreaby['usercode']."'>".$rowcreaby['cmpny']." | ".$rowcreaby['fullname']."</option>";
					}
				?>
				</datalist>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Address</span>
				</div>
				<textarea id="zaddress" class="form-control" placeholder="Address" name="zaddress" readonly autofocus><?php echo $address; ?></textarea>
			</div>
			<input id="plsaddrloc" type="button" data-toggle="modal" data-target="#ymModalAddress" value="Add Address" name="plsaddrloc">

			<div class="row justify-content-end">
				<input type="submit" name="btnUpdate" value="Update" class="btn btn-warning btn-sm m-2">
				<a href="../../../routes/<?php echo $foldername; ?>" class="btn btn-danger btn-sm m-2">Close</a>
			</div>
		</form>
	</div>
</main>