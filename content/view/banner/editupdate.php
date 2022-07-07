<?php
	include_once "../../content/template-part/".$themename."/dashboard-navbar.php";
	include_once "../../../inc/core.php";
	include_once "../../../inc/srvr.php";
	$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);

	$idedit = $_GET['id'];

	// search for duplicate
	$etblname = "tblcrud";
	$edispid = "id";
	$qry_edit = "SELECT * FROM {$etblname} WHERE {$edispid}=:idedit LIMIT 1";
	$stmt_edit = $cnn->prepare($qry_edit);
	$stmt_edit->bindParam(':idedit', $idedit);
	$stmt_edit->execute();
	$row_curr = $stmt_edit->fetch(PDO::FETCH_ASSOC);

	$efield1 = $row_curr['fieldtxt'];
?>

<main class="page-content">
	<div class="container-fluid bg-light-opacity">
		<form method="post" class="needs-validation" novalidate>
			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Fieldtxt</span>
				</div>
				<input id="idxfieldtxt" type="text" class="form-control" placeholder="Fieldtxt" name="idxfieldtxt" required value="<?php echo $efield1; ?>">
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>
			<div class="row justify-content-end">
				<input type="submit" name="btnUpdate" value="Update" class="btn btn-warning btn-sm m-2">
				<a href="../../../routes/banner" class="btn btn-danger btn-sm m-2">Close</a>
			</div>
		</form>
	</div>
</main>

<?php

	try {
		if (isset($_POST['btnUpdate'])) {
			if (empty(trim($_POST['idxfieldtxt']))) {
				$err_msg = "Please fill-up the form properly.";
			} else {
				// search for duplicate
				$stblname = "tblcrud";
				$setstr_id = "id";
				$setstr_txt = "fieldtxt";

				$qry_insert = "UPDATE {$stblname} SET {$setstr_txt}=:itxtfields WHERE {$setstr_id}=:idnow";
				$stmt_insert = $cnn->prepare($qry_insert);
				$idnow = $idedit;
				$itxtfields = trim($_POST['idxfieldtxt']);
				$stmt_insert->bindParam(':idnow', $idnow);
				$stmt_insert->bindParam(':itxtfields', $itxtfields);
				$stmt_insert->execute();

				$err_msg = "Update successfully.";
				echo "<script>alert('".$err_msg."');window.location='../../../routes/banner/editupdate?id=".$idedit."'</script>";
			}
		}
	} catch (PDOException $error) {
		$err_msg = $error->getMessage();
		echo "<p>Error: {$err_msg}</p>";
		die;
	}