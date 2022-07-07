<?php
	include_once "../../../content/template-part/{$themename}/dashboard-navbar.php";
	$sdate = date("Y-m-d", strtotime(isset($_GET['sdate']) ? $_GET['sdate'] : date("Y-m-d")));
?>

<link rel="stylesheet" href="<?php echo $dirbak; ?>assets/datatables/1.11.3/css/jquery.dataTables.min.css">
<script src="<?php echo $dirbak; ?>assets/datatables/1.11.3/js/jquery.dataTables.min.js"></script>

<main class="page-content">
	<div class="container-fluid bg-light-opacity">
		<div class="d-flex">
			<h4 class="mr-2 mb-2">Daily Report</h4>
			<a href="<?php echo $dirbak.'routes/reports/daily/print/?sdate='.$sdate; ?>" class="btn btn-large btn-primary">Print</a>
		</div>

		<div class="d-flex">
			<div class="ml-auto">
				<form method="_GET">
					<label for="sdate">Date:</label>
					<input type="date" id="sdate" name="sdate">
					<input type="submit" value="Preview">
				</form>
			</div>
		</div>

		<?php
			$cnn_sbtotal = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
			$qry_sbtotal = "SELECT SUM(sub_total) AS subtotal, COUNT(*) AS total_rows, SUM(sub_total_qty) AS total_qty, SUM(sub_total_item) AS total_item FROM tbl_order_customer WHERE status=:status AND deleted=0 AND DATE(created)=:sdateg";
			$stmt_sbtotal = $cnn_sbtotal->prepare($qry_sbtotal);
			$status = 'Paid';
			$stmt_sbtotal->bindParam(':status', $status);
			$stmt_sbtotal->bindParam(':sdateg', $sdate);
			$stmt_sbtotal->execute();
			$row_sbtotal = $stmt_sbtotal->fetch(PDO::FETCH_ASSOC);
			$sbtotztal = number_format($row_sbtotal['subtotal'],2);
			$sbtotalrows = $row_sbtotal['total_rows'];
			$sbtotalqty = $row_sbtotal['total_qty'];
			$sbtotalitem = $row_sbtotal['total_item'];
		?>

		<div id="" class="table-responsive">
			<table id="listRecView" class="table table-striped table-hover">
				<thead>
					<tr>
						<th><?php echo 'Total<br>Receipt:<br><h5 class="text-danger">'.$sbtotalrows; ?></h5></th>
						<th></th>
						<th><?php echo 'Total<br>Sales:<br><h5 class="text-danger">'.$sbtotztal; ?></h5></th>
						<th><?php echo 'Total<br>Quantity:<br><h5 class="text-danger">'.$sbtotalqty; ?></h5></th>
						<th><?php echo 'Total<br>Item:<br><h5 class="text-danger">'.$sbtotalitem; ?></h5></th>
						<th></th>
						<th></th>
						<th class="d-none"></th>
						<th class="d-none"></th>
						<th class="d-none"></th>
						<th class="d-none"></th>
						<th></th>
						<th></th>
						<th class="d-none"></th>
						<th class="d-none"></th>
						<th class="d-none"></th>
						<th class="d-none"></th>
						<th class="d-none"></th>
						<th></th>
						<th>Filtered<br>Date:<br><h5 class="text-danger"><?php echo $sdate; ?></h5></th>
						<th></th>
						<th></th>
					</tr>
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
						<th>Ctrl#</th>
						<th class="text-right">Action</th>
					</tr>
				</thead>

				<tbody>
					<?php
						$tblname = "tbl_order_customer";
						$prim_id = "order_id";
						$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
						// SELECT * FROM tbl_order_customer WHERE status='Paid' AND deleted=0 AND DATE(created) = CURDATE() ORDER BY order_id DESC
						$qry = "SELECT * FROM {$tblname} WHERE status=:status AND deleted=0 AND DATE(created)=:sdate ORDER BY {$prim_id} DESC";
						$stmt = $cnn->prepare($qry);
						$status = 'Paid';
						$stmt->bindParam(':status', $status);
						$stmt->bindParam(':sdate', $sdate);
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

								<td><?php echo $orderid; ?></td>
								<td class="text-right tbl-action">
									<a href="../../routes/reports/daily/editupdate?orderid=<?php echo $orderid; ?>" class="btn-sm btn-success btn-inline" title="Edit">
										<span class="far fa-edit"></span>
									</a>
								</td>
							</tr>
					<?php
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</main>