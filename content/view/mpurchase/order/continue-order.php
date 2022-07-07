<?php

	$tblname = "tbl_order_customer";
	$prim_id = "order_id";
	include_once "../../../../inc/core.php";
	include_once "../../../../inc/srvr.php";
	$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);

	try {
		$orderid = isset($_GET['orderid']) ? $_GET['orderid'] : die('ERROR: Record ID not found.');
		$canelc = 'Unpaid';

		$qry_update = "UPDATE {$tblname} SET status = '$canelc' WHERE {$prim_id} = '$orderid'";
		$cnn->exec($qry_update);

		echo '<script>window.open("../../../../routes/mpurchase/order?orderid='.$orderid.'","_self");</script>';
	} catch (PDOException $exception) {
		die('ERROR: ' . $exception->getMessage());
		// echo "<script>window.location = '../../../';</script>";
	}