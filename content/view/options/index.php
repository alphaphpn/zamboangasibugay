<?php
	include_once "../../content/template-part/{$themename}/dashboard-navbar.php";
	include_once "../../content/template-part/{$themename}/dashboard-navbar-top.php";
	include_once "../../inc/core.php";
	include_once "../../inc/srvr.php";
	$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);

	$etblname = "conf";
	$qry_edit = "SELECT * FROM {$etblname} WHERE id=:ownerid LIMIT 1";
	$stmt_edit = $cnn->prepare($qry_edit);
	$stmt_edit->bindParam(':ownerid', $owner_id);
	$stmt_edit->execute();
	$row_curr = $stmt_edit->fetch(PDO::FETCH_ASSOC);
	$vthemename = $row_curr['themename'];
	$vdomainhome = $row_curr['domainhome'];
	$vobdevby = $row_curr['build_by'];
?>

<main class="page-content">
	<div class="container-fluid">
		<h4><?php echo $page_title; ?></h4>
		<form method="post" class="needs-validation" novalidate>
			
			<div class="row">
				<div class="col-lg-6">
					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">Theme</span>
						</div>
						<input id="idxthemename" type="text" class="form-control" placeholder="Theme" name="idxthemename" list="lstgroupby" required value="<?php echo $vthemename; ?>">
						<datalist id="lstgroupby">
							<?php
								$tblname = "tblthemename";
								$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
								$qry_grpby = $cnn->prepare("SELECT * FROM {$tblname} WHERE deletedx=0 ORDER BY themename ASC");
								$qry_grpby->execute();
								$rslt_grpby = $qry_grpby->setFetchMode(PDO::FETCH_ASSOC);
								foreach ($qry_grpby as $row_grpby) {
									$thiemtiet = $row_grpby['theme_title'];
									echo "<option label='".$thiemtiet."' value='".$row_grpby['themename']."'>";
								}
							?>
						</datalist>
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">Domain Directory</span>
						</div>
						<input id="idxdomainhome" type="text" class="form-control" placeholder="Domain Directory" name="idxdomainhome" required value="<?php echo $vdomainhome; ?>">
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>
				</div>

				<div class="col-lg-12">
					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">Owned / Build / Develop by:</span>
						</div>
						<textarea id="idxobdevby" class="form-control" placeholder=">Owned / Build / Develop by" name="idxobdevby" required><?php echo $vobdevby; ?></textarea>
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>
				</div>
			</div>
			<div class="row justify-content-end">
				<input type="submit" name="btnUpdate" value="Update" class="btn btn-warning btn-sm m-2">
				<a href="../../routes/dashboard" class="btn btn-danger btn-sm m-2">Close</a>
			</div>
		</form>
	</div>
</main>

<?php

	try {
		if (isset($_POST['btnUpdate'])) {
			if (empty(
				$_POST['idxthemename'] || 
				$_POST['idxdomainhome'] || 
				$_POST['idxobdevby']
			)) {
				$err_msg = "Please fill-up the form properly.";
				echo "<script>alert('".$err_msg."');window.location='../../routes/options';</script>";
			} else {
				// search for duplicate
				$stblname = "conf";
				$setstr_themename = "themename";
				$setstr_domainhome = "domainhome";
				$setstr_buildby = "build_by";

				$qry_insert = "UPDATE {$stblname} SET 
					{$setstr_themename}=:themename, 
					{$setstr_domainhome}=:domainhome, 
					{$setstr_buildby}=:buildby
					WHERE 
					id=:ownerid
				";
				$stmt_insert = $cnn->prepare($qry_insert);
				$itxtthemename = $_POST['idxthemename'];
				$itxtdomainhome = $_POST['idxdomainhome'];
				$itxtobdevby = $_POST['idxobdevby'];
				$stmt_insert->bindParam(':ownerid', $owner_id);
				$stmt_insert->bindParam(':themename', $itxtthemename);
				$stmt_insert->bindParam(':domainhome', $itxtdomainhome);
				$stmt_insert->bindParam(':buildby', $itxtobdevby);
				$stmt_insert->execute();

				$err_msg = "Update successfully.";
				echo "<script>alert('".$err_msg."');window.location='../../routes/options';</script>";
			}
		}
	} catch (PDOException $error) {
		$err_msg = $error->getMessage();
		echo "<p>Error: {$err_msg}</p>";
		die;
	}