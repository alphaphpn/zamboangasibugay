<?php

	try {
		$itmordid = isset($_GET['itmordid']) ? $_GET['itmordid'] : header('../../../routes/mcart/');
		$zqty = isset($_GET['zqty']) ? $_GET['zqty'] : 1;
		$itemid = isset($_GET['itemid']) ? $_GET['itemid'] : header('../../../routes/mcart/');

		if ($zqty==0) {
			$zqty = 1;
		}

		include_once "../../../inc/core.php";
		include_once "../../../inc/srvr.php";
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
			}

			$qryrealqty = "SELECT * FROM tblitem WHERE item_id=:itemid AND deletedx=0 LIMIT 1";
			$stmtrealqty = $cnn->prepare($qryrealqty);
			$stmtrealqty->bindParam(':itemid', $itemid);
			$stmtrealqty->execute();
			$cntrealqty = $stmtrealqty->rowCount();

			if ($cntrealqty > 0) {
				foreach ($stmtrealqty as $rowrealqty) {
					$realqty = $rowrealqty['stock_available'];

					if ($zqty > $realqty) {
						$totalamt = $realqty * $sellprice;
						$actualyqty = $realqty;
					} else {
						$totalamt = $zqty * $sellprice;
						$actualyqty = $zqty;
					}
				}

				$qry_update = "UPDATE tbl_order_item SET 
					qty			= '$actualyqty', 
					total_amt	= '$totalamt'
					WHERE 
					item_order_id	= '$itmordid'
					";
				$cnn->exec($qry_update);
				echo '<script>window.open("../../../routes/mcart/","_self");</script>';
			} else {
				echo '<script>window.open("../../../routes/mcart/","_self");</script>';
			}
		} else {
			echo '<script>window.open("../../../routes/mcart/","_self");</script>';
		}
	} catch (PDOException $exception) {
		die('ERROR: ' . $exception->getMessage());
	}