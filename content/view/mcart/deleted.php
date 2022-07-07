<?php

	$tblname = "tbl_order_item";
	$prim_id = "item_order_id";
	include_once "../../../inc/core.php";
	include_once "../../../inc/srvr.php";
	$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);

	try {
		$itoid = isset($_GET['itoid']) ? $_GET['itoid'] : die('ERROR: Record ID not found.');
		$xno = isset($_GET['xno']) ? $_GET['xno'] : die('ERROR: Record ID not found.');

		$qry_nameitem = "SELECT * FROM {$tblname} WHERE {$prim_id}=:itoid2 LIMIT 1";
		$stmt_nameitem = $cnn->prepare($qry_nameitem);
		$stmt_nameitem->bindParam(':itoid2', $itoid);
		$stmt_nameitem->execute();
		$numnameitem = $stmt_nameitem->rowCount();

		if ($numnameitem>0) {
			foreach ($stmt_nameitem as $rownameitem) {
				$itemname = $rownameitem['item_name'];
			}

			$qry = "DELETE FROM {$tblname} WHERE {$prim_id}=:itoid";
			$stmt = $cnn->prepare($qry);
			$stmt->bindParam(':itoid', $itoid);
			if ($stmt->execute()) {
				header('Location:../../../routes/mcart/?action=deleted&xno='.$xno.'&itemname='.$itemname);
			} else {
				echo "<script>window.location = '../../../';</script>";
				// die('Unable to delete record.');
			}
		} else {
			echo "<script>window.location = '../../../';</script>";
			// die('Unable to delete record.');
		}
	} catch (PDOException $exception) {
		die('ERROR: ' . $exception->getMessage());
		// echo "<script>window.location = '../../../';</script>";
	}