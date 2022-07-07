<?php

	$tblname = "tbl_sysuser";
	$prim_id = "usercode";
	include_once "../../../inc/core.php";
	include_once "../../../inc/srvr.php";
	include_once "../../../inc/cnndb.php";
	$searchforx = trim($_GET['searchforx']);
	$qry = "SELECT * FROM {$tblname} WHERE fullname LIKE :searchforx OR {$prim_id} LIKE :searchforx AND deletedx=0 ORDER BY {$prim_id} DESC LIMIT :from_record_num, :records_per_page";
	$stmt = $cnn->prepare($qry);
	$stmt->bindValue(":searchforx", '%'.$searchforx.'%');
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

<table id="listRecView2" class="table table-hover">
	<thead>
		<tr>
			<th>No.</th>
			<th>Username</th>
			<th>Fullname</th>
			<th>e-mail</th>
			<th>Mobile</th>
			<th>Position</th>
			<th class="d-none">User Level</th>
			<th>Online</th>
			<th>Status</th>
			<th>Created by</th>
			<th>Modified</th>
			<th>Created</th>
			<th>User ID</th>
			<th class="text-right">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
			if ($num>0) {
				foreach ($stmt as $row) {
					$xno++;
					extract($row);
					echo '<tr>';
						echo "<td>".$xno."</td>";
						echo "<td>{$username}</td>";
						echo "<td>{$fullname}</td>";
						echo "<td>{$uemail}</td>";
						echo "<td>{$umobileno}</td>";
						echo "<td>{$xposition}</td>";
						echo "<td class='d-none'>{$ulevpos}</td>";
						echo "<td>{$uonline}</td>";
						echo "<td>{$ustatz}</td>";
						echo "<td>{$createdby}</td>";
						echo "<td>{$modified}</td>";
						echo "<td>{$created}</td>";
						echo "<td>{$usercode}</td>";
						echo "<td class='text-right'>";
							echo "<a href='../../routes/user/editupdate' class='btn-sm btn-success btn-inline' title='Edit'><span class='far fa-edit'></span></a>";
							echo "<a class='btn-sm btn-dark btn-inline' href='#' onclick='trash({$usercode})' title='Delete'><span class='fas fa-trash-alt'></span></a>";
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