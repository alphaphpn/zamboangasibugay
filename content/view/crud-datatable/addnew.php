<?php
	include_once "../../../content/template-part/{$themename}/dashboard-navbar.php";

	try {
		if (isset($_POST['btnSave'])) {
			if (empty(trim($_POST['idx_fieldname']))) {
				$err_msg = "Please fill-up the form properly.";
				echo "<script>alert('{$err_msg}');</script>";
			} else {
				// search for duplicate
				$qry_dupli = "SELECT * FROM {$tblname} WHERE fieldtxt=:txtfields";
				$stmt_dupli = $cnn->prepare($qry_dupli);
				$txtfields = trim($_POST['idx_fieldname']);
				$stmt_dupli->bindParam(':txtfields', $txtfields);
				$stmt_dupli->execute();
				$rw_counts = $stmt_dupli->rowCount();

				if ($rw_counts > 0) {
					$err_msg = "Record already exist.";
					echo "<script>alert('{$err_msg}');</script>";
				} else {
					$qry_insert = "INSERT INTO {$tblname} SET fieldtxt=:itxtfields";
					$stmt_insert = $cnn->prepare($qry_insert);
					$itxtfields = trim($_POST['idx_fieldname']);
					$stmt_insert->bindParam(':itxtfields', $itxtfields);
					$stmt_insert->execute();

					$err_msg = "Save successfully.";
					echo "<script>alert('{$err_msg}');</script>";
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

			<!-- Start copy here -->
			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Label | Caption | Title</span>
				</div>
				<input id="idx_fieldname" type="text" class="form-control" placeholder="Label | Caption | Title" name="idx_fieldname" required autofocus>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>
			<!-- End copy here -->

			<div class="row justify-content-end">
				<input type="submit" name="btnSave" value="Save" class="btn btn-info btn-sm m-2">
				<a href="../../../routes/<?php echo $foldername; ?>" class="btn btn-danger btn-sm m-2">Close</a>
			</div>
		</form>
	</div>
</main>
	