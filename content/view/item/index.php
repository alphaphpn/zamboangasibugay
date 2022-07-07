<?php
	include_once "../../content/template-part/{$themename}/dashboard-navbar.php";
	include_once "../../content/template-part/{$themename}/dashboard-navbar-top.php";
?>

<link rel="stylesheet" href="<?php echo $dirbak; ?>assets/datatables/1.11.3/css/jquery.dataTables.min.css">
<script src="<?php echo $dirbak; ?>assets/datatables/1.11.3/js/jquery.dataTables.min.js"></script>

<main class="page-content">
	<div class="container-fluid bg-light-opacity">
		<div class="d-flex">
			<h4 class="mr-2 mb-2">Items</h4>
			<a href="../../routes/item/addnew" class="btn btn-outline-info btn-sm mr-2 mb-2">Add New</a>
		</div>

		<div id="" class="table-responsive-sm">
			<table id="listRecView" class="table table-striped table-hover table-sm">
				<thead>
					<tr>
						<th>No.</th>
						<th>Image</th>
						<th>Item</th>
						<th>Category</th>
						<th>Unit</th>
						<th>Selling Price</th>
						<th class="d-none">Sale Price</th>
						<th class="d-none">Supplier Price</th>
						<th>Available Stock</th>
						<th>Date</th>
						<th class="d-none">Created</th>
						<th class="d-none">Item Code</th>
						<th class="">Ctrl#</th>
						<th class="text-right">Action</th>
					</tr>
				</thead>

				<tbody>
					<?php
						$tblname = "tbl_item";
						$prim_id = "item_id";
						$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
						$qry = "SELECT * FROM {$tblname} WHERE theme_name=:themename AND deletedx=0 ORDER BY {$prim_id} DESC";
						$stmt = $cnn->prepare($qry);
						$stmt->bindParam(':themename', $themename);
						$stmt->execute();
						$xno = 0;

						for($i=0; $row = $stmt->fetch(); $i++) {
							$xno++;
							$id2=$row['item_id'];
							$id=sprintf('%011d',$id2);
							$barcode=$row['barcode'];
							$extnem=$row['extnem'];
							$img_item='../../content/theme/'.$themename.'/storage/img/item/ITEM'.$id2.'.'.$extnem;
							$itemname=$row['name'];
							$category=$row['category'];
							$unit=$row['unit'];
							$sell_price=$row['sell_price'];
							$sale_price=$row['sale_price'];
							$supplier_price=$row['supplier_price'];
							$stock_available=$row['stock_available'];
							$modified2=$row['modified'];
							$modified=date_format(new DateTime($modified2),'Y/m/d');
							$created2=$row['created'];
							$created=date_format(new DateTime($created2),'Y/m/d');
					?>

							<tr>
								<td><?php echo $xno; ?></td>
								<td><img class="w-30px" src="<?php echo $img_item; ?>"></td>
								<td data-filter="<?php echo $itemname; ?>"><?php echo $itemname; ?></td>
								<td data-filter="<?php echo $category; ?>"><?php echo $category; ?></td>
								<td data-filter="<?php echo $unit; ?>"><?php echo $unit; ?></td>
								<td data-filter="<?php echo $sell_price; ?>"><?php echo number_format($sell_price,2); ?></td>
								<td class="d-none"><?php echo number_format($sale_price,2); ?></td>
								<td class="d-none"><?php echo number_format($supplier_price,2); ?></td>
								<td data-filter="<?php echo $stock_available; ?>"><?php echo $stock_available; ?></td>
								<td><?php echo $modified; ?></td>
								<td class="d-none"><?php echo $created; ?></td>
								<td class="d-none"><?php echo $barcode; ?></td>
								<td class=""><?php echo $id2; ?></td>
								<td class="text-right tbl-action">
									<a href="../../routes/item/editupdate?id=<?php echo $id2; ?>" class="btn-sm btn-success btn-inline" title="Edit">
										<span class="far fa-edit"></span>
									</a>
									<a class="btn-sm btn-dark btn-inline ml-1" href="#" onclick="trash(<?php echo $id2; ?>)" title="Delete">
										<span class="fas fa-trash-alt"></span>
									</a>
								</td>
							</tr>
					<?php
						}
					?>
				</tbody>
				<tfoot>
					<tr>
						<td class="remove-dropdown"></td>
						<td class="remove-dropdown"></td>
						<td class="remove-dropdown"></td>
						<td>Category</td>
						<td>Unit</td>
						<td class="remove-dropdown"></td>
						<td class="remove-dropdown d-none"></td>
						<td class="remove-dropdown d-none"></td>
						<td>Stock</td>
						<td class="remove-dropdown"></td>
						<td class="remove-dropdown d-none"></td>
						<td class="remove-dropdown d-none"></td>
						<td class="remove-dropdown"></td>
						<td class="remove-dropdown"></td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</main>

<script type="text/javascript">
	$(document).ready( function () {
		$('#listRecView').DataTable( {
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
					/** Filter Group for each column End **/

					/** Search for each column Start **/
					// var that = this;
					// var input = $('<input type="text" placeholder="Search" />')
					// .appendTo($(this.footer()).empty())

					// .on('keyup change', function() {
					// 	if (that.search() !== this.value) {
					// 		that
					// 		.search(this.value)
					// 		.draw();
					// 	}
					// });
					/** Search for each column End **/

				});
			}
		} );
	});	

	function trash(id) {
		var answer = confirm('Delete record Ctrl#'+id+' ?');
		if (answer) {
			window.location = '../../content/view/item/deteled.php?upidid=' + id;
		} 
	}
</script>