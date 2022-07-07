<?php
	$ydatex = isset($_GET['ydatex']) ? $_GET['ydatex'] : date("Y");

	$cnn_sbtotal = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
	$qry_sbtotal = "SELECT SUM(sub_total) AS subtotal, COUNT(*) AS total_rows, SUM(sub_total_qty) AS total_qty, SUM(sub_total_item) AS total_item FROM tbl_order_customer WHERE status=:status AND deleted=0 AND YEAR(date(created))=:yyear4";
	$stmt_sbtotal = $cnn_sbtotal->prepare($qry_sbtotal);
	$status = 'Paid';
	$stmt_sbtotal->bindParam(':status', $status);
	$stmt_sbtotal->bindParam(':yyear4', $ydatex);
	$stmt_sbtotal->execute();
	$row_sbtotal = $stmt_sbtotal->fetch(PDO::FETCH_ASSOC);
	$sbtotztal = number_format($row_sbtotal['subtotal'],2);
	$sbtotalrows = $row_sbtotal['total_rows'];
	$sbtotalqty = $row_sbtotal['total_qty'];
	$sbtotalitem = $row_sbtotal['total_item'];
?>

<div class="text-right">
	<a href="" class="btn btn-primary">Refresh</a>
	<a href="#" onclick="window.print();" class="btn btn-info">Print</a>
	<a href="../../../../routes/reports/yearly?ydatex=<?php echo $ydatex; ?>" class="btn btn-link m-2">
		<i>&#8592;</i> Back
	</a>
</div>

<div class="container" style="background-color: transparent;">
	<div class="card">
		<div class="card-header">
			<h2 class="text-center">Daily Report</h2>
			<div class="row">
				<div class="col-md-6"></div>
				<div class="col-md-6"><label>Date: <?php echo $ydatex; ?></label></div>
			</div>
			<div class="row">
				<div class="col-md-6"><label>In-charge: <?php echo $_SESSION["username"]; ?></label></div>
				<div class="col-md-6"><label>Total Sales: <?php echo $sbtotztal; ?></label></div>
			</div>
			<div class="row">
				<div class="col-md-6"><label>Total Item: <?php echo $sbtotalitem; ?></label></div>
				<div class="col-md-6"><label>Total Qty: <?php echo $sbtotalqty; ?></label></div>
			</div>
			<div class="row">
				<div class="col-md-6"><label>Total Receipt: <?php echo $sbtotalrows; ?></label></div>
				<div class="col-md-6"></div>
			</div>
		</div>

		<div class="card-body">
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>No.</th>
							<th>Receipt#</th>
							<th>Sub-Total</th>
							<th>Total Qty</th>
							<th>Total Item</th>
							<th>Customer</th>
							<th>Phone</th>
							<th class="d-none">E-mail</th>
							<th class="d-none">Address</th>
							<th class="d-none">Shipping Fee</th>
							<th class="d-none">Total</th>
							<th>Receiver</th>
							<th>Recevier Phone</th>
							<th class="d-none">Receiver Email</th>
							<th class="d-none">Receiver Address</th>
							<th class="d-none">GMap</th>
							<th class="d-none">Courier</th>
							<th class="d-none">Other Details</th>
							<th>Modified</th>
							<th>Created</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$tblname = "tbl_order_customer";
							$prim_id = "order_id";
							$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
							// SELECT * FROM tbl_order_customer WHERE status='Paid' AND deleted=0 AND DATE(created) = CURDATE() ORDER BY order_id DESC
							$qry = "SELECT * FROM {$tblname} WHERE status=:status AND deleted=0 AND YEAR(date(created))=:yyear1 ORDER BY {$prim_id} DESC";
							$stmt = $cnn->prepare($qry);
							$status = 'Paid';
							$stmt->bindParam(':status', $status);
							$stmt->bindParam(':yyear1', $ydatex);
							$stmt->execute();
							$xno = 0;

							for($i=0; $row = $stmt->fetch(); $i++) {
								$xno++;
								$orderid		= $row['order_id'];
								$receiptno		= $row['receipt_no'];
								$customername	= $row['customer_name'];
								$phone			= $row['phone'];
								$cemail			= $row['cemail'];
								$address		= $row['address'];
								$subtotalqty	= $row['sub_total_qty'];
								$subtotalitem	= $row['sub_total_item'];
								$subtotal		= $row['sub_total'];
								$shippingfee	= $row['shipping_fee'];
								$totalall		= $row['total_all'];
								$receiver		= $row['receiver'];
								$receiverphone	= $row['receiver_phone'];
								$remail			= $row['remail'];
								$dlocation		= $row['d_location'];
								$longlat		= $row['long_lat'];
								$courier		= $row['courier'];
								$otherinfo		= $row['otherinfo'];
								$modified2		= $row['modified'];
								$modified		= date_format(new DateTime($modified2),'Y/m/d');
								$created2		= $row['created'];
								$created		= date_format(new DateTime($created2),'Y/m/d');
						?>

								<tr>
									<td><?php echo $xno; ?></td>
									<td data-filter="<?php echo $receiptno; ?>"><?php echo $receiptno; ?></td>
									<td data-filter="<?php echo $subtotal; ?>"><?php echo $subtotal; ?></td>
									<td data-filter="<?php echo $subtotalqty; ?>"><?php echo $subtotalqty; ?></td>
									<td data-filter="<?php echo $subtotalitem; ?>"><?php echo $subtotalitem; ?></td>
									<td data-filter="<?php echo $customername; ?>"><?php echo $customername; ?></td>
									<td data-filter="<?php echo $phone; ?>"><?php echo $phone; ?></td>
									<td class="d-none" data-filter="<?php echo $cemail; ?>"><?php echo $cemail; ?></td>
									<td class="d-none" data-filter="<?php echo $address; ?>"><?php echo $address; ?></td>
									<td class="d-none" data-filter="<?php echo $shippingfee; ?>"><?php echo $shippingfee; ?></td>
									<td class="d-none" data-filter="<?php echo $totalall; ?>"><?php echo $totalall; ?></td>
									<td data-filter="<?php echo $receiver; ?>"><?php echo $receiver; ?></td>
									<td data-filter="<?php echo $receiverphone; ?>"><?php echo $receiverphone; ?></td>
									<td class="d-none" data-filter="<?php echo $remail; ?>"><?php echo $remail; ?></td>
									<td class="d-none" data-filter="<?php echo $dlocation; ?>"><?php echo $dlocation; ?></td>
									<td class="d-none" data-filter="<?php echo $longlat; ?>"><?php echo $longlat; ?></td>
									<td class="d-none" data-filter="<?php echo $courier; ?>"><?php echo $courier; ?></td>
									<td class="d-none" data-filter="<?php echo $otherinfo; ?>"><?php echo $otherinfo; ?></td>
									<td data-filter="<?php echo $modified; ?>"><?php echo $modified; ?></td>
									<td data-filter="<?php echo $created; ?>"><?php echo $created; ?></td>
								</tr>
						<?php
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script>
	window.print();
</script>