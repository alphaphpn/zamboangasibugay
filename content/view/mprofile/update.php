<?php

	include_once "../../inc/srvr.php";
	$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);

	try {
		if (isset($_POST['btnUpdateProfile'])) {
			if (empty($_POST['plname']) || empty($_POST['pfname']) || empty($_POST['pmobilephone']) || empty($_POST['zaddress']) || empty($_POST['psecquest']) || empty($_POST['psecans'])) {
				echo '<div class="alert alert-danger alert-dismissible fade show">';
					echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
					echo 'Please fill-up the form properly.';
				echo '</div>';
			} else {
				// Get Filename Extension
				// $pfilename = $_FILES['profpic']['name'];
				// $pext = pathinfo($pfilename, PATHINFO_EXTENSION);
				$idnow = $_POST['pusercode'];
				// $profpicname = trim('USER'.$idnow);
				// $ptarget_dir = "../../content/theme/".$themename."/storage/img/profile/".$profpicname.".".$pext;
				// $xtarget_dir = "content/theme/".$themename."/storage/img/profile/".$profpicname.".".$pext;

				$stblname = "tbl_sysuser";
				$setstr_id = "usercode";
				$qry_insert = "UPDATE {$stblname} SET 
					lname=:plname, 
					fname=:pfname, 
					mname=:pmname, 
					fullname=:fullname, 
					umobileno=:pmobilephone, 
					cmpny=:pemployer, 
					address=:paddress, 
					cmpny_position=:pjobposition, 
					secquest=:psecquest, 
					secans=:psecans
					WHERE {$setstr_id}=:idnow
				";

				// img_url=:xtarget_dir,
				// extname=:pext 

				$stmt_insert = $cnn->prepare($qry_insert);				
				$plname = $_POST['plname'];
				$pfname = $_POST['pfname'];
				$pmname = $_POST['pmname'];
				$middle_initial = substr($pmname,0,1);
				if (empty($pmname)) {
					$fullname = $pfname.' '.$plname;
				} else {
					$fullname = $pfname.' '.$middle_initial.'. '.$plname;
				}
				$pmobilephone = $_POST['pmobilephone'];
				$pemployer = $_POST['pemployer'];
				$pjobposition = $_POST['pjobposition'];
				$paddress = $_POST['zaddress'];
				$psecquest = $_POST['psecquest'];
				$psecans = $_POST['psecans'];
				$stmt_insert->bindParam(':idnow', $idnow);
				$stmt_insert->bindParam(':plname', $plname);
				$stmt_insert->bindParam(':pfname', $pfname);
				$stmt_insert->bindParam(':pmname', $pmname);
				$stmt_insert->bindParam(':fullname', $fullname);
				$stmt_insert->bindParam(':pmobilephone', $pmobilephone);
				$stmt_insert->bindParam(':pemployer', $pemployer);
				$stmt_insert->bindParam(':pjobposition', $pjobposition);
				$stmt_insert->bindParam(':paddress', $paddress);
				$stmt_insert->bindParam(':psecquest', $psecquest);
				$stmt_insert->bindParam(':psecans', $psecans);
				// $stmt_insert->bindParam(':xtarget_dir', $xtarget_dir);
				// $stmt_insert->bindParam(':pext', $pext);
				$stmt_insert->execute();

				// $ptarget_file = $ptarget_dir . basename($_FILES["profpic"]["name"]);
				// $puploadOk = 1;
				// $pimageFileType = strtolower(pathinfo($ptarget_file,PATHINFO_EXTENSION));

				// Check if image file is a actual image or fake image
				// $pcheck = getimagesize($_FILES["profpic"]["tmp_name"]);
				// if($pcheck !== false) {
				// 	echo "File is an image - " . $pcheck["mime"] . ".";
				// 	$puploadOk = 1;
				// } else {
				// 	$perr_msg = "File is not an image.";
				// 	echo "<script>alert('".$perr_msg."');</script>";
				// 	$puploadOk = 0;
				// }

				// Check if file already exists
				// if (file_exists($ptarget_file)) {
				// 	$perr_msg = "Sorry, file already exists.";
				// 	echo "<script>alert('".$perr_msg."');</script>";
				// 	$puploadOk = 0;
				// }

				// Allow certain file formats
				// if ($pimageFileType != "jpg" && $pimageFileType != "png" && $pimageFileType != "jpeg" && $pimageFileType != "gif" ) {
				// 	$perr_msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				// 	echo "<script>alert('".$perr_msg."');</script>";
				// 	$puploadOk = 0;
				// }

				// Check if $uploadOk is set to 0 by an error
				// if ($puploadOk == 0) {
				// 	$perr_msg = "Sorry, your file was not uploaded.";
				// 	echo "<script>alert('".$perr_msg."');</script>";
				// } else {
				// 	if (move_uploaded_file($_FILES["profpic"]["tmp_name"], $ptarget_dir)) {
				// 		$perr_msg = "The file ". htmlspecialchars( basename( $_FILES["profpic"]["name"])). " has been uploaded.";
				// 		echo "<script>alert('".$perr_msg."');</script>";
				// 	} else {
				// 		$perr_msg = "Sorry, there was an error uploading your file.";
				// 		echo "<script>alert('".$perr_msg."');</script>";
				// 	}
				// }

				echo "<script>window.open('../../routes/mprofile', '_self');</script>";
			}
		}
	} catch (PDOException $error) {
		$err_msg = $error->getMessage();
		echo "<p>Error: {$err_msg}</p>";
		die;
	}