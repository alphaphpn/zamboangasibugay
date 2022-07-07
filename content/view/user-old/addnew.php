<?php
	include_once "../../../content/template-part/{$themename}/dashboard-navbar.php";
	include_once "../../../content/template-part/{$themename}/dashboard-navbar-top.php";
	include_once "../../../inc/core.php";
	include_once "../../../inc/srvr.php";
	include_once "../../../inc/cnndb.php";
	include_once "../../../inc/random-code/index.php";
	
	$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
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
		<form id="user-add" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<img id="imgogsrc3" class="img-thumbnail" src="../../../storage/img/no-image.jpg" data-toggle="modal" data-target="#ymModalImgPreview">
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
					<option value="" selected>- Select User Type -</option>
					<option value="Customer">Customer</option>
					<option value="Cashier">Cashier</option>
					<option value="Administrator">Administrator</option>
				</select>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Username *</span>
				</div>
				<input id="nickname" type="text" class="form-control" placeholder="Username" name="nickname" required autofocus>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">E-mail *</span>
				</div>
				<input id="aemail" type="email" class="form-control" placeholder="E-mail" name="aemail" required autofocus>
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
					<span class="input-group-text">Password *</span>
				</div>
				<input id="apasscode" type="text" class="form-control" placeholder="Temporary Password" value="<?php echo $randWPass; ?>" name="apasscode" required autofocus>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>

			<!-- div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">PIN *</span>
				</div>
				<input id="idxfieldtxt" type="text" class="form-control" placeholder="PIN" value="" name="idxfieldtxt" required autofocus>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div -->
			<?php // echo $randcode6; // for the value ?>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Last Name *</span>
				</div>
				<input id="alname" type="text" class="form-control" placeholder="Last Name" name="alname" required autofocus>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">First Name *</span>
				</div>
				<input id="afname" type="text" class="form-control" placeholder="First Name" name="afname" required autofocus>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Middle Name</span>
				</div>
				<input id="amname" type="text" class="form-control" placeholder="Middle Name" name="amname" autofocus>
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Address *</span>
				</div>
				<textarea id="zaddress" class="form-control" placeholder="Address" name="zaddress" required readonly autofocus></textarea>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>
			<input id="plsaddrloc" type="button" data-toggle="modal" data-target="#ymModalAddress" value="Add Address" name="plsaddrloc">

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

<?php

	include_once "../../../inc/address/index.php";

	try {
		if (isset($_POST['btnSave'])) {
			if (empty($_POST['alname'])) {
				$err_msg = "Please fill-up the form properly.";
				echo "<script>alert('".$err_msg."');</script>";
			} else {
				// search for duplicate
				$qry_dupli = "SELECT * FROM tbl_sysuser WHERE username=:nickname OR uemail=:aemail OR umobileno=:aphone AND deletedx=0";
				$stmt_dupli = $cnn->prepare($qry_dupli);
				$nickname = $_POST['nickname'];
				$aemail = $_POST['aemail'];
				$aphone = $_POST['aphone'];
				$stmt_dupli->bindParam(':nickname', $nickname);
				$stmt_dupli->bindParam(':aemail', $aemail);
				$stmt_dupli->bindParam(':aphone', $aphone);
				$stmt_dupli->execute();
				$rw_counts = $stmt_dupli->rowCount();

				if ($rw_counts > 0) {
					$err_msg = "Account already exist.";
					echo "<script>alert('".$err_msg."');</script>";
				} else {
					include_once "../../../inc/signup/autogen.php";

					$usertype = $_POST['usertype'];
					if ($usertype == 'Administrator') {
						$ulevpos = 1;
					} elseif ($usertype == 'Cashier') {
						$ulevpos = 3;
					} else {
						$ulevpos = 6;
					}

					// Get Filename Extension
					$filename = $_FILES['profpic']['name'];
					$ext = pathinfo($filename, PATHINFO_EXTENSION);
					$profpicname = trim('USER'.$fromidted);

					$target_dir = "content/theme/".$themename."/storage/img/profile/".$profpicname.".".$ext;

					$qry_insert = "INSERT INTO tbl_sysuser SET 
						usercode=:fromidted, 
						img_url=:profpic, 
						xposition=:usertype, 
						ulevpos=:ulevpos,
						username=:nickname, 
						uemail=:aemail, 
						umobileno=:aphone, 
						passcode=:apasscode, 
						lname=:alname, 
						fname=:afname, 
						mname=:amname, 
						address=:zaddress, 
						deletedx=0,
						ustatz=1, 
						uonline=0, 
						fullname=:fullnems, 
						extname=:extnem
					";

					$stmt_insert = $cnn->prepare($qry_insert);
					$nickname = $_POST['nickname'];
					$aemail = $_POST['aemail'];
					$aphone = $_POST['aphone'];
					$apasscode = md5($_POST['apasscode']);
					$alname = $_POST['alname'];
					$afname = $_POST['afname'];
					$amname = $_POST['amname'];
					$zaddress = $_POST['zaddress'];
					$fullnems = $afname.' '.substr($amname,0,1).'. '.$alname;
					$profpic = $target_dir;

					$stmt_insert->bindParam(':fromidted', $fromidted);
					$stmt_insert->bindParam(':profpic', $profpic);
					$stmt_insert->bindParam(':usertype', $usertype);
					$stmt_insert->bindParam(':nickname', $nickname);
					$stmt_insert->bindParam(':aemail', $aemail);
					$stmt_insert->bindParam(':aphone', $aphone);
					$stmt_insert->bindParam(':apasscode', $apasscode);
					$stmt_insert->bindParam(':alname', $alname);
					$stmt_insert->bindParam(':afname', $afname);
					$stmt_insert->bindParam(':amname', $amname);
					$stmt_insert->bindParam(':zaddress', $zaddress);
					$stmt_insert->bindParam(':fullnems', $fullnems);
					$stmt_insert->bindParam(':ulevpos', $ulevpos);
					$stmt_insert->bindParam(':extnem', $ext);
					$stmt_insert->execute();

					$target_file = $target_dir . basename($_FILES["profpic"]["name"]);
					$uploadOk = 1;
					$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

					// Check if image file is a actual image or fake image
					$check = getimagesize($_FILES["profpic"]["tmp_name"]);
					if($check !== false) {
						echo "File is an image - " . $check["mime"] . ".";
						$uploadOk = 1;
					} else {
						$err_msg = "File is not an image.";
						echo "<script>alert('".$err_msg."');</script>";
						$uploadOk = 0;
					}

					// Check if file already exists
					if (file_exists($target_file)) {
						$err_msg = "Sorry, file already exists.";
						echo "<script>alert('".$err_msg."');</script>";
						$uploadOk = 0;
					}

					// Check file size
					// if ($_FILES["profpic"]["size"] > 500000) {
					// 	$err_msg = "Sorry, your file is too large.";
					// 	echo "<script>alert('".$err_msg."');</script>";
					// 	$uploadOk = 0;
					// }

					// Allow certain file formats
					if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
						$err_msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
						echo "<script>alert('".$err_msg."');</script>";
						$uploadOk = 0;
					}

					// Check if $uploadOk is set to 0 by an error
					if ($uploadOk == 0) {
						$err_msg = "Sorry, your file was not uploaded.";
						echo "<script>alert('".$err_msg."');</script>";
					} else {
						if (move_uploaded_file($_FILES["profpic"]["tmp_name"], $target_dir)) {
							$err_msg = "The file ". htmlspecialchars( basename( $_FILES["profpic"]["name"])). " has been uploaded.";
							echo "<script>alert('".$err_msg."');</script>";
						} else {
							$err_msg = "Sorry, there was an error uploading your file.";
							echo "<script>alert('".$err_msg."');</script>";
						}
					}

					$err_msg = "Save successfully.";
					echo "<script>alert('".$err_msg."');</script>";
				}
			}
		}
	} catch (PDOException $error) {
		$err_msg = $error->getMessage();
		echo "<p>Error: {$err_msg}</p>";
		die;
	}

	if ($_SESSION["ulevpos"]==3 || $_SESSION["ulevpos"]==6) {
		echo '<scrip>alert("Access denied.");</script>';
	}