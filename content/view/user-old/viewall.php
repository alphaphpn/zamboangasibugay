<?php

	$tblname = "tbl_sysuser";
	$prim_id = "usercode";
	include_once "../../inc/cnndb.php";
	$qry = "SELECT username, fullname, uemail, umobileno, xposition, ulevpos, uonline, ustatz, createdby, modified, created, {$prim_id} FROM {$tblname} WHERE deletedx=0 ORDER BY {$prim_id} DESC LIMIT :from_record_num, :records_per_page";
	$stmt = $cnn->prepare($qry);
	$stmt->bindParam(":from_record_num", $from_record_num, PDO::PARAM_INT);
	$stmt->bindParam(":records_per_page", $records_per_page, PDO::PARAM_INT);
	$stmt->execute();
	$num = $stmt->rowCount();
	$xno = $from_record_num;

	$qry_page = "SELECT COUNT(*) AS total_rows FROM {$tblname}";
	$stmt_page = $cnn->prepare($qry_page);
	$stmt_page->execute();
	$row_page = $stmt_page->fetch(PDO::FETCH_ASSOC);
	$total_rows = $row_page['total_rows'];

	$page_url="?";
	
?>

<table id="listRecView" class="table table-hover">
	<thead>
		<tr>
			<th class="align-middle">No.</th>
			<th class="align-middle">Username</th>
			<th class="align-middle">Fullname</th>
			<th class="align-middle">e-mail</th>
			<th class="align-middle">Mobile</th>
			<th class="align-middle">Position</th>
			<th class="align-middle d-none">User Level</th>
			<th class="align-middle">Online</th>
			<th class="align-middle">Status</th>
			<th class="align-middle">Created by</th>
			<th class="align-middle">Date Modified</th>
			<th class="align-middle">Date Created</th>
			<th class="align-middle">User ID</th>
			<th class="text-right align-middle">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
			if ($num>0) {
				foreach ($stmt as $row) {
					$xno++;
					extract($row);
					if ($uonline==0) {
						$youonoff = "Offline";
					} else {
						$youonoff = "Online";
					}

					if ($ustatz==0) {
						$youstatx = "Disabled";
					} else {
						$youstatx = "Enabled";
					}
					echo '<tr>';
						echo "<td>".$xno."</td>";
						echo "<td>{$username}</td>";
						echo "<td>{$fullname}</td>";
						echo "<td><a href='mailto:{$uemail}' target='_blank'>{$uemail}</a></td>";
						echo "<td><a href='#' title='{$umobileno}' onclick='FnPhoneURLTarget(this);'>{$umobileno}</a></td>";
						echo "<td>{$xposition}</td>";
						echo "<td class='d-none'>{$ulevpos}</td>";
						echo "<td>{$youonoff}</td>";
						echo "<td>{$youstatx}</td>";
						echo "<td>{$createdby}</td>";
						echo "<td>{$modified}</td>";
						echo "<td>{$created}</td>";
						echo "<td>{$usercode}</td>";
						echo "<td class='text-right tbl-action'>";
							echo "<a href='../../routes/user/editupdate?id={$usercode}' class='btn-sm btn-success btn-inline' title='Edit'><span class='far fa-edit'></span></a>";
							echo "<a href='../../content/view/user/deteled.php?upidid={$usercode}' class='btn-sm btn-dark btn-inline ml-1' title='Delete'><span class='fas fa-trash-alt'></span></a>";
						echo '</td>';
					echo '</tr>';
				}
			} else {
				echo '<tr>';
					echo '<td colspan="6">No record found.</td>';
				echo '</tr>';
			}
		?>
	</tbody>
</table>