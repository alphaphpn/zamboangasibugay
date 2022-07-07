<?php

	try {
		if (isset($_POST["btnSubmit"])) {
			if (empty($_POST["younickname"]) || empty($_POST["passcode1"])) {
				echo '<div class="alert alert-danger alert-dismissible fade show">';
					echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
					echo 'Please enter username and password.';
				echo '</div>';
			} else {
				$query = "SELECT * FROM tbl_sysuser WHERE username=:younickname OR uemail=:xemail OR umobileno=:xphone LIMIT 1";
				$statement = $cnn->prepare($query);
				$username = $_POST['younickname'];
				$xemail = $_POST['xemail'];
				$xphone = $_POST['xphone'];
				$statement->bindParam(':younickname', $username);
				$statement->bindParam(':xemail', $xemail);
				$statement->bindParam(':xphone', $xphone);
				$statement->execute();
				$count = $statement->rowCount();
				if ($count > 0) {
					echo '<div class="alert alert-danger alert-dismissible fade show">';
						echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
						echo 'Account already exist';
					echo '</div>';
				} else {
					include_once "../../inc/signup/autogen.php";
					$qry_insert = "INSERT INTO tbl_sysuser SET 
							usercode=:idx, 
							username=:younicknamex, 
							uemail=:xemail, 
							umobileno=:xphone, 
							passcode=:passcode1x, 
							ulevpos=6, 
							xposition=:xposition, 
							ustatz=1, 
							gogfirstime=0, 
							pin=:pin"
						;
					$stmt_insert = $cnn->prepare($qry_insert);
					$younickname = $_POST['younickname'];
					$xemail = $_POST['xemail'];
					$xphone = $_POST['xphone'];
					$passcode1 = md5($_POST['passcode1']);
					$xposition = "Customer";
					$permitted_chars2 = '0123456789';
					$pin = substr(str_shuffle($permitted_chars2), 0, 6);
					$stmt_insert->bindParam(':idx', $fromidted);
					$stmt_insert->bindParam(':younicknamex', $younickname);
					$stmt_insert->bindParam(':xemail', $xemail);
					$stmt_insert->bindParam(':xphone', $xphone);
					$stmt_insert->bindParam(':passcode1x', $passcode1);
					$stmt_insert->bindParam(':xposition', $xposition);
					$stmt_insert->bindParam(':pin', $pin);
					$stmt_insert->execute();

					$err_msg = "Account successfully registered. ID: ".$fromidted;
					echo "<script>alert('".$err_msg."'); window.open('../../routes/login','_self')</script>";
				}
			}
		}
	} catch (PDOException $error) {
		die('ERROR: ' . $error->getMessage());
	}
	
?>