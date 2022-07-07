<?php

	try {
		$chidx = isset($_GET['chid']) ? $_GET['chid'] : die('ERROR: Record ID not found.');

		include_once "../../../inc/core.php";
		include_once "../../../inc/srvr.php";
		$cnn_remx = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
		$qry_remx = "UPDATE tbl_order_customer SET remarks=:order_remzx WHERE order_id=:ordrcridx";
		$stmt_remx = $cnn_remx->prepare($qry_remx);
		$ordrcridx = $chidx;
		$order_remzx = 'Checkout';
		$stmt_remx->bindParam(':ordrcridx', $ordrcridx);
		$stmt_remx->bindParam(':order_remzx', $order_remzx);
		if ($stmt_remx->execute()) {
			echo "<script>alert('Successfully checkout. OrderID:[".$chidx."] Kindly monitor your email/phone for instruction of the payment. Thank you');window.location=('../../../routes/mpurchase/#purchase');</script>";
		} else {
			echo "<script>alert('Unable to checkout record. OrderID:[".$chidx."]');</script>";
			die('Unable to checkout record.');
			header('Location:../../../routes/mcart/#cart');
		}
	} catch (PDOException $exception) {
		die('ERROR: ' . $exception->getMessage());
	}