	<div class="<?php echo $contentwidth; ?>">
		<?php
			if (empty($_SESSION["usercode"])) {

			} else {
				echo '<button id="adtestmsg" type="button" class="btn btn-warning float-right" data-toggle="modal" data-target="#AddTestimonial" style="display: none;">Add your testimony</button>';
			}
		?>
		<h2 class="text-center">Testimonial</h2>
		<br>
		<div id="myTestimonial" class="carousel slide mt-5 mb-5 mxw-half mx-auto" data-ride="carousel" data-interval="5000" data-pause="hover">
			<!-- Wrapper for slides -->
			<div class="carousel-inner text-center" role="listbox">
				<?php
					$cnn_tesimony = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
					$qry_tesimony = "SELECT * FROM tbl_sysuser WHERE testimony>'' ORDER BY usercode DESC";
					$stmt_tesimony = $cnn_tesimony->prepare($qry_tesimony);
					$stmt_tesimony->execute();
					$num_tesimony = $stmt_tesimony->rowCount();
					$xno_tesimony = 0;

					for ($i=0; $row_tesimony = $stmt_tesimony->fetch(); $i++) {
						$xno_tesimony++;
						if($xno_tesimony==1){
							$ifactive = " active";
						}else{
							$ifactive = "";
						}
				?>
						<div class="carousel-item<?php echo $ifactive; ?>" data-value="<?php echo $xno_tesimony; ?>">
							<h5 class="testsay">"<?php echo substr($row_tesimony['testimony'],0,200); ?>"</h5>
							<h6><span><?php echo $row_tesimony['lname'].' '.$row_tesimony['fname']; ?>, <?php echo $row_tesimony['cmpny_position']; ?>, <?php echo $row_tesimony['cmpny']; ?></span></h6>
						</div>
				<?php
					}
				?>
			</div>

			<!-- Left and right controls -->
			<a class="carousel-control-prev" href="#myTestimonial" data-slide="prev">
				<span class="carousel-control-prev-icon"></span>
			</a>
			<a class="carousel-control-next" href="#myTestimonial" data-slide="next">
				<span class="carousel-control-next-icon"></span>
			</a>

			<!-- Indicators -->
			<ul class="carousel-indicators mt-5">
				<?php
					$cnn_tesimony2 = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
					$qry_tesimony2 = "SELECT * FROM tbl_sysuser WHERE testimony>'' ORDER BY usercode DESC";
					$stmt_tesimony2 = $cnn_tesimony2->prepare($qry_tesimony2);
					$stmt_tesimony2->execute();
					$num_tesimony2 = $stmt_tesimony2->rowCount();
					$xno_tesimony2 = 0;

					for($g=0; $row_tesimony2 = $stmt_tesimony2->fetch(); $g++) {
						$xno_tesimony2++;
						if($xno_tesimony2=1){
							$ifactive2 = "active";
						}else{
							$ifactive2 = "";
						}
				?>
					<li data-target="#myTestimonial" data-slide-to="<?php echo $xno_tesimony2; ?>" class="<?php echo $ifactive2; ?>"></li>
				<?php
					}
				?>
			</ul>
		</div>
	</div>
</div>

<div class="modal" id="AddTestimonial">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Your Testimony</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<div class="modal-body">
				<form method="post" class="needs-validation" novalidate>
					<div class="form-group">
						<label for="testimonialy">Testimony:</label>
						<textarea class="form-control" id="testimonialy" placeholder="Enter your testimony" name="testimonialy" required></textarea>
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>
					<div class="form-group">
						<label for="cmpnyposition">Position:</label>
						<input type="text" class="form-control" id="cmpnyposition" placeholder="Enter your position" name="cmpnyposition" required>
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>
					<div class="form-group">
						<label for="cmpnyid">Company:</label>
						<input type="text" class="form-control" id="cmpnyid" placeholder="Enter your company" name="cmpnyid" required>
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>
					<div class="form-group d-none">
						<input type="text" class="form-control" id="ucersode" name="ucersode" value="<?php echo $_SESSION["usercode"]; ?>" required>
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>
					<?php include_once "../../inc/testimonial/index.php"; ?>
					<button type="submit" name="btnTestimon" class="btn btn-primary w-100">Submit</button>
				</form>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>