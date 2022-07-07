<?php
	include_once "../../inc/webconfig/conf.php";
	include_once "../../content/theme/".$themename."/auth-navbar.php";
?>

<div class="p-2 text-right"><a href="" class="btn btn-small">Refresh</a></div>

<div class="w360center card mt-2">
	<div class="card-header">Forgot password</div>
	<div class="card-body">
		<label>Will send verification code to your</label>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Mobile No.</span>
			</div>
			<input id="cmobileno" type="text" class="form-control" name="cmobileno" autofocus required>
			<span class="input-group-addon">
				<span class="glyphicon glyphicon-calendar"></span>
			</span>
			<div class="valid-feedback">Valid.</div>
			<div class="invalid-feedback">Please fill out this field.</div>
		</div>
		<p>for you to be able to change your password.</p>
	</div>
	<div class="card-footer">
		<div class="row">
			<div class="col-sm-6 mb-2">
				<input type="submit" class="btn btn-block btn-info" name="btnSendCPNo" value="Send">
			</div>
			<div class="col-sm-6 mb-2">
				<a class="btn btn-block btn-dark" href="<?php echo $domainhome; ?>routes/login">Cancel</a>
			</div>
		</div>
	</div>
</div>