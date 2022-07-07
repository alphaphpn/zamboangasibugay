<?php
	include_once "../../content/template-part/".$themename."/dashboard-navbar.php";
?>

<link rel="stylesheet" href="<?php echo $dirbak; ?>assets/datatables/1.11.3/css/jquery.dataTables.min.css">
<script src="<?php echo $dirbak; ?>assets/datatables/1.11.3/js/jquery.dataTables.min.js"></script>

<main class="page-content">
	<div class="container-fluid bg-light-opacity">
		<div class="d-flex">
			<h4 class="mr-2 mb-2">Homepage Banner</h4>
			<a href="../../routes/banner/addnew" class="btn btn-outline-info btn-sm mr-2 mb-2">Add New</a>
		</div>

		<div id="" class="table-responsive">
			<table id="listRecView" class="table table-striped table-hover">
				<thead>
					<tr>
						<th>No.</th>
						<th>Fieldtext</th>
						<th>Status</th>
						<th>Modified</th>
						<th>Created</th>
						<th>Ctrl#</th>
						<th class="text-right">Action</th>
					</tr>
				</thead>

				<tbody>
					<?php
						$tblname = "tblcrud";
						$prim_id = "id";
						$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
						$qry = "SELECT * FROM {$tblname} WHERE deletedx=0 ORDER BY {$prim_id} DESC";
						$stmt = $cnn->prepare($qry);
						$stmt->execute();
						$xno = 0;

						for($i=0; $row = $stmt->fetch(); $i++) {
							$xno++;
							$id2=$row['id'];
							$id=sprintf('%04d',$id2);
							$fieldtxt=$row['fieldtxt'];
							$status=$row['status'];
							$modified2=$row['modified'];
							$modified=date_format(new DateTime($modified2),'Y/m/d');
							$created2=$row['created'];
							$created=date_format(new DateTime($created2),'Y/m/d');
					?>

							<tr>
								<td><?php echo $xno; ?></td>
								<td data-filter="<?php echo $fieldtxt; ?>"><?php echo $fieldtxt; ?></td>
								<td data-filter="<?php echo $status; ?>"><?php echo $status; ?></td>
								<td data-filter="<?php echo $modified; ?>"><?php echo $modified; ?></td>
								<td data-filter="<?php echo $created; ?>"><?php echo $created; ?></td>
								<td><?php echo $id; ?></td>
								<td class="text-right tbl-action">
									<a href="../../routes/banner/editupdate?id=<?php echo $id; ?>" class="btn-sm btn-success btn-inline" title="Edit">
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
						<td>Fieldtext</td>
						<td>Status</td>
						<td>Modified</td>
						<td>Created</td>
						<td class="remove-dropdown">Ctrl#</td>
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
			window.location = '../../content/view/banner/deteled.php?upidid=' + id;
		} 
	}
</script>