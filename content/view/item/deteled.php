<?php

	$tblname = "tblitem";
	$prim_id = "item_id";
	include_once "../../../inc/core.php";
	include_once "../../../inc/srvr.php";
	$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);

	try {
		$upidid = isset($_GET['upidid']) ? $_GET['upidid'] : die('ERROR: Record ID not found.');

		$qry = "UPDATE {$tblname} SET deletedx = 1 WHERE {$prim_id}=:upidid";
		$stmt = $cnn->prepare($qry);
		$stmt->bindParam(':upidid', $upidid);
		if ($stmt->execute()) {
			header('Location:../../../routes/item/?action=deleted&upidid='.$upidid);
		} else {
			die('Unable to delete record.');
		}
	} catch (PDOException $exception) {
		die('ERROR: ' . $exception->getMessage());
	}