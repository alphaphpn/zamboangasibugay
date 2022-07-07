<?php
	include_once "../../content/theme/".$themename."/auth-navbar.php";

	if(empty($_SESSION["usercode"])) {
		header("location:../../");
	} else {
		$curr_uidzer = $_SESSION["usercode"];
	}

	if ($_SESSION["gogfirstime"]==1) {
		header("location:../../");
	}
?>

<div class="container">
	<div class="w360center">
		<div class="card mt-4">
			<div class="card-header text-center">
				<label>Change Password</label>
				<a href="" class="position-absolute mr-3" style="right: 0;">Refresh</a>
			</div>
			<div class="card-body">
				<form method="post" class="needs-validation" novalidate>
					<div class="form-group">
						<label for="passcode">Current Password:</label>
						<div class="input-group mb-3" id="show_hide_password">
							<input type="password" class="form-control" id="passcode" placeholder="Current Password" name="passcode" required>
							<div class="input-group-prepend">
								<span class="input-group-text">
									<i class="fa fa-eye-slash" aria-hidden="true" onclick="PwHideShow()"></i>
								</span>
							</div>
							<div class="valid-feedback">Valid.</div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>

					<div class="form-group">
						<label for="passcode1">New Password:</label>
						<div class="input-group mb-3" id="show_hide_password1">
							<input type="password" class="form-control" id="passcode1" placeholder="New Password" name="passcode1" maxlength="254" minlength="6" pattern="(?=.*\d)(?=.*[A-Za-z]).{6,254}" oninvalid="this.setCustomValidity('Note: Password must contain letters and numbers. Minimum of 6 and Maximum of 12 character.')" oninput="this.setCustomValidity('')" required>
							<div class="input-group-prepend">
								<span class="input-group-text">
									<i class="fa fa-eye-slash" aria-hidden="true" onclick="PwHideShow1()"></i>
								</span>
							</div>
							<div class="valid-feedback">Valid.</div>
							<div class="invalid-feedback">Note: Password must contain letters and numbers. Minimum of 6 and Maximum of 12 character.</div>
						</div>
					</div>

					<div class="form-group">
						<label for="passcode2">Re-type Password:</label>
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
					</div>

					<?php
						include_once "../../inc/chngepw/index.php";
					?>

					<div class="row">
						<div class="col-sm-6 mb-2"></div>
						<div class="col-sm-6 mb-2">
							<button type="submit" class="btn btn-block btn-warning" name="btnSubmit">Submit</button>
						</div>
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="row">
					<div class="col-sm-6 mb-2"></div>
					<div class="col-sm-6 mb-2 text-right">
						<a href="javascript: history.back()" class="text-dark text-decoration-none"><i>&#8592;</i> Back</a> | 
						<a href="../../" class="text-dark text-decoration-none">
							to Homepage
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>