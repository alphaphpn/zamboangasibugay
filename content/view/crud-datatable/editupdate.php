<?php
	include_once "../../../content/template-part/{$themename}/dashboard-navbar.php";
	$idedit = $_GET['id'];

	// search for duplicate
	$qry_edit = "SELECT * FROM {$tblname} WHERE {$prim_id}=:idedit LIMIT 1";
	$stmt_edit = $cnn->prepare($qry_edit);
	$stmt_edit->bindParam(':idedit', $idedit);
	$stmt_edit->execute();
	$row_curr = $stmt_edit->fetch(PDO::FETCH_ASSOC);

	$efield1 = $row_curr['fieldtxt'];

	try {
		if (isset($_POST['btnUpdate'])) {
			if (empty(trim($_POST['idx_fieldname']))) {
				$err_msg = "Please fill-up the form properly.";
				echo "<script>alert('{$err_msg}');</script>";
			} else {
				// search for duplicate
				$qry_insert = "UPDATE {$tblname} SET fieldtxt=:itxtfields WHERE {$prim_id}=:idnow";
				$stmt_insert = $cnn->prepare($qry_insert);
				$itxtfields = trim($_POST['idx_fieldname']);
				$stmt_insert->bindParam(':idnow', $idedit);
				$stmt_insert->bindParam(':itxtfields', $itxtfields);
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

			<!-- Start copy here -->
			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Label | Caption | Title</span>
				</div>
				<input id="idx_fieldname" type="text" class="form-control" placeholder="Label | Caption | Title" name="idx_fieldname" required value="<?php echo $efield1; ?>">
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>
			<!-- End copy here -->

			<div class="row justify-content-end">
				<input type="submit" name="btnUpdate" value="Update" class="btn btn-warning btn-sm m-2">
				<a href="../../../routes/<?php echo $foldername; ?>" class="btn btn-danger btn-sm m-2">Close</a>
			</div>
		</form>
	</div>
</main>