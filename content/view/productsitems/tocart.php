<?php

	try {
		$temidid = isset($_GET['itemid']) ? $_GET['itemid'] : '<script>window.open("../../../routes/productsitems/#productitemz","_self");</script>';
		$nowuid = isset($_GET['uid']) ? $_GET['uid'] : '<script>window.open("../../../routes/productsitems/#productitemz","_self");</script>';
		$nqty = isset($_GET['gqty']) ? $_GET['gqty'] : '<script>window.open("../../../routes/productsitems/#productitemz","_self");</script>';

		include_once "../../../inc/webconfig/conf.php";
		include_once "../../../inc/srvr.php";
		$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);

		$qry2 = "SELECT * FROM tbl_order_customer WHERE customer_id=:idcustomer AND remarks=:remarkx ORDER BY order_id DESC LIMIT 1";
		$stmt2 = $cnn->prepare($qry2);
		$idcustomer = $nowuid;
		$remarkx = 'Process';
		$stmt2->bindParam(':idcustomer', $idcustomer);
		$stmt2->bindParam(':remarkx', $remarkx);
		$stmt2->execute();
		$cnt2 = $stmt2->rowCount();

		if ($cnt2 > 0) {
			foreach ($stmt2 as $row2) {
				$orderid2 = $row2['order_id'];
			}

			$qry8 = "SELECT * FROM tbl_item WHERE item_id=:itemid8 AND deletedx=0 LIMIT 1";
			$stmt8 = $cnn->prepare($qry8);
			$itemid8 = $temidid;
			$stmt8->bindParam(':itemid8', $itemid8);
			$stmt8->execute();
			$cnt8 = $stmt8->rowCount();

			if ($cnt8 > 0) {
				foreach ($stmt8 as $row8) {
					$barcode8 = $row8['barcode'];
					$name8 = $row8['name'];
					$unit8 = $row8['unit'];
					$sellprice8 = $row8['sell_price'];
					$extnem8 = $row8['extnem'];

					$actualqty = $row8['stock_available'];
					if ($nqty > $actualqty) {
						$totalamt8 = $actualqty*$sellprice8;
						$nqty01 = $actualqty;
					} else {
						$totalamt8 = $nqty*$sellprice8;
						$nqty01 = $nqty;
					}
				}

				$qry9 = "SELECT * FROM tbl_order_item WHERE order_id=:orderid9 AND item_id=:itemid9 AND deleted=0 LIMIT 1";
				$stmt9 = $cnn->prepare($qry9);
				$orderid9 = $orderid2; // needed row from 1st
				$itemid9 = $temidid;
				$stmt9->bindParam(':orderid9', $orderid9);
				$stmt9->bindParam(':itemid9', $itemid9);
				$stmt9->execute();			
				$cnt9 = $stmt9->rowCount();

				if ($cnt9 > 0) {
					foreach ($stmt9 as $row9) {
						$itemorderid9 = $row9['item_order_id'];
						$fqty8 = $nqty;
						$fqty9 = $row9['qty'];		
						$fqty9plus = $fqty8+$fqty9;
						$totalamt9 = $fqty9plus*$sellprice8;
						$cstock9 = $row9['cstock'];
					}

					if ($fqty9plus>$cstock9) {
						$qry10 = "UPDATE tbl_order_item SET 
							qty			= '$cstock9', 
							total_amt	= '$totalamt9', 
							cstock		= '$cstock9'
							WHERE 
							item_order_id	= '$itemorderid9'
							";
						$cnn->exec($qry10);
						echo '<script>alert("Already exceed on available stock! '.$cstock9.'available."); window.open("../../../routes/productsitems/#productitemz","_self");</script>';
					} else {
						$qry10 = "UPDATE tbl_order_item SET 
							qty			= '$fqty9plus', 
							total_amt	= '$totalamt9', 
							cstock		= '$cstock9'
							WHERE 
							item_order_id	= '$itemorderid9'
							";
						$cnn->exec($qry10);
						echo '<script>alert("You have added quantity of '.$fqty8.' and a total quantity '.$fqty9plus.'"); window.open("../../../routes/productsitems/#productitemz","_self");</script>';
					}
				} else {
					$qry11 = "INSERT INTO tbl_order_item SET 
						order_id	= '$orderid9', 
						item_id		= '$itemid9', 
						barcode		= '$barcode8', 
						item_name	= '$name8', 
						qty			= '$nqty01', 
						unit		= '$unit8', 
						price		= '$sellprice8', 
						total_amt	= '$totalamt8', 
						extnem		= '$extnem8', 
						cstock		= '$actualqty', 
						theme_name	= '$themename'
						";
					$cnn->exec($qry11);
					echo '<script>alert("You have added new item to your cart"); window.open("../../../routes/productsitems/#productitemz","_self");</script>';
				}
			} else {
				echo '<script>alert("No available item."); window.open("../../../routes/productsitems/#productitemz","_self");</script>';
			}
		} else {
			$qryGetCUser = "SELECT * FROM tbl_sysuser WHERE usercode=:idcustomer45 LIMIT 1";
			$stmtGetCUser = $cnn->prepare($qryGetCUser);
			$idcustomer45 = $nowuid;
			$stmtGetCUser->bindParam(':idcustomer45', $idcustomer45);
			$stmtGetCUser->execute();
			$cntGetCUser = $stmtGetCUser->rowCount();

			if ($cntGetCUser > 0) {
				foreach ($stmtGetCUser as $rowGetCUser) {
					$clientname3 = $rowGetCUser["fullname"];
					$clientphone3 = $rowGetCUser["umobileno"];
					$clientemail3 = $rowGetCUser["uemail"];
					$clientaddress3 = $rowGetCUser["address"];
					$receivername3 = $rowGetCUser["fullname"];
					$receiverphone3 = $rowGetCUser["umobileno"];
					$receiveremail3 = $rowGetCUser["uemail"];
					$receiveraddress3 = $rowGetCUser["address"];

					if (empty($clientname3)) {
						echo '<script>alert("Update your profile! Name is required."); window.open("../../../routes/mprofile/#plname","_self")</script>';
					} elseif (empty($clientphone3)) {
						echo '<script>alert("Update your profile! Phone is required."); window.open("../../../routes/mprofile/#pmobilephone","_self")</script>';
					} elseif (empty($clientaddress3)) {
						echo '<script>alert("Update your profile! Address is required."); window.open("../../../routes/mprofile/#zaddress","_self")</script>';
					} else {
						$qry3 = "INSERT INTO tbl_order_customer SET 
							customer_id=:idcustomer3, 
							customer_name=:clientname, 
							phone=:clientphone, 
							cemail=:clientemail, 
							address=:clientaddress3, 
							receiver=:receivername, 
							receiver_phone=:receiverphone, 
							remail=:receiveremail, 
							d_location=:receiveraddress3, 
							remarks=:remarkx3, 
							status=:statuz3, 
							theme_name=:themename, 
							deleted=0
						";

						$stmt3 = $cnn->prepare($qry3);
						$idcustomer3 = $idcustomer45;
						$remarkx3 = 'Process';
						$statuz3 = 'Unpaid';
						$stmt3->bindParam(':idcustomer3', $idcustomer3);
						$stmt3->bindParam(':remarkx3', $remarkx3);
						$stmt3->bindParam(':statuz3', $statuz3);
						$stmt3->bindParam(':clientname', $clientname3);
						$stmt3->bindParam(':clientphone', $clientphone3);
						$stmt3->bindParam(':clientemail', $clientemail3);
						$stmt3->bindParam(':clientaddress3', $clientaddress3);
						$stmt3->bindParam(':receivername', $receivername3);
						$stmt3->bindParam(':receiverphone', $receiverphone3);
						$stmt3->bindParam(':receiveremail', $receiveremail3);
						$stmt3->bindParam(':receiveraddress3', $receiveraddress3);
						$stmt3->bindParam(':themename', $themename);
						$stmt3->execute();
						echo '<script>alert("Added new transaction."); window.open("../../../routes/productsitems/#productitemz","_self");</script>';

						$qry7 = "SELECT * FROM tbl_order_customer WHERE customer_id=:idcustomer7 AND remarks=:remarkx7 AND status=:statuz7 AND deleted=0 ORDER BY order_id DESC LIMIT 1";
						$stmt7 = $cnn->prepare($qry7);
						$idcustomer7 = $nowuid;
						$remarkx7 = 'Process';
						$statuz7 = 'Unpaid';
						$stmt7->bindParam(':idcustomer7', $idcustomer7);
						$stmt7->bindParam(':remarkx7', $remarkx7);
						$stmt7->bindParam(':statuz7', $statuz7);
						$stmt7->execute();
						$cnt7 = $stmt7->rowCount();

						if ($cnt7 > 0) {
							foreach ($stmt7 as $row7) {
								$orderid7 = $row7['order_id'];
							}

							$qry6 = "SELECT * FROM tbl_item WHERE item_id=:itemid6 AND deletedx=0 LIMIT 1";
							$stmt6 = $cnn->prepare($qry6);
							$itemid6 = $temidid;
							$stmt6->bindParam(':itemid6', $itemid6);
							$stmt6->execute();
							$cnt6 = $stmt6->rowCount();

							if ($cnt6 > 0) {
								foreach ($stmt6 as $row6) {
									$orderid6 = $orderid7;
									$barcode6 = $row6['barcode'];
									$name6 = $row6['name'];
									$unit6 = $row6['unit'];
									$fqty6 = $nqty;
									$sellprice6 = $row6['sell_price'];
									$extnem6 = $row6['extnem'];

									$actualqty6 = $row6['stock_available'];
									if ($fqty6 > $actualqty6) {
										$totalamt6 = $sellprice6*$actualqty6;
										$sulodqty = $actualqty6;
									} else {
										$totalamt6 = $sellprice6*$fqty6;
										$sulodqty = $fqty6;
									}

									$cstock6 = $row6['stock_available'];
								}

								$qry5 = "INSERT INTO tbl_order_item SET 
									order_id	= '$orderid6', 
									item_id		= '$itemid6', 
									barcode		= '$barcode6', 
									item_name	= '$name6', 
									qty			= '$sulodqty', 
									unit		= '$unit6', 
									price		= '$sellprice6', 
									total_amt	= '$totalamt6', 
									extnem		= '$extnem6', 
									cstock		= '$cstock6', 
									theme_name	= '$themename'
									";
								$cnn->exec($qry5);
								echo '<script>window.open("../../../routes/productsitems/","_self");</script>';
							} else {
								echo '<script>window.open("../../../routes/productsitems/","_self");</script>';
							}
						} else {
							echo '<script>window.open("../../../routes/productsitems/","_self");</script>';
						}
						echo '<script>window.open("../../../routes/productsitems/","_self");</script>';
					}
				}
			}
		}
	} catch (PDOException $exception) {
		die('ERROR: ' . $exception->getMessage());
	}