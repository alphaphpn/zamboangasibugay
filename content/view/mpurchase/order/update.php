<?php

	try {
		$itmordid = isset($_GET['itmordid']) ? $_GET['itmordid'] : die('ERROR: Record ID not found.');
		$zqty = isset($_GET['zqty']) ? $_GET['zqty'] : 1;

		if ($zqty==0) {
			$zqty = 1;
		}

		include_once "../../../../inc/core.php";
		include_once "../../../../inc/srvr.php";
		$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);

		$qry = "SELECT * FROM tbl_order_item WHERE item_order_id=:itemorderid LIMIT 1";
		$stmt = $cnn->prepare($qry);
		$stmt->bindParam(':itemorderid', $itmordid);
		$stmt->execute();			
		$cnt = $stmt->rowCount();

		if ($cnt > 0) {
			foreach ($stmt as $row) {
				$sellprice = $row['price'];
				$cstock = $row['cstock'];
				$orderid = $row['order_id'];
			}

			$totalamt = $zqty * $sellprice;

			$qry_update = "UPDATE tbl_order_item SET 
				qty			= '$zqty', 
				total_amt	= '$totalamt'
				WHERE 
				item_order_id	= '$itmordid'
				";
			$cnn->exec($qry_update);
		}

		echo '<script>window.open("../../../../routes/mpurchase/order/?orderid='.$orderid.'","_self");</script>';
	} catch (PDOException $exception) {
		die('ERROR: ' . $exception->getMessage());
	}