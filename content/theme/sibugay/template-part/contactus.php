	<div class="<?php echo $contentwidth; ?>">
		<div class="row">
			<h2 class="text-center">Contact Us</h2>
			<br>
			<div class="col-sm-5">
				<p>Contact us and will be in touch to you as soon as we get online.</p>
				<p><a class="text-body" href="//google.com/maps/place/@<?php echo $geomap; ?>,17z" target="_blank"><span class="fas fa-map-marker-alt"></span> <?php echo $maddress ?></a></p>
				<p><a class="text-body" href="tel:<?php echo $mobileno ?>" target="_blank"><span class="fas fa-phone"></span> <?php echo $mobileno ?></a></p>
				<p><a class="text-body" href="viber://chat?number=639154826025" target="_blank"><span class="fab fa-viber"></span> viber://chat?number=639154826025</a></p>
				<p><a class="text-body" href="" target="_blank"><span class="fab fa-whatsapp"></span> api.whatsapp.com/send?phone=639154826025</a></p>
				<p><a class="text-body" href="//web.telegram.org/#ludwigbethnicer" target="_blank"><span class="fab fa-telegram"></span> web.telegram.org/#ludwigbethnicer</a></p>
				<p><a class="text-body" href="mailto:<?php echo $memail ?>" target="_blank"><span class="fas fa-envelope-square"></span> <?php echo $memail ?></a></p>
				<p><a class="text-body" href="<?php echo $facebook ?>" target="_blank"><span class="fab fa-facebook-square"></span> <?php echo preg_replace("(^https?://)", "", $facebook ); ?></a></p>
				<p><a class="text-body" href="//linkedin.com/in/alphaphpn" target="_blank"><span class="fab fa-linkedin"></span> linkedin.com/in/alphaphpn</a></p>
				<p><a class="text-body" href="//github.com/alphaphpn" target="_blank"><span class="fab fa-github"></span> github.com/alphaphpn</a></p>
				<p><a class="text-body" href="//join.skype.com/invite/vNOS2TydLzxx" target="_blank"><span class="fab fa-skype"></span> join.skype.com/invite/vNOS2TydLzxx</a></p>
			</div>
			<div class="col-sm-7 slideanim">
				<form method="post" class="needs-validation" novalidate>
					<div class="row">
						<div class="col-sm-6 form-group">
							<input class="form-control" id="fullname" name="fullname" placeholder="Name" type="text" required>
						</div>
						<div class="col-sm-6 form-group">
							<input class="form-control" id="mphone" name="mphone" placeholder="Phone" type="text">
						</div>
					</div>
					<div class="form-group">
						<input class="form-control" id="emailx" name="emailx" placeholder="Email" type="email" required>
					</div>
					<div class="form-group">
						<input class="form-control" id="subjects" name="subjects" placeholder="Subject" type="text">
					</div>
					<textarea class="form-control" id="messages" name="messages" placeholder="Message" rows="5" required></textarea><br>
					<?php
						$chckfle = file_exists("inc/notrobot/math/plus/index.php");
						if ($chckfle) {
							include_once "inc/notrobot/math/plus/index.php";
						} else {
							include_once "../../inc/notrobot/math/plus/index.php";
						}

						$equealz = $equealx;
					?>
					<div class="form-group mb-0">
						<label>Not a robot? Required to answer this option.</label>
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text"><?php echo $var1.' + '.$var2; ?> = </span>
						</div>
						<input class="form-control" id="myanswer" name="myanswer" placeholder="Your Answer" type="number" required>
					</div>
					<div class="row">
						<div class="col-sm-12 form-group">
							<input type="submit" name="btnSend" value="Send" class="<?php echo 'btn '.$buttonsize.' pull-right w-100'; ?>" style="<?php echo 'background-color: '.$primarycolor.';'; ?>">
						</div>
					</div>
					<div class="form-group">
						<input type="number" name="equalz" id="equalz" value="<?php echo $equealz; ?>" class="d-none" readonly required>
						<?php

							$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);

							try {
								if (isset($_POST['btnSend'])) {
									if (empty($_POST['fullname']) || empty($_POST['emailx']) || empty($_POST['messages'])) {
										echo '<div class="alert alert-danger alert-dismissible fade show">';
											echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
											echo 'Please fill-up the form properly.';
										echo '</div>';
									} else {
										$myanswer = $_POST['myanswer'];
										$equalzy = $_POST['equalz'];

										if ($equalzy==$myanswer) {
											$stblname = "tbl_contactform";
											$qry_insert = "INSERT INTO {$stblname} SET fullname=:fullname, email=:emailx, phone=:mphone, subject=:subjects, message=:messages, theme_name=:themename, deleted=0";
											$stmt_insert = $cnn->prepare($qry_insert);
											$fullname = $_POST['fullname'];
											$emailx = $_POST['emailx'];
											$mphone = $_POST['mphone'];
											$subjects = $_POST['subjects'];
											$messages = $_POST['messages'];
											$stmt_insert->bindParam(':fullname', $fullname);
											$stmt_insert->bindParam(':emailx', $emailx);
											$stmt_insert->bindParam(':mphone', $mphone);
											$stmt_insert->bindParam(':subjects', $subjects);
											$stmt_insert->bindParam(':messages', $messages);
											$stmt_insert->bindParam(':themename', $themename);
											$stmt_insert->execute();

											echo '<div class="alert alert-info alert-dismissible fade show">';
												echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
												echo 'Message successfully sent.';
											echo '</div>';
										} else {
											echo '<div class="alert alert-warning alert-dismissible fade show">';
												echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
												echo 'Wrong answer.';
											echo '</div>';
										}
									}
								}
							} catch (PDOException $error) {
								$err_msg = $error->getMessage();								
								echo '<div class="alert alert-danger alert-dismissible fade show">';
									echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
									echo "<p>Error: {$err_msg}</p>";
								echo '</div>';
								die;
							}
						?>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>