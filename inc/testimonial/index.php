<?php
	
	try {
		if (isset($_POST["btnTestimon"])) {
			echo $_POST["testimonialy"];
			if (empty($_POST["testimonialy"]) || empty($_POST["cmpnyposition"]) || empty($_POST["cmpnyid"]) || empty($_POST["ucersode"])) {
				echo '<div class="alert alert-danger alert-dismissible fade show">';
					echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
					echo 'Empty fiels not allowed!';
				echo '</div>';
			} else {
				include_once "../../inc/srvr.php";
				$cnn_comtest = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
				$karonuserid = $_POST['ucersode'];
				$testimonialy = $_POST['testimonialy'];
				$cmpnyposition = $_POST['cmpnyposition'];
				$cmpnyid = $_POST['cmpnyid'];
				$qry_comtest = "UPDATE tbl_sysuser SET 
					testimony			= '$testimonialy', 
					cmpny				= '$cmpnyid', 
					cmpny_position		= '$cmpnyposition'
					WHERE usercode		= '$karonuserid' ";
				$cnn_comtest->exec($qry_comtest);

				$err_msg = "Your testimony is successfully saved: ".$testimonialy;
				echo "<script>alert('".$err_msg."');</script>";
			}
		}
	} catch (PDOException $error) {
		die('ERROR: ' . $error->getMessage());
	}

?>