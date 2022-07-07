<?php
	include_once "../../content/theme/".$themename."/frontend-navbar.php";
	include_once "../../content/theme/".$themename."/slick-home-banner.php";

	$cnn_order = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
	$qry_order = "SELECT * FROM tbl_order_customer WHERE theme_name=:themename AND customer_id=:customeer_id AND remarks=:processed ORDER BY order_id DESC LIMIT 1";
	$stmt_order = $cnn_order->prepare($qry_order);
	$customeer_id = $_SESSION["usercode"];
	$processed = 'Process';
	$stmt_order->bindParam(':customeer_id', $customeer_id);
	$stmt_order->bindParam(':processed', $processed);
	$stmt_order->bindParam(':themename', $themename);
	$stmt_order->execute();
	$numorder = $stmt_order->rowCount();

	if ($numorder>0) {
		foreach ($stmt_order as $roworder) {
			$curr_ordr_id = $roworder['order_id'];
		}
	} else {
		echo "<script>alert('Add your item to cart now!'); window.location = '../../#productitemz';</script>";
	}

	$cnn_ouser = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
	$qry_ouser = "SELECT * FROM tbl_sysuser WHERE usercode=:ocustomeer_id LIMIT 1";
	$stmt_ouser = $cnn_ouser->prepare($qry_ouser);
	$ocustomeer_id = $_SESSION["usercode"];
	$stmt_ouser->bindParam(':ocustomeer_id', $ocustomeer_id);
	$stmt_ouser->execute();
	$onumorder = $stmt_ouser->rowCount();

	if ($onumorder>0) {
		foreach ($stmt_ouser as $oroworder) {
			$ogreceiver = $oroworder['fullname'];
			$ogreceiverphone = $oroworder['umobileno'];
			$ogremail = $oroworder['uemail'];
			$ogdlocation = $oroworder['address'];
		}
	} else {
		echo "<script>window.location = '../../#productitemz';</script>";
	}
?>

<link rel="stylesheet" href="../../assets/datatables/1.11.3/css/jquery.dataTables.min.css">
<script src="../../assets/datatables/1.11.3/js/jquery.dataTables.min.js"></script>

<div class="pt-5 pb-5">
	<div class="container">
		<div id="cart" class="card">
			<div class="card-header">
				<label>Cart [Order#: <?php echo $curr_ordr_id; ?>]</label>
				<div class="float-right">
					<a href="">Refresh</a>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table id="listRecView9" class="table table-striped table-hover">
						<thead>
							<tr>
								<th>No.</th>
								<th class="d-none">Item ID</th>
								<th class="d-none">Barcode</th>
								<th colspan="2">Item</th>
								<th>Qty</th>
								<th>Unit</th>
								<th>Price</th>
								<th>Total</th>
								<th class="d-none">Modified</th>
								<th class="d-none">Created</th>
								<th class="d-none">Ctrl#</th>
								<th class="text-right">Action</th>
							</tr>
						</thead>

						<tbody>
							<?php
								$tblname = "tbl_order_item";
								$prim_id = "item_order_id";
								$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
								$qry = "SELECT * FROM {$tblname} WHERE order_id=:order_id ORDER BY {$prim_id} DESC";
								$stmt = $cnn->prepare($qry);
								$order_id = $curr_ordr_id;
								$stmt->bindParam(':order_id', $order_id);
								$stmt->execute();
								$cntme = $stmt->rowCount();
								$xno = 0;

								if ($cntme > 0) {

								} else {
									echo '<script>window.location=("../../");</script>';
								}

								for($i=0; $row = $stmt->fetch(); $i++) {
									$xno++;
									$item_id=$row['item_id'];
									$barcode=$row['barcode'];
									$extnem=$row['extnem'];
									$img_item='../../content/theme/'.$themename.'/storage/img/item/ITEM'.$item_id.'.'.$extnem;
									$item_name=$row['item_name'];

									$qty=$row['qty'];
									$unit=$row['unit'];
									$price=$row['price'];
									$total_amt=$row['total_amt'];
									$cstock=$row['cstock'];

									$modified2=$row['modified'];
									$modified=date_format(new DateTime($modified2),'Y/m/d');
									$created2=$row['created'];
									$created=date_format(new DateTime($created2),'Y/m/d');
									$id2=$row['item_order_id'];
							?>

									<tr>
										<td><?php echo $xno; ?></td>
										<td class="d-none" data-filter="<?php echo $item_id; ?>"><?php echo $item_id; ?></td>
										<td class="d-none" data-filter="<?php echo $barcode; ?>"><?php echo $barcode; ?></td>
										<td data-filter="<?php echo $img_item; ?>"><img class="w-30px" src="<?php echo $img_item; ?>"></td>
										<td data-filter="<?php echo $item_name; ?>"><?php echo $item_name; ?></td>
										<td data-filter="<?php echo $qty; ?>">
											<input type="number" id="qtyedit<?php echo $id2; ?>" name="qty_edit" class="qty_edit none-zero-input" value="<?php echo $qty; ?>" onchange="fnChangeQty(<?php echo $id2; ?>,this.value,<?php echo $item_id; ?>)" step="1" min="1" max="<?php echo $cstock; ?>"  onkeydown="if(event.key==='.'){event.preventDefault();}" oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');">
										</td>
										<td data-filter="<?php echo $unit; ?>"><?php echo $unit; ?></td>
										<td data-filter="<?php echo $price; ?>"><?php echo $dcurrencyx.number_format($price,2); ?></td>
										<td data-filter="<?php echo $total_amt; ?>"><?php echo $dcurrencyx; ?><span data-value="<?php echo $total_amt; ?>" id="ttamt<?php echo $id2; ?>"><?php echo number_format($total_amt,2); ?></span></td>
										<td class="d-none" data-filter="<?php echo $modified; ?>"><?php echo $modified; ?></td>
										<td class="d-none" data-filter="<?php echo $created; ?>"><?php echo $created; ?></td>
										<td class="d-none"><?php echo $id2; ?></td>
										<td class="text-right tbl-action">
											<a class="btn-sm btn-dark btn-inline ml-1" href="#" onclick="trash(<?php echo $id2.','.$xno; ?>)" title="Delete">
												<span class="fas fa-trash-alt"></span>
											</a>
										</td>
									</tr>
							<?php
								}
							?>
						</tbody>
						<tfoot>
						<?php
							$cnn_sbtotal = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
							$qry_sbtotal = "SELECT SUM(total_amt) AS subtotal, COUNT(*) AS total_rows, SUM(qty) AS total_qty FROM tbl_order_item WHERE order_id=:order_id2";
							$stmt_sbtotal = $cnn_sbtotal->prepare($qry_sbtotal);
							$order_id2 = $curr_ordr_id;
							$stmt_sbtotal->bindParam(':order_id2', $order_id2);
							$stmt_sbtotal->execute();
							$row_sbtotal = $stmt_sbtotal->fetch(PDO::FETCH_ASSOC);
							$sbtotztal = $row_sbtotal['subtotal'];
							$sbtotalrows = $row_sbtotal['total_rows'];
							$sbtotalqty = $row_sbtotal['total_qty'];
						?>
							<tr>
								<td><?php echo $sbtotalrows; ?></td>
								<td class="d-none"></td>
								<td class="d-none"></td>
								<td colspan="2"></td>
								<td><?php echo $sbtotalqty; ?></td>
								<td colspan="2">Sub-Total:</td>
								<td><?php echo $dcurrencyx; ?><span id="allsubtotal" data-value="<?php echo $sbtotztal; ?>"><?php echo number_format($sbtotztal,2); ?></span></td>
								<td></td>
							</tr>
						<?php
							
							$ordr_crid = $order_id2;
							$order_subttl = $sbtotztal;
							$order_totalrows = $sbtotalrows;
							$order_totalqty = $sbtotalqty;
							$cnn_ins_sum = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
							$qry_ins_sum = "UPDATE tbl_order_customer SET 
								sub_total			= '$order_subttl', 
								sub_total_qty		= '$order_totalqty', 
								sub_total_item		= '$order_totalrows'
								WHERE order_id		= '$ordr_crid' ";
							$cnn_ins_sum->exec($qry_ins_sum);
						?>
						</tfoot>
					</table>
				</div>
			</div>
			<div class="card-footer">
				<div class="row">
					<div class="col-sm-6 mb-2">
						<?php
							$action = isset($_GET['action']) ? $_GET['action'] : "";
							$xno = isset($_GET['xno']) ? $_GET['xno'] : "";
							$itemname = isset($_GET['itemname']) ? $_GET['itemname'] : "";
							if ($action=='deleted') {
								echo "<div class='alert alert-danger alert-dismissible mb-0 fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button>You have deleted a record. No.:[{$xno}] Product: {$itemname}</div>";
							}
						?>
					</div>
					<div class="col-sm-6 mb-2 text-right">
						<a href="../../" class="text-dark text-decoration-none">
							<i>&#8592;</i> Back to Homepage
						</a>
						<?php
							if (empty($curr_ordr_id)) {
						
							} else {
						?>
							<a href="#" class="btn btn-danger" data-toggle="modal" data-target="#ymModalChekAwt">
								<i class='fas fa-cart-plus'></i> Checkout
							</a>
						<?php
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal" id="ymModalChekAwt">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Receiver/Recepient Details</h4>
				<button type="button" class="close text-right mr-1" data-dismiss="modal">&times;</button>
			</div>

			<div class="modal-body">
				<form class="needs-validation" novalidate>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text">Receiver *</span>
						</div>
						<input id="receiver" type="text" class="form-control" placeholder="Receiver" name="receiver" value="<?php echo $ogreceiver; ?>" list="receiverList" required autofocus>
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
						<datalist id="receiverList">
						<?php
							$stmtReceiver = $cnn->prepare("SELECT * FROM tbl_order_customer WHERE customer_id=:cstmrid GROUP BY receiver ORDER BY receiver ASC");
							$cstmrid = $_SESSION["usercode"];
							$stmtReceiver->bindParam(':cstmrid', $cstmrid);
							$stmtReceiver->execute();
							$resultReceiver = $stmtReceiver->setFetchMode(PDO::FETCH_ASSOC);
							foreach ($stmtReceiver as $rowReceiver) {
								$receiver = $rowReceiver['receiver'];
								echo "<option value='".$receiver."'>";
							}
						?>
						</datalist>
					</div>

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text">Phone *</span>
						</div>
						<input id="rphone" type="tel" class="form-control" placeholder="Phone" name="rphone" value="<?php echo $ogreceiverphone; ?>" list="rphoneList" required autofocus>
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
						<datalist id="rphoneList">
						<?php
							$stmtRPhone = $cnn->prepare("SELECT * FROM tbl_order_customer WHERE customer_id=:cstmridr GROUP BY receiver_phone ORDER BY receiver_phone ASC");
							$cstmridr = $_SESSION["usercode"];
							$stmtRPhone->bindParam(':cstmridr', $cstmridr);
							$stmtRPhone->execute();
							$resultRPhone = $stmtRPhone->setFetchMode(PDO::FETCH_ASSOC);
							foreach ($stmtRPhone as $rowRPhone) {
								$receiverphone = $rowRPhone['receiver_phone'];
								echo "<option value='".$receiverphone."'>";
							}
						?>
						</datalist>
					</div>

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text">E-mail</span>
						</div>
						<input id="remail" type="email" class="form-control" placeholder="E-mail" name="remail" value="<?php echo $ogremail; ?>" list="remailList">
						<datalist id="remailList">
						<?php
							$stmtREmail = $cnn->prepare("SELECT * FROM tbl_order_customer WHERE customer_id=:cstmride GROUP BY remail ORDER BY remail ASC");
							$cstmride = $_SESSION["usercode"];
							$stmtREmail->bindParam(':cstmride', $cstmride);
							$stmtREmail->execute();
							$resultREmail = $stmtREmail->setFetchMode(PDO::FETCH_ASSOC);
							foreach ($stmtREmail as $rowREmail) {
								$remail = $rowREmail['remail'];
								echo "<option value='".$remail."'>";
							}
						?>
						</datalist>
					</div>

					<div class="form-group">
						<label for="ship-address">Receiver/Recepient Address *</label>
						<input id="ship-address" type="text" class="form-control" placeholder="Search address" name="ship-address" list="locationList" required autofocus>
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
						<datalist id="locationList">
						<?php
							// $stmtLocAddrs = $cnn->prepare("SELECT * FROM vw_address ORDER BY purok, barangay, municipality_town, zipostal_code, districtno, province, abrv, island_archipelago, country, continent ASC");

							$stmtLocAddrs = $cnn->prepare("SELECT `tbl_address_prk`.`prk_id` AS `prk_id`,`tbl_address_prk`.`purok` AS `purok`,`tbl_address_brgy`.`barangay` AS `barangay`,`tbl_address_city_town`.`municipality_town` AS `municipality_town`,`tbl_address_city_town`.`zipostal_code` AS `zipostal_code`,`tbl_address_city_town`.`districtno` AS `districtno`,`tbl_address_province`.`province` AS `province`,`tbl_address_region`.`abrv` AS `abrv`,`tbl_address_island`.`island_archipelago` AS `island_archipelago`,`tbl_address_country`.`country` AS `country`,`tbl_address_continent`.`continent` AS `continent` FROM (((((((`tbl_address_prk` JOIN `tbl_address_brgy` ON(`tbl_address_prk`.`brgy_id` = `tbl_address_brgy`.`brgy_id`)) JOIN `tbl_address_city_town` ON(`tbl_address_brgy`.`town_id` = `tbl_address_city_town`.`town_id`)) JOIN `tbl_address_province` ON(`tbl_address_city_town`.`province_id` = `tbl_address_province`.`province_id`)) JOIN `tbl_address_region` ON(`tbl_address_province`.`region_id` = `tbl_address_region`.`region_id`)) JOIN `tbl_address_island` ON(`tbl_address_region`.`island_code` = `tbl_address_island`.`island_code`)) JOIN `tbl_address_country` ON(`tbl_address_island`.`country_id` = `tbl_address_country`.`country_id`)) JOIN `tbl_address_continent` ON(`tbl_address_country`.`continent_code` = `tbl_address_continent`.`continent_code`)) ORDER BY purok, barangay, municipality_town, zipostal_code, districtno, province, abrv, island_archipelago, country, continent ASC");

							$stmtLocAddrs->execute();
							$resultLocAddrs = $stmtLocAddrs->setFetchMode(PDO::FETCH_ASSOC);
							foreach ($stmtLocAddrs as $rowLocAddrs) {
								$purok = $rowLocAddrs['purok'];
								$brgy = $rowLocAddrs['barangay'];
								$town = $rowLocAddrs['municipality_town'];
								$zcode = $rowLocAddrs['zipostal_code'];
								$districtno = $rowLocAddrs['districtno'];
								$province = $rowLocAddrs['province'];
								$region = $rowLocAddrs['abrv'];
								$island = $rowLocAddrs['island_archipelago'];
								$country = $rowLocAddrs['country'];
								$continent = $rowLocAddrs['continent'];
								$clocationz = $purok.', '.$brgy.', '.$town.' '.$zcode.', District-'.$districtno.', '.$province.', '.$region.', '.$island.', '.$country.', '.$continent;
								echo "<option value='".$clocationz."'>";
							}
						?>
						</datalist>
					</div>

					<div class="form-group">
						<label for="address2">Street, apartment, unit, suite, landmark or floor# *</label>
						<input id="address2" type="text" class="form-control" placeholder="Street, apartment, unit, suite, landmark or floor#" name="address2" required autofocus>
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>

					<div class="form-group">
						<label class="default-address">Default Address: <span class="text-primary"><a href="../../routes/mprofile/#updaddress">(Change Default Address)</a></span></label>
						<p><?php echo $ogdlocation; ?></p>
					</div>
					
					<div class="form-group text-right">
						<input type="reset" value="Default" class="btn btn-info btn-sm m-2">
						<button type="button" id="btnSaveChekAwt" onclick="fnGetReceiver(<?php echo $curr_ordr_id; ?>);return false;" class="btn btn-secondary btn-sm m-2">Update Receiver</button>
						<button type="button" id="btnSameReceiver" onclick="fnCheckOut(<?php echo $curr_ordr_id; ?>);return false;" class="btn btn-primary btn-sm m-2">Proceed to checkout</button>
						<button type="button" id="clzedanger" name="btnClozex" class="btn btn-danger btn-sm m-2" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
	if ( empty($geomap) ) {
		echo "<p align='center'>Can't Load Map.</p>";
	} else {
		echo '<iframe class="responsive-iframe" src="https://maps.google.com/maps?q='.$geomap.'&t=&z=15&ie=UTF8&iwloc=&output=embed" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>';
	}
?>

<script type="text/javascript">
	function fnGetReceiver(chid) {
		let rcvrer = document.getElementById("receiver").value;
		let rcvrerphn = document.getElementById("rphone").value;
		let rcremail = document.getElementById("remail").value;
		let adrex4 = document.getElementById("ship-address").value;
		let adrex3 = document.getElementById("address2").value;
		let adrex2 = adrex3 + ', ' + adrex4;

		if (rcvrer==='' || rcvrerphn==='' || adrex4==='' || adrex3==='') {
			alert('Please fill-up the receiver/recepient form properly.');
		} else {
			var xconfrm;
			if (confirm("Proceed to checkout?")) {
				xconfrm = "Successfully checkout.";
				window.location = '../../content/view/mcart/checkoutr.php?chid='+chid+'&rcvrer='+rcvrer+'&rcvrerphn='+rcvrerphn+'&adrex2='+adrex2+'&rcremail='+rcremail;
			} else {
				xconfrm = "Cancel checkout.";
			}
			alert(xconfrm);
			document.getElementById("clzedanger").click();
		}
	}

	$(document).ready( function () {
		$('#listRecView9').DataTable( {
			initComplete: function () {
				this.api().columns().every( function () {

					/** Filter Group for each column Start **/
					var column = this;
					var select = $('<select><option value=""></option></select>')
					.appendTo( $(column.footer()).empty() )
					.on( 'change', function () {
						var val = $.fn.dataTable.util.escapeRegex(
						$(this).val()
					);

					column
						.search( val ? '^'+val+'$' : '', true, false )
						.draw();
					});

					column.data().unique().sort().each( function ( d, j ) {
						select.append( '<option value="'+d+'">'+d+'</option>' )
					});
				});
			}
		} );
	});

	function fnChangeQty(id,qty,itemid) {
		window.location = "../../content/view/mcart/update.php?itmordid="+id+"&zqty="+qty+"&itemid="+itemid;
	}

	function trash(id,no) {
		var answer = confirm('Delete record No.:'+no+' ?');
		if (answer) {
			window.location = '../../content/view/mcart/deleted.php?itoid='+id+'&xno='+no;
		}
	}

	function fnCheckOut(chid) {
		var xconfrm;
		if (confirm("Proceed to checkout?")) {
			xconfrm = "Successfully checkout.";
			window.location = '../../content/view/mcart/checkout.php?chid=' + chid;
		} else {
			xconfrm = "Cancel checkout.";
			alert(xconfrm+' OrderID:['+chid+']');
		}
	}
</script>