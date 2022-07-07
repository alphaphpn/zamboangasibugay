<?php
	include_once "../../../content/theme/".$themename."/frontend-navbar.php";
	include_once "../../../content/theme/".$themename."/slick-home-banner.php";

	$cnn_chckqty = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
	$qry_chckqty = "SELECT COUNT(*) AS total_rows, SUM(qty) AS total_qty FROM tbl_order_item WHERE order_id=:orderidqty";
	$stmt_chckqty = $cnn_chckqty->prepare($qry_chckqty);
	$orderidqty = isset($_GET['orderid']) ? $_GET['orderid'] : "";
	$stmt_chckqty->bindParam(':orderidqty', $orderidqty);
	$stmt_chckqty->execute();
	$row_chckqty = $stmt_chckqty->fetch(PDO::FETCH_ASSOC);
	$chckqtynw = $row_chckqty['total_qty'];
	$chcktotrwz = $row_chckqty['total_rows'];

	$cnn_porder = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
	$qry_porder = "SELECT * FROM tbl_order_customer WHERE order_id=:orderid AND remarks<>:prmrkz LIMIT 1";
	$stmt_porder = $cnn_porder->prepare($qry_porder);
	$orderid = isset($_GET['orderid']) ? $_GET['orderid'] : "";
	$prmrkz = 'Process';
	$stmt_porder->bindParam(':orderid', $orderid);
	$stmt_porder->bindParam(':prmrkz', $prmrkz);
	$stmt_porder->execute();
	$numporder = $stmt_porder->rowCount();

	if ($numporder>0) {
		foreach ($stmt_porder as $proworder) {
			$pcurr_ordrid = $proworder['order_id'];
			$prmrksz = $proworder['remarks'];
			if($prmrksz=='Checkout'){
				$rbsTxtColor = ' text-muted';
			}elseif($prmrksz=='Reviewed'){
				$rbsTxtColor = ' text-info';
			}elseif($prmrksz=='Approved'){
				$rbsTxtColor = ' text-primary';
			}elseif($prmrksz=='Declined'){
				$rbsTxtColor = ' text-warning';
			}elseif($prmrksz=='Shipped'){
				$rbsTxtColor = ' text-secondary';
			}elseif($prmrksz=='Complete'){
				$rbsTxtColor = ' text-success';
			}else{
				$rbsTxtColor = '';
			}
			$pstatus = $proworder['status'];
			if($pstatus=='Unpaid'){
				$sbsTxtColor = ' text-danger';
				$titled = 'Wait for the personnel to contact you for the payment or you may reach to this number '.$mobileno.'.';
			}elseif($pstatus=='Cancel'){
				$sbsTxtColor = ' text-warning';
				$titled = 'Cancel';
			}elseif($pstatus=='Paid'){
				$sbsTxtColor = ' text-success';
				$titled = 'Paid';
			}else{
				$sbsTxtColor = '';
				$titled = '';
			}

			$name_client = $proworder['customer_name'];
			$phone_client = $proworder['phone'];
			$address_client = $proworder['address'];
			$email_client = $proworder['cemail'];

			$name_recepient = $proworder['receiver'];
			$phone_recepient = $proworder['receiver_phone'];
			$address_recepient = $proworder['d_location'];
			$email_recepient = $proworder['remail'];

			$courier = $proworder['courier'];
			$otherinfo = $proworder['otherinfo'];
			$datehah = $proworder['modified'];
			$datecreatedz = $proworder['created'];
			$frmtdtzx = date("Ymd", strtotime($datecreatedz));;
			$recptnom = '';

			if ( $pstatus=='Paid' ) {
				$recptnom = 'OR'.$frmtdtzx.$pcurr_ordrid;
			} else {
				$recptnom = $proworder['receipt_no'];
			}
		}
	} else {
		echo "<script>window.location = '../../../routes/mpurchase';</script>";
	}
?>

<link rel="stylesheet" href="../../../assets/datatables/1.11.3/css/jquery.dataTables.min.css">
<script src="../../../assets/datatables/1.11.3/js/jquery.dataTables.min.js"></script>

<div class="pt-5 pb-5">
	<div class="container">
		<div class="card">
			<div class="card-header">
				<label>Purchase Order#: <?php echo $pcurr_ordrid; ?></label><br>
				<label>Receipt#: <?php echo $recptnom; ?></label>
				<div class="float-right">
					<a class="btn <?php echo $rbsTxtColor; ?>"><strong>Remarks:</strong> <?php echo $prmrksz; ?></a>
					<a class="btn <?php echo $sbsTxtColor; ?>" title="<?php echo $titled; ?>"><strong>Status:</strong> <?php echo $pstatus; ?></a>
					<a href="" class="btn btn-primary">Refresh</a>
					
					<?php
						switch (true) {
							case ($prmrksz=='Checkout' and $pstatus=='Unpaid'):
								?>
									<a href="../../../content/view/mpurchase/order/cancel-order.php?orderid=<?php echo $pcurr_ordrid; ?>" class="btn btn-danger">Cancel Order</a>
								<?php
								break;

							case ($prmrksz=='Checkout' and $pstatus=='Paid'):
								?>
									<a href="../../../routes/mpurchase/order/receipt.php?orderid=<?php echo $pcurr_ordrid; ?>" class="btn btn-info">Print Preview</a>
								<?php
								break;

							case ($prmrksz=='Checkout' and $pstatus=='Cancel'):
								?>
									<a href="../../../content/view/mpurchase/order/continue-order.php?orderid=<?php echo $pcurr_ordrid; ?>" class="btn btn-dark">Continue</a>
								<?php
								break;

							case ($prmrksz=='Reviewed' and $pstatus=='Unpaid'):
								?>
									<a href="../../../content/view/mpurchase/order/cancel-order.php?orderid=<?php echo $pcurr_ordrid; ?>" class="btn btn-danger">Cancel Order</a>
								<?php
								break;

							case ($prmrksz=='Reviewed' and $pstatus=='Paid'):
								?>
									<a href="../../../routes/mpurchase/order/receipt.php?orderid=<?php echo $pcurr_ordrid; ?>" class="btn btn-info">Print Preview</a>
								<?php
								break;

							case ($prmrksz=='Reviewed' and $pstatus=='Cancel'):
								?>
									<a href="../../../content/view/mpurchase/order/continue-order.php?orderid=<?php echo $pcurr_ordrid; ?>" class="btn btn-dark">Continue</a>
								<?php
								break;

							case ($prmrksz=='Approved' and $pstatus=='Unpaid'):
								?>
									<a href="../../../routes/mpurchase/order/receipt.php?orderid=<?php echo $pcurr_ordrid; ?>" class="btn btn-info">Print Preview</a>
									<a href="../../../content/view/mpurchase/order/cancel-order.php?orderid=<?php echo $pcurr_ordrid; ?>" class="btn btn-danger">Cancel Order</a>
								<?php
								break;

							case ($prmrksz=='Approved' and $pstatus=='Paid'):
								?>
									<a href="../../../routes/mpurchase/order/receipt.php?orderid=<?php echo $pcurr_ordrid; ?>" class="btn btn-info">Print Preview</a>
								<?php
								break;

							case ($prmrksz=='Approved' and $pstatus=='Cancel'):
								?>
									<a href="../../../content/view/mpurchase/order/continue-order.php?orderid=<?php echo $pcurr_ordrid; ?>" class="btn btn-dark">Continue</a>
								<?php
								break;

							case ($prmrksz=='Declined' and $pstatus=='Unpaid'):
								break;

							case ($prmrksz=='Declined' and $pstatus=='Paid'):
								?>
									<a href="../../../routes/mpurchase/order/receipt.php?orderid=<?php echo $pcurr_ordrid; ?>" class="btn btn-info">Print Preview</a>
								<?php
								break;

							case ($prmrksz=='Declined' and $pstatus=='Cancel'):
								break;

							case ($prmrksz=='Shipped' and $pstatus=='Unpaid'):
								?>
									<a href="../../../routes/mpurchase/order/receipt.php?orderid=<?php echo $pcurr_ordrid; ?>" class="btn btn-info">Print Preview</a>
									<a href="../../../content/view/mpurchase/order/cancel-order.php?orderid=<?php echo $pcurr_ordrid; ?>" class="btn btn-danger">Cancel Order</a>
								<?php
								break;

							case ($prmrksz=='Shipped' and $pstatus=='Paid'):
								?>
									<a href="../../../routes/mpurchase/order/receipt.php?orderid=<?php echo $pcurr_ordrid; ?>" class="btn btn-info">Print Preview</a>
								<?php
								break;

							case ($prmrksz=='Shipped' and $pstatus=='Cancel'):
								?>
									<a href="../../../content/view/mpurchase/order/continue-order.php?orderid=<?php echo $pcurr_ordrid; ?>" class="btn btn-dark">Continue</a>
								<?php
								break;

							case ($prmrksz=='Complete' and $pstatus=='Unpaid'):
								?>
									<a href="../../../routes/mpurchase/order/receipt.php?orderid=<?php echo $pcurr_ordrid; ?>" class="btn btn-info">Print Preview</a>
								<?php
								break;

							case ($prmrksz=='Complete' and $pstatus=='Paid'):
								?>
									<a href="../../../routes/mpurchase/order/receipt.php?orderid=<?php echo $pcurr_ordrid; ?>" class="btn btn-info">Print Preview</a>
								<?php
								break;

							default:
								?>
									<a href="../../../content/view/mpurchase/order/cancel-order.php?orderid=<?php echo $pcurr_ordrid; ?>" class="btn btn-danger">Cancel Order</a>
								<?php
								break;
						}
					?>
				</div>
			</div>
			<div class="card-body">
				<h5>Receiver / Recipient Information</h5>
				<div class="row">
					<div class="col-md-6"><label>Recipient: <?php echo $name_recepient; ?></label></div>
					<div class="col-md-6"><label>Phone: <?php echo $phone_recepient; ?></label></div>
				</div>
				<div class="row">
					<div class="col-md-6"><label>E-mail: <?php echo $email_recepient; ?></label></div>
					<div class="col-md-6"><label>Address: <?php echo $address_recepient; ?></label></div>
				</div>
				<hr>
				<div class="table-responsive">
					<table id="listRecViewPOrder" class="table table-striped table-hover">
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
								$order_id = $pcurr_ordrid;
								$stmt->bindParam(':order_id', $order_id);
								$stmt->execute();
								$cntme = $stmt->rowCount();
								$xno = 0;

								if ($cntme > 0) {

								} else {
									echo '<script>window.location=("../../../");</script>';
								}

								for($i=0; $row = $stmt->fetch(); $i++) {
									$xno++;
									$item_id=$row['item_id'];
									$barcode=$row['barcode'];
									$extnem=$row['extnem'];
									$img_item='../../../content/theme/'.$themename.'/storage/img/item/ITEM'.$item_id.'.'.$extnem;
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
											<?php
												if ( $prmrksz == 'Complete' || $pstatus=='Paid' ) {
													echo $qty;
												} elseif ( $pstatus=='Cancel' ) {
													echo $qty;
												} elseif ( $prmrksz=='Checkout' || $pstatus=='Unpaid' ) {
													?>
														<input type="number" id="qtyedit<?php echo $id2; ?>" name="qty_edit" class="qty_edit none-zero-input" value="<?php echo $qty; ?>" onchange="fnChangeQty(<?php echo $id2; ?>,this.value)" step="1" min="1" max="<?php echo $cstock; ?>" onkeydown="if(event.key==='.'){event.preventDefault();}" oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');">
													<?php
												} elseif ( $prmrksz=='Reviewed' ) {
													echo $qty;
												} elseif ( $prmrksz=='Approved' ) {
													echo $qty;
												} elseif ( $prmrksz=='Declined' ) {
													echo $qty;
												} elseif ( $prmrksz=='Shipped' ) {
													echo $qty;
												} else {
													?>
														<input type="number" id="qtyedit<?php echo $id2; ?>" name="qty_edit" class="qty_edit none-zero-input" value="<?php echo $qty; ?>" onchange="fnChangeQty(<?php echo $id2; ?>,this.value)" step="1" min="1" max="<?php echo $cstock; ?>" onkeydown="if(event.key==='.'){event.preventDefault();}" oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');">
													<?php
												}
											?>
										</td>
										<td data-filter="<?php echo $unit; ?>"><?php echo $unit; ?></td>
										<td data-filter="<?php echo $price; ?>"><?php echo $dcurrencyx.number_format($price,2); ?></td>
										<td data-filter="<?php echo $total_amt; ?>"><?php echo $dcurrencyx; ?><span data-value="<?php echo $total_amt; ?>" id="ttamt<?php echo $id2; ?>"><?php echo number_format($total_amt,2); ?></span></td>
										<td class="d-none" data-filter="<?php echo $modified; ?>"><?php echo $modified; ?></td>
										<td class="d-none" data-filter="<?php echo $created; ?>"><?php echo $created; ?></td>
										<td class="d-none"><?php echo $id2; ?></td>
										<td class="text-right tbl-action">
											<?php
												if ( $chcktotrwz==1 ) {
													echo '';
												} elseif ( $prmrksz == 'Complete' && $pstatus=='Paid') {
													echo '';
												} elseif ( $pstatus=='Cancel') {
													echo '';
												} elseif ( $prmrksz=='Approved' ) {
													echo '';
												} elseif ( $prmrksz=='Declined' ) {
													echo '';
												} elseif ( $prmrksz=='Shipped' ) {
													echo '';
												} elseif ( $prmrksz=='Complete' ) {
													echo '';
												} else {
													?>
														<a class="btn-sm btn-dark btn-inline ml-1" href="#" onclick="trash(<?php echo $id2.','.$xno; ?>)" title="Delete">
															<span class="fas fa-trash-alt"></span>
														</a>
													<?php
												}
											?>
											
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
								$order_id2 = $pcurr_ordrid;
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
						<a href="../../../" class="text-dark text-decoration-none pr-3 mr-3">
							<i>&#8592;</i> to Homepage
						</a>
						<a href="../../../routes/mpurchase" class="btn btn-success">
							<i>&#8592;</i> Back
						</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-6"><label>Courier: </label></div>
					<div class="col-md-6">
						<label>Shipping fee: <?php echo $dcurrencyx; ?></label>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6"><label>Other Info.: </label></div>
					<div class="col-md-6">
						<label>Total: <?php echo $dcurrencyx; ?></label>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<fieldset class="border pb-0 pt-3 pl-3 pr-3">
					<legend class="w-auto pb-0 pt-3 pl-3 pr-3">Legend: Remarks</legend>
					<div class="d-flex flex-wrap">
						<div class="p-2 m-2 border text-muted">Process</div>
						<div class="p-2 m-2 border text-danger">Checkout</div>
						<div class="p-2 m-2 border text-info">Reviewed</div>
						<div class="p-2 m-2 border text-primary">Approved</div>
						<div class="p-2 m-2 border text-warning">Declined</div>
						<div class="p-2 m-2 border text-secondary">Shipped</div>
						<div class="p-2 m-2 border text-success">Complete</div>
					</div>
				</fieldset>
			</div>

			<div class="col-md-6">
				<fieldset class="border pb-0 pt-3 pl-3 pr-3">
					<legend class="w-auto pb-0 pt-3 pl-3 pr-3">Legend: Status</legend>
					<div class="d-flex flex-wrap text-center">
						<div class="p-2 m-2 border text-danger">Unpaid</div>
						<div class="p-2 m-2 border text-warning">Cancel</div>
						<div class="p-2 m-2 border text-success">Paid</div>
					</div>
				</fieldset>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready( function () {
		$('#listRecViewPOrder').DataTable( {
			initComplete: function () {
				this.api().columns().every( function () {
					/** Filter Group for each column Start **/
					var column = this;
					var select = $('<select><option value=""></option></select>')
					.appendTo( $(column.header()).empty() )
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
					/** Filter Group for each column End **/
				});
			}
		} );
	});

	function fnChangeQty(id,qty) {
		window.location = "../../../content/view/mpurchase/order/update.php?itmordid="+id+"&zqty="+qty;
	}

	function trash(id,no) {
		var answer = confirm('Delete record No.:'+no+' ?');
		if (answer) {
			window.location = '../../../content/view/mpurchase/order/deleted.php?itoid='+id+'&xno='+no;
		}
	}
</script>

<?php
	if ( empty($geomap) ) {
		echo "<p align='center'>Can't Load Map.</p>";
	} else {
		echo '<iframe class="responsive-iframe" src="https://maps.google.com/maps?q='.$geomap.'&t=&z=15&ie=UTF8&iwloc=&output=embed" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>';
	}
?>