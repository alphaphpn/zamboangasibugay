<?php

	try {
		$chidr = isset($_GET['chid']) ? $_GET['chid'] : die('ERROR: Record ID not found.');
		$rcvrer = isset($_GET['rcvrer']) ? $_GET['rcvrer'] : die('ERROR: Record ID not found.');
		$rcvrerphn = isset($_GET['rcvrerphn']) ? $_GET['rcvrerphn'] : die('ERROR: Record ID not found.');
		$adrex2 = isset($_GET['adrex2']) ? $_GET['adrex2'] : die('ERROR: Record ID not found.');
		$rcremail = isset($_GET['rcremail']) ? $_GET['rcremail'] : die('ERROR: Record ID not found.');

		include_once "../../../inc/core.php";
		include_once "../../../inc/srvr.php";
		$cnn_cvr = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
		$qry_cvr = "UPDATE tbl_order_customer SET remarks=:order_remzr, receiver=:namerecepient, receiver_phone=:phonerecepient, remail=:emailrecepient, d_location=:addressrecepient WHERE order_id=:ordrcridr";
		$stmt_cvr = $cnn_cvr->prepare($qry_cvr);
		$ordrcridr = $chidr;
		$order_remzr = 'Checkout';

		$name_recepient = $rcvrer;
		$phone_recepient = $rcvrerphn;
		$address_recepient = $adrex2;
		$email_recepient = $rcremail;

		$stmt_cvr->bindParam(':ordrcridr', $ordrcridr);
		$stmt_cvr->bindParam(':order_remzr', $order_remzr);

		$stmt_cvr->bindParam(':namerecepient', $name_recepient);
		$stmt_cvr->bindParam(':phonerecepient', $phone_recepient);
		$stmt_cvr->bindParam(':addressrecepient', $address_recepient);
		$stmt_cvr->bindParam(':emailrecepient', $email_recepient);
		if ($stmt_cvr->execute()) {
			echo "<script>alert('Successfully checkout. OrderID:[".$ordrcridr."] Kindly monitor your email/phone for instruction of the payment or you may reach thru this number ".$phone_recepient.". Thank you');window.location=('../../../routes/mpurchase/#purchase');</script>";
			// header('Location:../../../routes/mpurchase');
		} else {
			echo "<script>alert('Unable to checkout record. OrderID:[".$chidr."]');</script>";
			die('Unable to checkout record.');
			header('Location:../../../routes/mcart/#cart');
		}
	} catch (PDOException $exception) {
		die('ERROR: ' . $exception->getMessage());
	}