<?php
	include_once "../../inc/webconfig/conf.php";
	include_once "../../content/theme/".$themename."/auth-navbar.php";
	$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
?>

<div class="p-2 text-right"><a href="" class="btn btn-small">Refresh</a></div>

<div class="w360center card mt-2">
	<div class="card-header">Security Question</div>
	<div class="card-body">
		<form id="securequest" method="post" class="needs-validation" novalidate>
			<label>Select security question</label>
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text">Question</span>
				</div>
				<input type="text" class="form-control" id="hsecquest" placeholder="Security Question" name="hsecquest" autofocus required list="hsecquestList">
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>

				<datalist id="hsecquestList">
				<?php
					$stmtsecquest = $cnn->prepare("SELECT * FROM tbl_secquest GROUP BY secquest ORDER BY secquest ASC");
					$stmtsecquest->execute();
					$resultsecquest = $stmtsecquest->setFetchMode(PDO::FETCH_ASSOC);
					foreach ($stmtsecquest as $rowsecquest) {
						echo "<option value='".$rowsecquest['secquest']."'>";
					}
				?>
				</datalist>
			</div>

			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text">Answer</span>
				</div>
				<input type="text" class="form-control" id="secansw" placeholder="Security Answer" name="secansw" autofocus required>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>

			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text">Enter your password</span>
				</div>
				<input type="text" class="form-control" id="entpasscode" placeholder="New Password" name="entpasscode" autofocus required>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>
			<p>for you to be able to change your password.</p>

			<?php include_once "../../inc/forgotpwsquestion/index.php"; ?>
	</div>
	<div class="card-footer">
		<div class="row">
			<div class="col-sm-6 mb-2">
				<input type="submit" class="btn btn-block btn-info" name="btnSecQuest" value="Send">
			</div>
			</form>
			<div class="col-sm-6 mb-2">
				<a class="btn btn-block btn-dark" href="<?php echo $domainhome; ?>routes/login">Cancel</a>
			</div>
		</div>
	</div>
</div>