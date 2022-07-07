<?php

	$useremail = isset($_GET['usermail']) ? $_GET['usermail'] : header('Location:../../');
	$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);

	try {
		if (isset($_POST["btnSecQuest"])) {
			if (empty($_POST["hsecquest"]) || empty($_POST["secansw"]) || empty($_POST["entpasscode"])) {
				echo '<div class="alert alert-danger alert-dismissible fade show">';
					echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
					echo 'Empty field not allowed.';
				echo '</div>';
			} else {
				$query = "SELECT * FROM tbl_sysuser WHERE ustatz=1 AND uemail=:useremail LIMIT 1";
				$stmt = $cnn->prepare($query);
				$stmt->bindValue(":useremail", $useremail);
				$stmt->execute();
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$num = $stmt->rowCount();

				if ($num>0) {
					$hsecquest = $_POST["hsecquest"];
					$secansw = $_POST["secansw"];

					$hsecquest1 = $row["secquest"];
					$secansw1 = $row["secans"];
					$usercodex = $row["usercode"];

					if (empty($hsecquest1) || empty($secansw1)) {
						echo '<script>alert("You have not set your security question.")</script>';
					} elseif ($hsecquest === $hsecquest || $secansw === $secansw1) {
						$updateqry = "UPDATE tbl_sysuser SET passcode=:passcode2x, gogfirstime=0 WHERE usercode=:usercodex";
						$stmt_updte = $cnn->prepare($updateqry);
						$passcode2x = md5(trim($_POST["entpasscode"]));
						$stmt_updte->bindParam(":usercodex", $usercodex);
						$stmt_updte->bindParam(":passcode2x", $passcode2x);

						if ($stmt_updte->execute()) {
							echo '<div class="alert alert-info alert-dismissible fade show">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo 'Password changed. <a href="../../inc/logout">Logout</a> to test your new password.';
							echo '</div>';
						} else {
							echo '<div class="alert alert-danger alert-dismissible fade show">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo 'Unable to update password.';
							echo '</div>';
						}
					} else {
						echo '<div class="alert alert-warning alert-dismissible fade show">';
							echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
							echo 'Access denied!';
						echo '</div>';
					}
				}
			}
		}
	}  catch (PDOException $error) {
		die('ERROR: ' . $exception->getMessage());
	}