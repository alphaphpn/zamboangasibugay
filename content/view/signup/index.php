<?php

	if(empty($_SESSION["usercode"])) {
		
	} else {
		header('location:../../');
	}

	include_once "../../content/template-part/{$themename}/partner-navbar.php";
	include_once "../../inc/cnndb.php";
	include_once "../../inc/random-code/index.php";
	
?>

<div class="w360center">
	<div class="card mt-4">
		<div class="card-header text-center">
			<label>Signup</label>
			<div>
				<a href="../login" >Login</a> | <a href="">Refresh</a>
			</div>
		</div>
		<div class="card-body">
			<form method="post" class="needs-validation" novalidate>
				<div class="form-group">
					<div class="input-group mb-3">
						<input type="text" class="form-control" id="younickname" placeholder="Username (required)" name="younickname" required>
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>
				</div>

				<div class="form-group">
					<div class="input-group mb-3">
						<input type="text" class="form-control" id="xemail" placeholder="E-mail" name="xemail" required>
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>
				</div>

				<div class="form-group">
					<div class="input-group mb-3">
						<input type="text" class="form-control" id="xphone" placeholder="Phone" name="xphone" required>
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>
				</div>

				<div class="form-group">
					<div class="input-group mb-3" id="show_hide_password1">
						<input type="password" class="form-control" id="passcode1" value="<?php // echo $randSSPass; ?>" placeholder="New Password" name="passcode1" required>

						<!-- maxlength="254" minlength="5" pattern="(?=.*\d)(?=.*[A-Za-z]).{6,254}" oninvalid="this.setCustomValidity('Note: Password must contain letters and numbers. Minimum of 6 and Maximum of 254 character.')" oninput="this.setCustomValidity('')" -->

						<div class="input-group-prepend">
							<span class="input-group-text">
								<i class="fa fa-eye-slash" aria-hidden="true" onclick="PwHideShow1()"></i>
							</span>
						</div>
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
						<!-- div class="invalid-feedback">Note: Password must contain letters and numbers. Minimum of 6 and Maximum of 12 character.</div -->
					</div>
				</div>

				<!-- div class="form-group">
					<div class="input-group mb-3" id="show_hide_password2">
						<input type="password" class="form-control" id="passcode2" placeholder="Re-type Password" name="passcode2" required>
						<div class="input-group-prepend">
							<span class="input-group-text">
								<i class="fa fa-eye-slash" aria-hidden="true" onclick="PwHideShow2()"></i>
							</span>
						</div>
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>
				</div -->
				
				<div class="row">
					<div class="col-sm-6 mb-2">
						<a href="../../routes/login?glogin=1" class="btn btn-block btn-primary">Signup using GMail</a>
					</div>
					<div class="col-sm-6 mb-2">
						<button type="submit" class="btn btn-block btn-info" name="btnSubmit">Submit</button>
					</div>
				</div>
			</form>
			<?php include_once "../../inc/signup/index.php"; ?>
		</div>
		<div class="card-footer">
			<div class="row">
				<div class="col-sm-6 mb-2"></div>
				<div class="col-sm-6 mb-2 text-right">
					<a href="../../" class="text-dark text-decoration-none">
						<i>&#8592;</i> Back to Homepage
					</a>
				</div>
			</div>
		</div>
	</div>
</div>