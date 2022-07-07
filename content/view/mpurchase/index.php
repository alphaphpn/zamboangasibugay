<?php
	include_once "../../content/theme/".$themename."/frontend-navbar.php";
	include_once "../../content/theme/".$themename."/slick-home-banner.php";

	$cnn_purchase = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
	$qry_purchase = "SELECT 
		`tbl_order_item`.`item_order_id`,
		`tbl_order_customer`.`order_id`,
		`tbl_order_customer`.`receipt_no`,
		`tbl_order_item`.`item_id`,
		`tbl_order_item`.`barcode`,
		`tbl_order_item`.`item_name`,
		`tbl_order_item`.`qty`,
		`tbl_order_item`.`unit`,
		`tbl_order_item`.`price`,
		`tbl_order_item`.`total_amt`,
		`tbl_order_item`.`extnem`,
		`tbl_order_customer`.`customer_id`,
		`tbl_order_customer`.`remarks`,
		`tbl_order_customer`.`status`,
		`tbl_order_customer`.`modified`,
		`tbl_order_item`.`deleted` 
	FROM tbl_order_item INNER JOIN tbl_order_customer ON `tbl_order_customer`.`order_id` = `tbl_order_item`.`order_id` WHERE customer_id=:customerid9 AND remarks<>:mrmrkz AND `tbl_order_item`.`deleted`=0 ORDER BY order_id DESC";
	$stmt_purchase = $cnn_purchase->prepare($qry_purchase);
	$customerid9 = $_SESSION["usercode"];
	$mrmrkz = 'Process';
	$stmt_purchase->bindParam(':mrmrkz', $mrmrkz);
	$stmt_purchase->bindParam(':customerid9', $customerid9);
	$stmt_purchase->execute();
	$numpurchase = $stmt_purchase->rowCount();
	$xnopurchase = 0;
?>

<link rel="stylesheet" href="../../assets/datatables/1.11.3/css/jquery.dataTables.min.css">
<script src="../../assets/datatables/1.11.3/js/jquery.dataTables.min.js"></script>

<div class="pt-5 pb-5">
	<div class="container-fluid">
		<div id="purchase" class="card">
			<div class="card-header">
				<label>Purchase</label>
				<div class="float-right">
					<a href="">Refresh</a>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table id="listRecView91" class="table table-striped table-hover">
						<thead>
							<tr>
								<th>No.</th>
								<th>OrderID</th>
								<th>Receipt#</th>
								<th class="d-none">Item ID</th>
								<th class="d-none">Barcode</th>
								<th colspan="2">Item</th>
								<th>Qty</th>
								<th>Unit</th>
								<th>Price</th>
								<th>Total</th>
								<th>Remarks</th>
								<th>Status</th>
								<th>Date/Time</th>
								<th>Ctrl#</th>
								<th class="text-right">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php

								if ($numpurchase>0) {
									foreach ($stmt_purchase as $row_purchase) {
										$xnopurchase++;
										$orderidy = $row_purchase['order_id'];
										$receiptnoy = $row_purchase['receipt_no'];
										$itemidy = $row_purchase['item_id'];
										$barcodey = $row_purchase['barcode'];
										$extnemy = $row_purchase['extnem'];
										$imgitemy='../../content/theme/'.$themename.'/storage/img/item/ITEM'.$itemidy.'.'.$extnemy;
										$itemnamey = $row_purchase['item_name'];
										$qtyy = $row_purchase['qty'];
										$unity = $row_purchase['unit'];
										$pricey = $row_purchase['price'];
										$totaly = $row_purchase['total_amt'];
										$remarksy = $row_purchase['remarks'];
										if($remarksy=='Process'){
											$rbsTxtColor = ' text-danger';
										}elseif($remarksy=='Checkout'){
											$rbsTxtColor = ' text-muted';
										}elseif($remarksy=='Reviewed'){
											$rbsTxtColor = ' text-info';
										}elseif($remarksy=='Approved'){
											$rbsTxtColor = ' text-primary';
										}elseif($remarksy=='Declined'){
											$rbsTxtColor = ' text-warning';
										}elseif($remarksy=='Shipped'){
											$rbsTxtColor = ' text-secondary';
										}elseif($remarksy=='Complete'){
											$rbsTxtColor = ' text-success';
										}else{
											$rbsTxtColor = '';
										}
										$statusy = $row_purchase['status'];
										if($statusy=='Unpaid'){
											$sbsTxtColor = ' text-danger';
											$titled = 'Wait for the personnel to contact you for the payment or you may reach to this number '.$mobileno.'.';
										}elseif($statusy=='Cancel'){
											$sbsTxtColor = ' text-warning';
										}elseif($statusy=='Paid'){
											$sbsTxtColor = ' text-success';
										}else{
											$sbsTxtColor = '';
										}
										$datey = $row_purchase['modified'];
										$ctrly = $row_purchase['item_order_id'];

										?>
											<tr>
												<td data-filter="<?php echo $xnopurchase; ?>"><?php echo $xnopurchase; ?></td>
												<td data-filter="<?php echo $orderidy; ?>"><?php echo $orderidy; ?></td>
												<td data-filter="<?php echo $receiptnoy; ?>"><?php echo $receiptnoy; ?></td>
												<td class="d-none" data-filter="<?php echo $itemidy; ?>"><?php echo $itemidy; ?></td>
												<td class="d-none" data-filter="<?php echo $barcodey; ?>"><?php echo $barcodey; ?></td>
												<td><img class="w-30px" src="<?php echo $imgitemy; ?>"></td>
												<td data-filter="<?php echo $itemnamey; ?>"><?php echo $itemnamey; ?></td>
												<td data-filter="<?php echo $qtyy; ?>"><?php echo $qtyy; ?></td>
												<td data-filter="<?php echo $unity; ?>"><?php echo $unity; ?></td>
												<td data-filter="<?php echo $pricey; ?>"><?php echo $dcurrencyx.number_format($pricey,2); ?></td>
												<td data-filter="<?php echo $totaly; ?>"><?php echo $dcurrencyx.number_format($totaly,2); ?></td>
												<td data-filter="<?php echo $remarksy; ?>">
													<div class="border p-1 text-center bg-light<?php echo $rbsTxtColor; ?>"><?php echo $remarksy; ?></div>													
												</td>
												<td data-filter="<?php echo $statusy; ?>">
													<div title="<?php echo $titled; ?>" class="border p-1 text-center bg-light<?php echo $sbsTxtColor; ?>"><?php echo $statusy; ?></div>
												</td>
												<td data-filter="<?php echo $datey; ?>"><?php echo $datey; ?></td>
												<td data-filter="<?php echo $ctrly; ?>"><?php echo $ctrly; ?></td>
												<td class="text-right tbl-action">
													<a href="../../routes/mpurchase/order?orderid=<?php echo $orderidy; ?>" class="btn-sm btn-success btn-inline" title="View">
														<span class="far fa-edit"></span>
													</a>
												</td>
											</tr>
										<?php
									}
								} else {
									echo "<script>alert('Either you have no order or you may Checkout your Cart.'); window.location = '../../#productitemz';</script>";
								}
							?>	
						</tbody>
						<tfoot></tfoot>
					</table>
				</div>
			</div>
			<div class="card-footer">
				<div class="row">
					<div class="col-sm-6 mb-2"></div>
					<div class="col-sm-6 mb-2 text-right">
						<a href="../../" class="text-dark text-decoration-none pr-3 mr-3">
							<i>&#8592;</i> to Homepage
						</a>
						<a href="../../routes/mcart/#cart" class="btn btn-success">
							<i>&#8592;</i> Go to Cart
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
		// Remarks: Process | Checkout | Reviewed | Approved | Declined | Shipped | Complete
		// Status: Unpaid | Cancel | Paid

		// Remarks: text-danger | text-muted | text-info | text-primary | text-warning | text-secondary | text-success
		// Status: text-danger | text-warning | text-success
	?>
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
		$('#listRecView91').DataTable( {
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
</script>

<?php
	if ( empty($geomap) ) {
		echo "<p align='center'>Can't Load Map.</p>";
	} else {
		echo '<iframe class="responsive-iframe" src="https://maps.google.com/maps?q='.$geomap.'&t=&z=15&ie=UTF8&iwloc=&output=embed" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>';
	}
?>