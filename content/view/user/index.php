<?php
	include_once "../../content/template-part/{$themename}/dashboard-navbar.php";
	include_once "../../content/template-part/{$themename}/dashboard-navbar-top.php";

	// Update Status OnChange Function - Start
	if (isset($_GET['stat'])) {
		$idwaley = trim($_GET['idwaley']);
		$stat = trim($_GET['stat']);

		if ($_SESSION["ulevpos"]==1) {
			if (empty($idwaley) || empty($stat)) {
				echo '<script>alert("Empty record# not allowed.")</script>';
			} else {
				$qry_findid = "SELECT * FROM {$tblname} WHERE deletedx=0 AND {$prim_id}=:idwaley";
				$stmt_findid = $cnn->prepare($qry_findid);
				$stmt_findid->bindParam(':idwaley', $idwaley);
				$stmt_findid->execute();
				$rw_findid = $stmt_findid->rowCount();

				if ($rw_findid > 0) {
					if ($stat=='Enabled') {
						$statusx = 1;
					} else {
						$statusx = 0;
					}
		
					$qry_update = "UPDATE {$tblname} SET 
						ustatz	= '$statusx'
						WHERE 
						{$prim_id}	= '$idwaley'
						";
					$cnn->exec($qry_update);
					echo '<script>alert("Status on Record#'.$idwaley.' successfully updated.")</script>';
				} else {
					echo '<script>alert("Record#'.$idwaley.' not found!")</script>';
				}
			}
		} else {
			echo '<script>alert("Access Denied!")</script>';
			$msgx = 'Access Denied!';
		}
	}
	// Update Status OnChange Function - End

	// Delete Function - Start
	if (isset($_GET['btnDelete'])) {
		$upidid = trim($_GET['btnDelete']);

		if ($_SESSION["ulevpos"]==1) {
			if (empty($upidid)) {
				echo '<script>alert("Empty record# not allowed.")</script>';
			} else {
				$qry_findid = "SELECT * FROM {$tblname} WHERE deletedx=0 AND {$prim_id}=:upidid";
				$stmt_findid = $cnn->prepare($qry_findid);
				$stmt_findid->bindParam(':upidid', $upidid);
				$stmt_findid->execute();
				$rw_findid = $stmt_findid->rowCount();

				if ($rw_findid > 0) {
					$qry = "UPDATE {$tblname} SET deletedx=1 WHERE {$prim_id}=:upidid";
					$stmt = $cnn->prepare($qry);
					$stmt->bindParam(':upidid', $upidid);
					$stmt->execute();
					echo '<script>alert("Record#'.$upidid.' successfully deleted.")</script>';
				} else {
					echo '<script>alert("Record#'.$upidid.' not found!")</script>';
				}
			}
		} else {
			echo '<script>alert("Access Denied!")</script>';
			$msgx = 'Access Denied!';
		}
	}
	// Delete Function - End

	// Function - Start
	// Function - End
?>

<link rel="stylesheet" href="<?php echo $dirbak; ?>assets/datatables/1.11.3/css/jquery.dataTables.min.css">
<script src="<?php echo $dirbak; ?>assets/datatables/1.11.3/js/jquery.dataTables.min.js"></script>

<style type="text/css">
	.table-responsive select {
		min-width: 80px;
	}

	.table-responsive .table thead th {
		vertical-align: unset;
	}
</style>

<main class="page-content">
	<div class="container-fluid">
		<div class="d-flex">
			<h4 class="mr-2 mb-2"><?php echo $page_title; ?></h4>
			<a href="../../routes/<?php echo $foldername; ?>/addnew" class="btn btn-outline-info btn-sm mr-2 mb-2" style="z-index: 1">Add New</a>
		</div>

		<div id="" class="table-responsive">
			<table id="listRecView" class="table table-striped table-hover table-sm">
				<thead id="remSortH">
					<tr>
						<th class="remove-dropdown"></th>
						<th class="remove-dropdown"></th>
						<th class="remove-dropdown"></th>
						<th class="remove-dropdown"></th>
						<th class="remove-dropdown"></th>
						<th class="remove-dropdown"></th>
						<th></th>
						<th class="remove-dropdown d-none"></th>
						<th></th>
						<th></th>

						<th class=""></th>
						<th class="remove-dropdown d-none"></th>
						<th class="remove-dropdown"></th>
						<th class="remove-dropdown"></th>
						<th class="remove-dropdown"></th>
						<th class="remove-dropdown"></th>
					</tr>
				</thead>

				<thead id="theadtitle" class="thead-dark">
					<tr>
						<th class="align-middle">No.</th>
						<th class="align-middle">Company</th>
						<th class="align-middle">Username</th>
						<th class="align-middle">Fullname</th>
						<th class="align-middle">e-mail</th>
						<th class="align-middle">Mobile</th>
						<th class="align-middle">Position</th>
						<th class="align-middle d-none">User Level</th>
						<th class="align-middle">Online</th>
						<th class="align-middle">Created by</th>

						<th class="align-middle d-none">Status</th>
						<th class="align-middle">Status</th>
						<th class="align-middle">Modified</th>
						<th class="align-middle">Created</th>
						<th class="align-middle">ID</th>
						<th class="text-right align-middle">Action</th>
					</tr>
				</thead>

				<tbody>
					<?php
						if ($_SESSION["ulevpos"]==1) {
							$qry = "SELECT * FROM {$tblname} WHERE deletedx=0 ORDER BY {$prim_id} DESC";
							$stmt = $cnn->prepare($qry);
						} else {
							$qry = "SELECT * FROM {$tblname} WHERE createdby=:createdby AND deletedx=0 ORDER BY {$prim_id} DESC";
							$stmt = $cnn->prepare($qry);
							$stmt->bindParam(':createdby', $uid);
						}
						
						$stmt->execute();
						$xno = 0;

						for($i=0; $row = $stmt->fetch(); $i++) {
							$xno++;
							// remove this part on creating another CRUD - start
							$id=$row[$prim_id];
							// remove this part on creating another CRUD - end

							// add variable depending on table field name
							$company=$row['cmpny'];
							$username=$row['username'];
							$fullname=$row['fullname'];
							$uemail=$row['uemail'];
							$umobileno=$row['umobileno'];
							$xposition=$row['xposition'];
							$ulevpos=$row['ulevpos'];
							$createdby=$row['createdby'];

							$uonline=$row['uonline'];
								if ($uonline==0) {
									$uonlinex = 'Offline';
									$rbuTxtColor = 'text-danger';
								} else {
									$uonlinex = 'Online';
									$rbuTxtColor = 'text-primary';
								}
							// do not change this part - start
							$status=$row['ustatz'];
								if ($status==0) {
									$statusx = 'Disabled';
									$rbsTxtColor = 'text-danger';
								} else {
									$statusx = 'Enabled';
									$rbsTxtColor = 'text-primary';
								}
							$modified2=$row['modified'];
							$modified=date_format(new DateTime($modified2),'Y/m/d');
							$created2=$row['created'];
							$created=date_format(new DateTime($created2),'Y/m/d');
							// do not change this part - end
					?>

							<tr>
								<td><?php echo $xno; ?></td>

								<td class="" data-filter="<?php echo $company; ?>"><?php echo $company; ?></td>
								<td class="" data-filter="<?php echo $username; ?>"><?php echo $username; ?></td>
								<td class="" data-filter="<?php echo $fullname; ?>"><?php echo $fullname; ?></td>
								<td class="" data-filter="<?php echo $uemail; ?>"><?php echo $uemail; ?></td>
								<td class="" data-filter="<?php echo $umobileno; ?>"><?php echo $umobileno; ?></td>
								<td class="" data-filter="<?php echo $xposition; ?>"><?php echo $xposition; ?></td>
								<td class="d-none" data-filter="<?php echo $ulevpos; ?>"><?php echo $ulevpos; ?></td>
								<td class="<?php echo $rbuTxtColor; ?>" data-filter="<?php echo $uonlinex; ?>"><?php echo $uonlinex; ?></td>
								<td class="" data-filter="<?php echo $createdby; ?>"><?php echo $createdby; ?></td>

								<td class="<?php echo $rbsTxtColor; ?> d-none" data-filter="<?php echo $statusx; ?>"><?php echo $statusx; ?></td>
								<td data-filter="<?php echo $status; ?>">
									<select id="sl<?php echo $id; ?>" name="status" dataid="<?php echo $id; ?>" class="<?php echo $rbsTxtColor; ?>" onchange="fnChngeStatus(this.id,this.value);">
										<option value="Disabled" class="text-danger" <?php if($statusx=='Disabled') echo 'selected="selected"'; ?>>Disabled</option>
										<option value="Enabled" class="text-info" <?php if($statusx=='Enabled') echo 'selected="selected"'; ?>>Enabled</option>
									</select>
								</td>

								<!-- do not touch here -->
								<td data-filter="<?php echo $modified; ?>"><?php echo $modified; ?></td>
								<td data-filter="<?php echo $created; ?>"><?php echo $created; ?></td>
								<td><?php echo $id; // this is the primary_id ?></td>
								<td class="text-right tbl-action">
									<a href="../../routes/<?php echo $foldername; ?>/editupdate?id=<?php echo $id; ?>" class="btn-sm btn-success btn-inline" title="Edit">
										<span class="far fa-edit"></span>
									</a>
									<button id="btn<?php echo $id; ?>" type="button" name="btnDelete" dataid="<?php echo $id; ?>" class="btn-sm btn-dark btn-inline ml-1" onclick="trash(this.id);"><span class="fas fa-trash-alt"></span></button>
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
						<td class="remove-dropdown"></td>
						<td class="remove-dropdown"></td>
						<td class="remove-dropdown"></td>
						<td class="remove-dropdown"></td>
						<td class="remove-dropdown d-none"></td>
						<td class="remove-dropdown"></td>
						<td class="remove-dropdown"></td>

						<td class="remove-dropdown d-none"></td>
						<td class="remove-dropdown"></td>
						<td class="remove-dropdown"></td>
						<td class="remove-dropdown"></td>
						<td class="remove-dropdown"></td>
						<td class="remove-dropdown"></td>
					</tr>
				</tfoot>
			</table>
		</div>

		<div id="trnsfrPaginate" class="dataTables_wrapper"></div>
		<div id="demo"></div>
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

					/** Search for each column Start **/
					// var that = this;
					// var input = $('<input type="text" placeholder="Search" />')
					// .appendTo($(this.header()).empty())

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
		});

		$("#listRecView_info, #listRecView_paginate").detach().appendTo('#trnsfrPaginate');

		$(".remove-dropdown select").remove();
		$(".remove-dropdown").removeClass('sorting');
		$(".remove-dropdown").removeClass('sorting_asc');
		$(".remove-dropdown").removeClass('sorting_desc');

		$('.table-responsive table.dataTable thead .sorting').on('click', function(event) {
			$(".remove-dropdown select").remove();
			$(".remove-dropdown").removeClass('sorting');
			$(".remove-dropdown").removeClass('sorting_asc');
			$(".remove-dropdown").removeClass('sorting_desc');
		});
	});

	// Function - Start
	// Function - End

	// Delete Function - Start
	function trash(id) {
		var dataid = document.getElementById(id).getAttribute('dataid');
		var answer = confirm('Delete record Ctrl#'+dataid+' ?');
		if (answer) {
			const xhttp = new XMLHttpRequest();
			xhttp.onload = function() {
				location.reload();
			}
			xhttp.open("GET", "?btnDelete="+dataid, true);
			xhttp.send();
		}
	}
	// Delete Function - End

	// Update Status OnChange Function - Start
	function fnChngeStatus(id,stat) {
		var elidx = document.getElementById(id);
		var dataidx = document.getElementById(id).getAttribute('dataid');
		
		var ans_stat = confirm('Update status on record Ctrl#'+dataidx+' ?');
		if (ans_stat) {
			const xhttp_status = new XMLHttpRequest();
			xhttp_status.onload = function() {
				console.log(id, stat, dataidx);
				if (stat=='Enabled') {
					console.log(stat);
					elidx.classList.remove("text-danger");
					elidx.classList.add("text-primary");
				} else {
					console.log(stat);
					elidx.classList.remove("text-primary");
					elidx.classList.add("text-danger");
				}
			}
			xhttp_status.open("GET", "?idwaley="+dataidx+"&stat="+stat, true);
			xhttp_status.send();
		}
	}
	// Update Status OnChange Function - End
</script>