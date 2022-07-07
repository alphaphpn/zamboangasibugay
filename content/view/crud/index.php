<?php
	include_once "../../content/template-part/{$themename}/dashboard-navbar.php";
	include_once "../../content/template-part/{$themename}/dashboard-navbar-top.php";
?>

<script>
	function showResult(str) {
		if (str == "") {
			location.reload();
		} else {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("viewRecordz").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET", "../../content/view/crud/filter.php?searchforx=" + str, true);
			xmlhttp.send();
		}
	}

	function grpResult(str) {
		if (str == "") {
			location.reload();
		} else {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("viewRecordz").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET", "../../content/view/crud/groupby.php?groupbyx=" + str, true);
			xmlhttp.send();
		}
	}

	function dateResultx(str) {
		if (str == "") {
			location.reload();
		} else {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("viewRecordz").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET", "../../content/view/crud/grpbydate.php?fltrbydate=" + str, true);
			xmlhttp.send();
		}
	}

	function trash(id) {
		var answer = confirm('Delete record Ctrl#'+id+' ?');
		if (answer) {
			window.location = '../../content/view/crud/deteled.php?upidid=' + id;
		} 
	}
</script>

<main class="page-content">
	<div class="container-fluid bg-light-opacity">
		<div class="d-flex">
			<h4 class="mr-2 mb-2">CRUD</h4>
			<a href="../../routes/crud/addnew" class="btn btn-outline-info btn-sm mr-2 mb-2" style="z-index: 1">Add New</a>

			<div class="mr-2">
				<form>
					<div class="input-group input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">Filter</span>
						</div>
						<input type="text" class="form-control" id="searchforx" name="searchforx" onkeyup="showResult(this.value);" placeholder="by text">
					</div>
				</form>
			</div>

			<div class="mr-2">
				<form>
					<div class="input-group input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">Group by</span>
						</div>
						<input type="text" class="form-control" id="groupbyx" name="groupbyx" onkeyup="grpResult(this.value);" list="lstgroupby" placeholder="text">
						<datalist id="lstgroupby">
							<?php
								$tblname = "tbl_crud";
								$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
								$qry_grpby = $cnn->prepare("SELECT fieldtxt FROM {$tblname} WHERE deletedx=0 GROUP BY fieldtxt ORDER BY fieldtxt ASC");
								$qry_grpby->execute();
								$rslt_grpby = $qry_grpby->setFetchMode(PDO::FETCH_ASSOC);
								foreach ($qry_grpby as $row_grpby) {
									echo "<option value='".$row_grpby['fieldtxt']."'>";
								}
							?>
						</datalist>
					</div>
				</form>
			</div>

			<div class="mr-2">
				<form>
					<div class="input-group input-group-sm date" id="datetimepicker1">
						<div class="input-group-prepend">
							<span class="input-group-text">Date filter</span>
						</div>
						<input type="date" class="form-control" id="fltrbydate" name="fltrbydate" onchange="dateResultx(this.value);">
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
						</span>
					</div>
				</form>
			</div>
		</div>

		<div id="viewRecordz" class="table-responsive-sm">
			<?php
				include_once "viewall.php";
			?>
		</div>
	</div>
</main>