<?php

	// theme:	-default
	if(empty($_SESSION["usercode"]) || empty($_SESSION["username"]) || empty($_SESSION["fullname"]) || empty($_SESSION["ulevpos"]) || empty($_SESSION["surname"]) || empty($_SESSION["firstname"]) || empty($_SESSION["middlename"]) || empty($_SESSION["postitle"])) {
	} else {
		header('location:../../');
	}

	include_once "../../content/theme/".$themename."/auth-navbar.php";

	if (empty($customlinkregister)) {
		$reglinkurl = "../signup";
	} else {
		$reglinkurl = $customlinkregister;
	}

?>

<script type="text/javascript">
	$(document).ready(function(){
		const $_GET = {};
		const args = location.search.substr(1).split(/&/);
		for (let i=0; i<args.length; ++i) {
			const tmp = args[i].split(/=/);
			if (tmp[0] != "") {
				$_GET[decodeURIComponent(tmp[0])] = decodeURIComponent(tmp.slice(1).join("").replace("+", " "));
				console.log(`${$_GET['glogin']}`);
				xtruegmail = $_GET[decodeURIComponent(tmp[0])];
				if (xtruegmail=1) {
					$('#loginpost').addClass('d-none');
					$('#ifregnorm').removeClass('d-none');
					$("#glogin").detach().appendTo('#cardLogin');
					$('#glogin').addClass('border border-warning rounded-lg m-auto');
					$('#glogin').removeClass('position-absolute');
					$('.card-footer .col-sm-6.mb-2.text-right').addClass('d-flex');

				}
			}//::END if
		}//::END for
	});
</script>

<div class="container">
	<div class="w360center">
		<div class="card mt-4">
			<div class="card-header text-center">
				<label id="loggdas"><a href="../login" class="btn">Login</a></label>
				<a id="therefresh" href="" class="position-absolute mr-3" style="right: 0;">Refresh</a>
				<div class="login-mlogo">
					<img src="<?php echo $domainhome.'content/theme/'.$themename.'/storage/img/'.$navbarlogo; ?>">
				</div>
			</div>
			<!-- //console.cloud.google.com/projectselector2/apis/dashboard -->
			<div id="glogin" class="g-signin2 position-absolute m-auto" data-onsuccess="onSignIn" data-theme="dark" style="width: max-content;"></div>
			<div id="cardLogin" class="card-body">
				<form id="loginpost" method="post" class="needs-validation" novalidate>
					<div class="form-group">
						<label for="username">Username | e-mail:</label>
						<div class="input-group mb-3">
							<input type="text" class="form-control" id="username" placeholder="Username | e-mail" name="username" autofocus required>
							<div class="valid-feedback">Valid.</div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>

					<div class="form-group">
						<label for="passcode">Password:</label>
						<div class="input-group mb-3" id="show_hide_password">
							<input type="password" class="form-control password" id="passcode" placeholder="Password" name="passcode"  required>
							<div class="input-group-prepend">
								<span class="input-group-text">
									<i class="fa fa-eye-slash" aria-hidden="true" onclick="PwHideShow()"></i>
								</span>
							</div>
							<div class="valid-feedback">Valid.</div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>

					<?php include_once "../../inc/login/index.php"; ?>

					<div class="row">
						<div class="col-sm-6 mb-2">
							<a href="<?php echo $reglinkurl; ?>" class="btn btn-block btn-primary">
								Register<i class='fas fa-user-plus'></i>
							</a>
						</div>
						<div class="col-sm-6 mb-2">
							<button type="submit" class="btn btn-block btn-secondary" name="btnLogin">Login <i class='fas fa-key'></i></button>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-6 mb-2">
							<a href="#" onclick="fnforgotpw(document.getElementById('username').value)">Forgot password?</a>
						</div>
						<div class="col-sm-6 mb-2"></div>
					</div>
				</form>

				<form id="signincurr" method="post" style="display: none;">
					<div class="form-group">
						<div class="input-group mb-3">
							<img id="imgogsrc2" class="img-thumbnail">
						</div>
					</div>
					<div class="form-group text-center">
						<label id="gmailz" for="gmailz"></label>
						<p id="yrfullnem" for="yrfullnem"></p>
					</div>
					<div class="form-group d-none">
						<div class="input-group mb-3">
							<input type="text" class="form-control" id="imgurl2" name="imgurl2" readonly required>
						</div>
					</div>
					<div class="form-group d-none">
						<div class="input-group mb-3">
							<input type="text" class="form-control" id="gogid" name="gogid" readonly required>
						</div>
					</div>
					<div class="form-group d-none">
						<div class="input-group mb-3">
							<input type="text" class="form-control" id="username2" name="username2" readonly required>
						</div>
					</div>
					<div class="form-group d-none">
						<div class="input-group mb-3">
							<input type="text" class="form-control" id="email2" name="email2" readonly required>
						</div>
					</div>
					<div class="form-group d-none">
						<div class="input-group mb-3">
							<input type="text" class="form-control" id="fullname2" name="fullname2" readonly required>
						</div>
					</div>
					<div class="form-group d-none">
						<div class="input-group mb-3">
							<input type="text" class="form-control" id="lastname2" name="lastname2" readonly required>
						</div>
					</div>
					<div class="form-group d-none">
						<div class="input-group mb-3">
							<input type="text" class="form-control" id="firstname2" name="firstname2" readonly required>
						</div>
					</div>
					<div class="form-group d-none">
						<div class="input-group mb-3">
							<textarea class="form-control" id="tokenidz2" name="tokenidz2" readonly required></textarea>
						</div>
					</div>
					<?php
						include_once "../../inc/logingoogle/index.php";
					?>
					<div class="form-group text-center">
						<button type="submit" class="btn btn-block btn-primary" name="btnGContin">Continue <i class='fab fa-google'></i></button>
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="row">
					<div class="col-sm-12 mb-2 text-right">
						<a href="../signup" id="ifregnorm" class="btn d-none">
							<i>&#8594;</i> Signup
						</a>
						<a id="loginbkhome" href="../../" class="btn">
							<i>&#8592;</i> Homepage
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>