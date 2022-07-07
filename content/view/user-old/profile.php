<?php
	include_once "../../../content/template-part/".$themename."/dashboard-navbar.php";
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
		$profpicsurrer = "../../../storage/img/no-image.jpg";
	} elseif ($extname == "") {
		$profpicsurrer = $pimglnkurl;
	} else {
		$profpicsurrer = "../../../".$pimglnkurl;
	}
?>

<main class="page-content">
	<div class="container-fluid bg-light-opacity">
		<form id="user-add" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
			<div class="row d-none">
				<div class="col-md-3">
					<div class="form-group">
						<img id="imgogsrc9" class="img-thumbnail" src="<?php echo $pimgurl; ?>" data-toggle="modal" data-target="#ymModalImgPreview">
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
				<input type="text" id="usertype" name="usertype" class="form-control" value="" readonly>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Username *</span>
				</div>
				<input id="idxfieldtxt" type="text" class="form-control" placeholder="Username" name="idxfieldtxt" required autofocus>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">E-mail *</span>
				</div>
				<input id="idxfieldtxt" type="email" class="form-control" placeholder="E-mail" name="idxfieldtxt" required autofocus>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Phone *</span>
				</div>
				<input id="idxfieldtxt" type="tel" class="form-control" placeholder="Phone" name="idxfieldtxt" pattern="[0-9]{11}" required autofocus>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Last Name *</span>
				</div>
				<input id="idxfieldtxt" type="text" class="form-control" placeholder="Last Name" name="idxfieldtxt" required autofocus>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">First Name *</span>
				</div>
				<input id="idxfieldtxt" type="text" class="form-control" placeholder="First Name" name="idxfieldtxt" required autofocus>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Middle Name</span>
				</div>
				<input id="idxfieldtxt" type="text" class="form-control" placeholder="Middle Name" name="idxfieldtxt" autofocus>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Address *</span>
				</div>
				<textarea id="zaddress" class="form-control" placeholder="Address" name="zaddress" required autofocus></textarea>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>
			<input id="plsaddrloc" type="button" data-toggle="modal" data-target="#ymModalAddress" value="Add Address">

			<br><br>
			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Secuirty Question</span>
				</div>
				<input id="psecquest" type="text" class="form-control" placeholder="Secuirty Question" name="psecquest" list="secquestList" required autofocus>
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
				<input id="psecans" type="text" class="form-control" placeholder="Security Answer" name="psecans" required autofocus>
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

<div class="modal" id="ymModalImgPreview">
	<div class="modal-dialog modal-img-preview-fit">
		<div class="modal-content">
			<button type="button" class="close text-right mr-1" data-dismiss="modal">&times;</button>
			<div class="modal-body">
				<img id="profvwimgfl3" class="preview-img-modal" src="../../../storage/img/no-image.jpg">
			</div>
		</div>
	</div>
</div>