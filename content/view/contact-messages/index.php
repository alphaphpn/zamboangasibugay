<?php
	include_once "../../content/template-part/{$themename}/dashboard-navbar.php";
?>

<link rel="stylesheet" href="<?php echo $dirbak; ?>assets/datatables/1.11.3/css/jquery.dataTables.min.css">
<script src="<?php echo $dirbak; ?>assets/datatables/1.11.3/js/jquery.dataTables.min.js"></script>

<main class="page-content">
	<div class="container-fluid bg-light-opacity">
		<div class="d-flex">
			<h4 class="mr-2 mb-2">Message(s) | Inquiry | Comment(s) | Suggestion</h4>
		</div>

		<div id="" class="table-responsive">
			<table id="listRecView" class="table table-striped table-hover">
				<thead>
					<tr>
						<th>No.</th>
						<th>Subject</th>
						<th>Message</th>
						<th>Name</th>
						<th>E-mail</th>
						<th>Phone</th>
						<th>Date</th>
						<th class="d-none">Ctrl#</th>
						<th class="text-right">Action</th>
					</tr>
				</thead>

				<tbody>
					<?php
						$tblname = "tbl_contactform";
						$prim_id = "id";
						$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
						$qry = "SELECT * FROM {$tblname} WHERE theme_name=:themename AND deleted=0 ORDER BY {$prim_id} DESC";
						$stmt = $cnn->prepare($qry);
						$stmt->bindParam(':themename', $themename);
						$stmt->execute();
						$xno = 0;

						for($i=0; $row = $stmt->fetch(); $i++) {
							$xno++;
							$id=$row['id'];
							$subject=$row['subject'];
							$message=$row['message'];
							$fullname=$row['fullname'];
							$email=$row['email'];
							$phone=$row['phone'];
							$date=$row['created'];
							$date2=date_format(new DateTime($date),'Y/m/d');
					?>

							<tr>
								<td><?php echo $xno; ?></td>
								<td data-filter="<?php echo $subject; ?>"><?php echo $subject; ?></td>
								<td data-filter="<?php echo $message; ?>"><?php echo $message; ?></td>
								<td data-filter="<?php echo $fullname; ?>"><?php echo $fullname; ?></td>
								<td data-filter="<?php echo $email; ?>">
									<a href="mailto:<?php echo $email; ?>" target="_blank"><?php echo $email; ?></a>
								</td>
								<td data-filter="<?php echo $phone; ?>">
									<a href="tel:<?php echo $phone; ?>" target="_blank"><?php echo $phone; ?></a>
								</td>
								<td data-filter="<?php echo $date2; ?>"><?php echo $date2; ?></td>
								<td class="d-none"><?php echo $id; ?></td>
								<td class="text-right tbl-action">
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
						<td class="remove-dropdown">No.</td>
						<td>Subject</td>
						<td>Message</td>
						<td>Name</td>
						<td>E-mail</td>
						<td>Phone</td>
						<td>Date</td>
						<td class="d-none remove-dropdown">Ctrl#</td>
						<td class="remove-dropdown">Action</td>
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

				});
			}
		} );
	});	

	function trash(id) {
		var answer = confirm('Delete record Ctrl#'+id+' ?');
		if (answer) {
			window.location = '../../content/view/contact-messages/deteled.php?upidid=' + id;
		} 
	}
</script>