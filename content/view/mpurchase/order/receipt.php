<?php
	$orderid = isset($_GET['orderid']) ? $_GET['orderid'] : die('ERROR: Not found.');

	$cnn_porder = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
	$qry_porder = "SELECT * FROM tbl_order_customer WHERE order_id=:orderid AND remarks<>:prmrkz LIMIT 1";
	$stmt_porder = $cnn_porder->prepare($qry_porder);
	$orderid = isset($_GET['orderid']) ? $_GET['orderid'] : die('ERROR: Not found.');
	$prmrkz = 'Process';
	$stmt_porder->bindParam(':orderid', $orderid);
	$stmt_porder->bindParam(':prmrkz', $prmrkz);
	$stmt_porder->execute();
	$numporder = $stmt_porder->rowCount();

	if ($numporder>0) {
		foreach ($stmt_porder as $proworder) {
			$pcurr_ordrid = $proworder['order_id'];
			$precpno = $proworder['receipt_no'];
			$prmrksz = $proworder['remarks'];
			$pstatus = $proworder['status'];

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
		}
	} else {
		echo "<script>window.location = '../../../routes/mpurchase';</script>";
	}
?>

<div class="text-right">
	<a href="" class="btn btn-primary">Refresh</a>
	<a href="#" onclick="window.print();" class="btn btn-info">Print</a>
	<a href="../../../routes/mpurchase/order?orderid=<?php echo $orderid; ?>" class="btn btn-link m-2">
		<i>&#8592;</i> Back
	</a>
</div>

<div class="pt-5 pb-5">
	<div class="container">
		<div class="card">
			<div class="card-header">
				<h2 class="text-center">Order Receipt</h2>
				<div class="row">
					<div class="col-md-6"></div>
					<div class="col-md-6"><label>Date: <?php echo $datehah; ?></label></div>
				</div>
				<div class="row">
					<div class="col-md-6"><label>Order ID: <?php echo $pcurr_ordrid; ?></label></div>
					<div class="col-md-6"><label>Receipt#: <?php echo $precpno; ?></label></div>
				</div>
				<div class="row">
					<div class="col-md-6"><label>Remarks: <?php echo $prmrksz; ?></label></div>
					<div class="col-md-6"><label>Status: <?php echo $pstatus; ?></label></div>
				</div>
				<h5>Receiver / Recipient Information</h5>
				<div class="row">
					<div class="col-md-6"><label>Recipient: <?php echo $name_recepient; ?></label></div>
					<div class="col-md-6"><label>Phone: <?php echo $phone_recepient; ?></label></div>
				</div>
				<div class="row">
					<div class="col-md-6"><label>E-mail: <?php echo $email_recepient; ?></label></div>
					<div class="col-md-6"><label>Address: <?php echo $address_recepient; ?></label></div>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>Item ID</th>
								<th>Item</th>
								<th>Qty</th>
								<th>Unit</th>
								<th>Price</th>
								<th>Total</th>
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
									$img_item='../../../storage/img/items/ITEM'.$item_id.'.'.$extnem;
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
										<td><?php echo $item_id; ?></td>
										<td><?php echo $item_name; ?></td>
										<td><?php echo $qty; ?></td>
										<td><?php echo $unit; ?></td>
										<td><?php echo $dcurrencyx.number_format($price,2); ?></td>
										<td><?php echo $dcurrencyx; ?><span data-value="<?php echo $total_amt; ?>" id="ttamt<?php echo $id2; ?>"><?php echo number_format($total_amt,2); ?></span></td>
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
									<td colspan="2">Total Item: <?php echo $sbtotalrows; ?></td>
									<td><?php echo $sbtotalqty; ?></td>
									<td colspan="2">Sub-Total:</td>
									<td><?php echo $dcurrencyx; ?><span id="allsubtotal" data-value="<?php echo $sbtotztal; ?>"><?php echo number_format($sbtotztal,2); ?></span></td>
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
				<hr>
				<h5>Client Information</h5>
				<div class="row">
					<div class="col-md-6"><label>Client: <?php echo $name_client; ?></label></div>
					<div class="col-md-6"><label>Phone: <?php echo $phone_client; ?></label></div>
				</div>
				<div class="row">
					<div class="col-md-6"><label>Email: <?php echo $email_client; ?></label></div>
					<div class="col-md-6"><label>Address: <?php echo $address_client; ?></label></div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	window.print();
</script>