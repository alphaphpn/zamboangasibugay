<?php

	try {
		$orderid = isset($_GET['orderid']) ? $_GET['orderid'] : die('ERROR: Record ID not found.');
		$status = isset($_GET['status']) ? $_GET['status'] : die('ERROR: Record ID not found.');

		include_once "../../../inc/core.php";
		include_once "../../../inc/srvr.php";
		$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);

		$qry_porder = "SELECT * FROM tbl_order_customer WHERE order_id=:orderid LIMIT 1";
		$stmt_porder = $cnn->prepare($qry_porder);
		$stmt_porder->bindParam(':orderid', $orderid);
		$stmt_porder->execute();
		$numporder = $stmt_porder->rowCount();

		if ($numporder>0) {
			foreach ($stmt_porder as $proworder) {
				$datecreatedz = $proworder['created'];
				$frmtdtzx = date("Ymd", strtotime($datecreatedz));;
			}
		}

		$recptnom = 'OR'.$frmtdtzx.$orderid;

		if ( $status == 'Paid' ) {
			$qry_update = "UPDATE tbl_order_customer SET 
				receipt_no	= '$recptnom', 
				status		= '$status'
				WHERE 
				order_id	= '$orderid'
				";
			$cnn->exec($qry_update);
		} else {
			$qry_update = "UPDATE tbl_order_customer SET 
				receipt_no	= 'n/a', 
				status		= '$status'
				WHERE 
				order_id	= '$orderid'
				";
			$cnn->exec($qry_update);
		}

		echo '<script>window.open("../../../routes/item-order","_self");</script>';
	} catch (PDOException $exception) {
		die('ERROR: ' . $exception->getMessage());
	}