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
					if ($stat=='true') {
						$statusx = 1;
					} else {
						$statusx = 0;
					}
		
					$qry_update = "UPDATE {$tblname} SET 
						status	= '$statusx'
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

	// Update Field Lostfocus Function - Start
	if (isset($_GET['genid']) || isset($_GET['fieldtxt'])) {
		$genid = trim($_GET['genid']);
		$fieldtxt = trim($_GET['fieldtxt']);

		if ($_SESSION["ulevpos"]==1) {
			if (empty($fieldtxt) || empty($genid)) {
				echo '<script>alert("Empty record# not allowed.")</script>';
			} else {
				$qry_findid = "SELECT * FROM {$tblname} WHERE deletedx=0 AND {$prim_id}=:genid";
				$stmt_findid = $cnn->prepare($qry_findid);
				$stmt_findid->bindParam(':genid', $genid);
				$stmt_findid->execute();
				$rw_findid = $stmt_findid->rowCount();

				if ($rw_findid > 0) {
					$qry_update = "UPDATE {$tblname} SET 
						fieldtxt	= '$fieldtxt'
						WHERE 
						{$prim_id}	= '$genid'
						";
					$cnn->exec($qry_update);
					echo '<script>alert("Field with Record#'.$genid.' successfully updated.")</script>';
				} else {
					echo '<script>alert("Record#'.$genid.' not found!")</script>';
				}
			}
		} else {
			echo '<script>alert("Access Denied!")</script>';
			$msgx = 'Access Denied!';
		}
	}
	// Update Field Lostfocus Function - End

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
						<th></th>
						<th class="remove-dropdown d-none"></th>
						<th></th>
						<th class="remove-dropdown d-none"></th>
						<th class="remove-dropdown"></th>
						<th class="remove-dropdown"></th>
						<th class="remove-dropdown"></th>
						<th class="remove-dropdown"></th>
					</tr>
				</thead>

				<thead id="theadtitle" class="thead-dark">
					<tr>
						<th>No.</th>
						<th class="d-none">Fieldtext</th>
						<th>Fieldtext</th>
						<th class="d-none">Status</th>
						<th>Status</th>
						<th>Modified</th>
						<th>Created</th>
						<th>Ctrl#</th>
						<th class="text-right">Action</th>
					</tr>
				</thead>

				<tbody>
					<?php
						$qry = "SELECT * FROM {$tblname} WHERE deletedx=0 ORDER BY {$prim_id} DESC";
						$stmt = $cnn->prepare($qry);
						$stmt->execute();
						$xno = 0;

						for($i=0; $row = $stmt->fetch(); $i++) {
							$xno++;
							// remove this part on creating another CRUD - start
							$id=$row[$prim_id];
							// remove this part on creating another CRUD - end

							// add variable depending on table field name
							$fieldtxt=$row['fieldtxt'];

							// do not change this part - start
							$status=$row['status'];
								if ($status==1) {
									$statusx = 'true';
									$rbsTxtColor = 'text-primary';
								} else {
									$statusx = 'false';
									$rbsTxtColor = 'text-danger';
								}
							$modified2=$row['modified'];
							$modified=date_format(new DateTime($modified2),'Y/m/d');
							$created2=$row['created'];
							$created=date_format(new DateTime($created2),'Y/m/d');
							// do not change this part - end
					?>

							<tr>
								<td><?php echo $xno; ?></td>

								<!-- Data Fields base on Database Table - Start -->
								<td class="d-none" data-filter="<?php echo $fieldtxt; ?>"><?php echo $fieldtxt; ?></td>
								<td>
									<input id="rc<?php echo $id; ?>" type="text" name="fieldtxt" value="<?php echo $fieldtxt; ?>" data1="<?php echo $fieldtxt; ?>" dataid="<?php echo $id; ?>" class="w-100" onblur="fnChngeFieldTxt(this.id,this.value);">
								</td>
								<!-- Data Fields base on Database Table - End -->
								
								<td class="<?php echo $rbsTxtColor; ?> d-none" data-filter="<?php echo $statusx; ?>"><?php echo $statusx; ?></td>
								<td data-filter="<?php echo $status; ?>">
									<select id="sl<?php echo $id; ?>" name="status" dataid="<?php echo $id; ?>" class="<?php echo $rbsTxtColor; ?>" onchange="fnChngeStatus(this.id,this.value);">
										<option value="false" class="text-danger" <?php if($statusx=='false') echo 'selected="selected"'; ?>>false</option>
										<option value="true" class="text-info" <?php if($statusx=='true') echo 'selected="selected"'; ?>>true</option>
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
						<td class="remove-dropdown d-none"></td>
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
					var that = this;
					var input = $('<input type="text" placeholder="Search" />')
					.appendTo($(this.header()).empty())

					.on('keyup change', function() {
						if (that.search() !== this.value) {
							that
							.search(this.value)
							.draw();
						}
					});
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

	// Update Field Lostfocus Function - Start
	function fnChngeFieldTxt(id,fieldtxt) {
		var data = document.getElementById(id).getAttribute('data1');
		var dataid = document.getElementById(id).getAttribute('dataid');
		let text = fieldtxt;
		let result = text.trim();
		if (data==fieldtxt) {
			console.log('Dili ma save kay wala kay ge edit');
		} else if (result == '') {
			console.log('Dili pwde kay walay sulod.');
		} else {
			var ans_fieldtxt = confirm('Update fieldtext on record Ctrl#'+dataid+' ?');
			if (ans_fieldtxt) {
				const xhttp_fieldtxt = new XMLHttpRequest();
				xhttp_fieldtxt.onload = function() {
					
				}
				xhttp_fieldtxt.open("GET", "?genid="+dataid+"&fieldtxt="+fieldtxt, true);
				xhttp_fieldtxt.send();
			}
		}
	}
	// Update Field Lostfocus Function - End

	// Update Status OnChange Function - Start
	function fnChngeStatus(id,stat) {
		var elidx = document.getElementById(id);
		var dataidx = document.getElementById(id).getAttribute('dataid');
		
		var ans_stat = confirm('Update status on record Ctrl#'+dataidx+' ?');
		if (ans_stat) {
			const xhttp_status = new XMLHttpRequest();
			xhttp_status.onload = function() {
				console.log(id, stat, dataidx);
				if (stat=='true') {
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