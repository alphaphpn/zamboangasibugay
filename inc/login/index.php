<?php

	try {
		if (isset($_POST["btnLogin"])) {
			if (empty($_POST["username"]) || empty($_POST["passcode"])) {
				echo '<div class="alert alert-danger alert-dismissible fade show">';
					echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
					echo 'Please enter username and password.';
				echo '</div>';
			} else {
				$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
				$query = "SELECT * FROM tbl_sysuser WHERE username=:username OR uemail=:uemail OR umobileno=:umobileno LIMIT 1";
				$statement = $cnn->prepare($query);
				$username = htmlspecialchars($_POST['username']);
				$uemail = htmlspecialchars($_POST['username']);
				$umobileno = htmlspecialchars($_POST['username']);
				$passcode = htmlspecialchars(md5($_POST["passcode"]));
				$statement->bindParam(':username', $username);
				$statement->bindParam(':uemail', $uemail);
				$statement->bindParam(':umobileno', $umobileno);
				// $statement->bindParam(':passcode', $passcode);
				$statement->execute();
				$count = $statement->rowCount();

				if ($count > 0) {
					foreach ($statement as $row) {
						$dletd = $row['deletedx'];
						$sttzus = $row['ustatz'];
						$passcode_f = $row['passcode'];
					}

					if($dletd==1){
						echo '<div class="alert alert-danger alert-dismissible fade show">';
							echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
							echo 'Access denied! Please contact the support @ <a href="tel:'.$mobileno.'">'.$mobileno.'</a>';
						echo '</div>';
					}elseif($sttzus==0){
						echo '<div class="alert alert-danger alert-dismissible fade show">';
							echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
							echo 'Your account has been disabled! Please contact the support @ <a href="tel:'.$mobileno.'">'.$mobileno.'</a>';
						echo '</div>';
					}elseif($passcode_f!=$passcode){
						echo '<div class="alert alert-danger alert-dismissible fade show">';
							echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
							echo 'Incorrect Password.';
						echo '</div>';
					}else{
						$usercode = $row['usercode'];
						$fullname = $row['fullname'];
						$ulevpos = $row['ulevpos'];
						$surname = $row['lname'];
						$firstname = $row['fname'];
						$middlename = $row['mname'];
						$uposition = $row['xposition'];
						$email = $row['uemail'];
						$phone = $row['umobileno'];
						
						$_SESSION["usercode"] = $usercode;
						$_SESSION["username"] = $_POST["username"];
						$_SESSION["fullname"] = $fullname;
						$_SESSION["ulevpos"] = $ulevpos;

						$_SESSION["surname"] = $surname;
						$_SESSION["firstname"] = $firstname;
						$_SESSION["middlename"] = $middlename;
						$_SESSION["postitle"] = $uposition;
						$_SESSION["imglnkurl"] = $row['img_url'];
						$_SESSION["imglnkext"] = $row['extname'];

						$_SESSION["email"] = $email;
						$_SESSION["phone"] = $phone;

						$_SESSION["gogfirstime"] = $row['gogfirstime'];
						
						echo "<script>window.open('../../', '_self');</script>";
					}

				} else {
					echo '<div class="alert alert-danger alert-dismissible fade show">';
						echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
						echo 'You are not register.';
					echo '</div>';
				}
			}
		} else {
			echo "<p class='text-center'>Login to your account.</p>";
		}
	} catch (PDOException $error) {
		die('ERROR: ' . $exception->getMessage());
	}

	// Input Pattern
	// https://www.w3schools.com/tags/att_input_pattern.asp