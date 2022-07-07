<?php
	include_once "../../inc/webconfig/conf.php";
	include_once "../../content/theme/".$themename."/auth-navbar.php";

	$useremail = isset($_GET['usemail']) ? $_GET['usemail'] : header('Location:../../');
?>

<div class="p-2 text-right"><a href="" class="btn btn-small">Refresh</a></div>

<div class="w360center card mt-2">
	<div class="card-header">Forgot password?</div>
	<div class="card-body">
		<label>Select ways to recover account:</label>
		<ul>
			<li><a href="<?php echo $domainhome.'routes/forgotpwsquestion?usermail='.$useremail; ?>">Security Question</a></li>
			<li><a href="<?php echo $domainhome.'routes/forgotpwmobile?usermail='.$useremail; ?>">Send Verification Code thru Mobile Phone</a> <small>(not available)</small></li>
			<li><a href="#">Send Verification Code thru E-mail</a> <small>(not available)</small></li>
		</ul>
	</div>
	<div class="card-footer">
		<div class="row">
			<div class="col-sm-6 mb-2"></div>
			<div class="col-sm-6 mb-2">
				<a class="btn btn-block btn-dark" href="<?php echo $domainhome; ?>routes/login">Cancel</a>
			</div>
		</div>
	</div>
</div>