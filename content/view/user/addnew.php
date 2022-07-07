<?php
	include_once "../../../content/template-part/{$themename}/dashboard-navbar.php";
	include_once "../../../inc/random-code/index.php";
	include_once "../../../inc/address/index.php";

	if ($_SESSION["ulevpos"]==4) {
		$xposition = 'Agent';
	} else {
		$xposition = 'Customer';
	}

	try {
		if (isset($_POST['btnSave'])) {
			if (empty(trim($_POST['idx_lname'])) || empty(trim($_POST['idx_fname'])) || empty(trim($_POST['idx_mname'])) || empty(trim($_POST['idx_cmpny'])) || empty(trim($_POST['nickname'])) || empty(trim($_POST['aemail'])) || empty(trim($_POST['aphone']))) {
				$err_msg = "Please fill-up the form properly.";
				// echo "<script>alert('{$err_msg}');</script>";

				echo '<div class="alert alert-danger alert-dismissible fade show">';
					echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
					echo 'Please fill-up the form properly.';
				echo '</div>';
			} else {
				// search for duplicate Username
				$qry_username = "SELECT * FROM {$tblname} WHERE username=:txtusername";
				$stmt_username = $cnn->prepare($qry_username);
				$txt_username = trim($_POST['nickname']);
				$stmt_username->bindParam(':txtusername', $txt_username);
				$stmt_username->execute();
				$rw_username = $stmt_username->rowCount();

				if ($rw_username > 0) {
					$err_msg = "Username already exist.";
					echo "<script>alert('{$err_msg}');</script>";
				} else {
					// search for duplicate Email
					$qry_uemail = "SELECT * FROM {$tblname} WHERE uemail=:txtuemail";
					$stmt_uemail = $cnn->prepare($qry_uemail);
					$txt_uemail = trim($_POST['aemail']);
					$stmt_uemail->bindParam(':txtuemail', $txt_uemail);
					$stmt_uemail->execute();
					$rw_uemail = $stmt_uemail->rowCount();

					if ($rw_uemail > 0) {
						$err_msg = "Email already exist.";
						echo "<script>alert('{$err_msg}');</script>";
					} else {
						// search for duplicate Mobile
						$qry_umobileno = "SELECT * FROM {$tblname} WHERE umobileno=:txtumobileno";
						$stmt_umobileno = $cnn->prepare($qry_umobileno);
						$txt_umobileno = trim($_POST['aphone']);
						$stmt_umobileno->bindParam(':txtumobileno', $txt_umobileno);
						$stmt_umobileno->execute();
						$rw_umobileno = $stmt_umobileno->rowCount();

						if ($rw_umobileno > 0) {
							$err_msg = "Monile number already exist.";
							echo "<script>alert('{$err_msg}');</script>";
						} else {
							include_once "../../../inc/signup/autogen.php";
							
							// Add New Record
							$insert_username = "INSERT INTO {$tblname} SET 
								usercode=:fromidted, 
								xposition=:usertype, 
								ulevpos=:itxtulevpos,
								username=:nickname, 
								uemail=:aemail, 
								umobileno=:aphone, 
								passcode=:apasscode, 
								pin=:apin, 
								lname=:alname, 
								fname=:afname, 
								mname=:amname, 
								address=:zaddress, 
								deletedx=0,
								ustatz=1, 
								uonline=0, 
								fullname=:fullnems, 
								createdby=:createdby, 
								cmpny=:cmpny, 
								cmpny_position=:cmpnyposition, 
								timeZone=:timeZone
							";
							$stmt_insert = $cnn->prepare($insert_username);

							$txt_username = trim($_POST['nickname']);
							$apasscode = md5($_POST['idx_pin']);
							$apin = $_POST['idx_pin'];
							$txt_umobileno = trim($_POST['aphone']);

							$rcnt = strlen($txt_umobileno) - 10;
							$rphone = substr($txt_umobileno,$rcnt,10);

							$txt_uemail = trim($_POST['aemail']);
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

							$stmt_insert->bindParam(':fromidted', $fromidted);
							$stmt_insert->bindParam(':nickname', $txt_username);
							$stmt_insert->bindParam(':aemail', $txt_uemail);
							$stmt_insert->bindParam(':aphone', $rphone);
							$stmt_insert->bindParam(':usertype', $itxt_xposition);
							$stmt_insert->bindParam(':itxtulevpos', $itxt_ulevpos);
							$stmt_insert->bindParam(':apasscode', $apasscode);
							$stmt_insert->bindParam(':apin', $apin);
							$stmt_insert->bindParam(':alname', $itxt_lname);
							$stmt_insert->bindParam(':afname', $itxt_fname);
							$stmt_insert->bindParam(':amname', $itxt_mname);
							$stmt_insert->bindParam(':zaddress', $itxt_address);
							$stmt_insert->bindParam(':fullnems', $itxt_fullname);
							$stmt_insert->bindParam(':createdby', $uid);

							$stmt_insert->bindParam(':cmpny', $itxt_cmpny);
							$stmt_insert->bindParam(':cmpnyposition', $itxt_cmpny_position);
							$stmt_insert->bindParam(':timeZone', $itxt_timeZone);

							$stmt_insert->execute();
							$err_msg = "Save successfully.";
							echo "<script>alert('{$err_msg}');</script>";
						}
					}
				}
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
					<span class="input-group-text">Username *</span>
				</div>
				<input id="nickname" minlength="4" type="text" class="form-control" placeholder="Username" name="nickname" required autofocus>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">PIN *</span>
				</div>
				<input id="idx_pin" type="text" class="form-control" placeholder="PIN" value="<?php echo $randcode6; ?>" name="idx_pin" maxlength="6" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required autofocus>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">E-mail *</span>
				</div>
				<input id="aemail" type="email" class="form-control" placeholder="E-mail" name="aemail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required autofocus>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Phone *</span>
				</div>
				<input id="aphone" type="tel" class="form-control" placeholder="Phone" name="aphone" pattern="[0-9]{11}" required autofocus>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Lastname</span>
				</div>
				<input id="idx_lname" name="idx_lname" type="text" class="form-control" placeholder="Lastname" required>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Firstname</span>
				</div>
				<input id="idx_fname" name="idx_fname" type="text" class="form-control" placeholder="Firstname" required>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Middle Name</span>
				</div>
				<input id="idx_mname" name="idx_mname" type="text" class="form-control" placeholder="Middle Name" required>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Company</span>
				</div>
				<input id="idx_cmpny" name="idx_cmpny" type="text" class="form-control" placeholder="Company" list="cmpnyList" required>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
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
				<input id="idx_cmpny_position" name="idx_cmpny_position" type="text" class="form-control" placeholder="Position" list="cmpnyPositionList" required>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
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
				<input id="idx_timeZone" name="idx_timeZone" type="text" class="form-control" placeholder="Time Zone" list="timeZoneList">
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
				<input id="idx_createdby" name="idx_createdby" type="text" class="form-control" placeholder="Master User" value="<?php echo $uid; ?>" list="userList">
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
				<textarea id="zaddress" class="form-control" placeholder="Address" name="zaddress" readonly autofocus></textarea>
			</div>
			<input id="plsaddrloc" type="button" data-toggle="modal" data-target="#ymModalAddress" value="Add Address" name="plsaddrloc">

			<div class="row justify-content-end">
				<input type="submit" name="btnSave" value="Save" class="btn btn-info btn-sm m-2">
				<a href="../../../routes/<?php echo $foldername; ?>" class="btn btn-danger btn-sm m-2">Close</a>
			</div>
		</form>
	</div>
</main>
	