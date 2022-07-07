<?php

	$tblname = "tbl_order_customer";
	$prim_id = "order_id";
	include_once "../../../inc/core.php";
	include_once "../../../inc/srvr.php";
	include_once "../../../inc/cnndb.php";

	try {
		$orderid = isset($_GET['orderid']) ? $_GET['orderid'] : die('ERROR: Record ID not found.');

		$qry = "UPDATE {$tblname} SET deleted = 1 WHERE {$prim_id} = :orderid";
		$stmt = $cnn->prepare($qry);
		$stmt->bindParam(':orderid', $orderid);
		if ($stmt->execute()) {
			header('Location:../../../routes/item-order/?action=deleted&orderid='.$orderid);
		} else {
			die('Unable to delete record.');
		}
	} catch (PDOException $exception) {
		die('ERROR: ' . $exception->getMessage());
	}