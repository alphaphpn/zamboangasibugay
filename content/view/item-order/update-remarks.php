<?php

	try {
		$orderid = isset($_GET['orderid']) ? $_GET['orderid'] : die('ERROR: Record ID not found.');
		$remaks = isset($_GET['remaks']) ? $_GET['remaks'] : die('ERROR: Record ID not found.');

		include_once "../../../inc/core.php";
		include_once "../../../inc/srvr.php";
		$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
		$qry_update = "UPDATE tbl_order_customer SET 
			remarks		= '$remaks'
			WHERE 
			order_id	= '$orderid'
			";
		$cnn->exec($qry_update);

		echo '<script>window.open("../../../routes/item-order","_self");</script>';
	} catch (PDOException $exception) {
		die('ERROR: ' . $exception->getMessage());
	}