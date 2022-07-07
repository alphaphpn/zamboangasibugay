<?php

	if(empty($_SESSION["usercode"])) {
		header("location:../../");
	} else {
		$curr_uidzer = trim($_SESSION["usercode"]);
	}

	try {
		if (isset($_POST["btnSubmit"])) {
			if (empty($_POST["passcode1"]) || empty($_POST["passcode2"])) {
				echo '<div class="alert alert-danger alert-dismissible fade show">';
					echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
					echo 'Empty field not allowed.';
				echo '</div>';
			} else {
				$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
				$query = "SELECT * FROM tbl_sysuser WHERE ustatz=1 AND usercode=:curr_uidzer LIMIT 1";
				$stmt = $cnn->prepare($query);
				$stmt->bindValue(":curr_uidzer", $curr_uidzer);
				$stmt->execute();
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$num = $stmt->rowCount();

				if ($num>0) {
					if ($_POST["passcode1"] === $_POST["passcode2"]) {
						$updateqry = "UPDATE tbl_sysuser SET passcode=:passcode2x, gogfirstime=0 WHERE usercode=:curr_uidzer";
						$stmt_updte = $cnn->prepare($updateqry);
						$passcode2x = md5(trim($_POST["passcode2"]));
						$stmt_updte->bindParam(":curr_uidzer", $curr_uidzer);
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
							echo 'New password mismatch.';
						echo '</div>';
					}
				}
			}
		}
	}  catch (PDOException $error) {
		die('ERROR: ' . $exception->getMessage());
	}