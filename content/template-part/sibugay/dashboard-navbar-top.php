<section id="dbrd-navbar" class="fixed-top page-content dboard-nav-top">
	<nav class="navbar navbar-expand-sm container-fluid" style="top: -16px;">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="collapsibleNavbar">
			<ul class="navbar-nav mr-auto">
				<?php
					$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
					$qry_menud = "SELECT * FROM tbl_menu_dboard WHERE menable=1 AND theme_name=:xthemename ORDER BY sort_num ASC";
					$stmt_menud = $cnn->prepare($qry_menud);
					$stmt_menud->bindParam(':xthemename', $themename);
					$stmt_menud->execute();
					$cnt_menud = $stmt_menud->rowCount();

					if ($cnt_menud > 0) {
						foreach ($stmt_menud as $row_menud) {
							$mdmenusortnum	= $row_menud['sort_num'];
							$mdmenutitle	= $row_menud['menu_title'];
							$mdmenuslug		= $row_menud['menu_slug'];
							$mdmenuopen		= $row_menud['menu_open'];

							if ($mdmenusortnum==1) {
								?>
									<li class="nav-item">
										<h2 class="pr-3"><?php echo $mdmenutitle; ?></h2>
									</li>
								<?php
							} else {
								?>
									<li class="nav-item">
										<a href="<?php echo $domainhome.'routes/'.$mdmenuslug; ?>" target="<?php echo $mdmenuopen; ?>" class="nav-link text-dark"><?php echo $mdmenutitle; ?></a>
									</li>
								<?php
							}
						}
					} else {
						?>
							<li class="nav-item">
								<h2>Dashboard</h2>
							</li>
						<?php
					}
				?>
			</ul>

			<ul class="navbar-nav my-2 my-lg-0 ml-auto">
				<li class="nav-item">
					<div class="input-group m-2">
						<div class="input-group-prepend">
							<span class="input-group-text">
								<i class='fas fa-search'></i>
							</span>
						</div>
						<input type="text" class="form-control mr-5" placeholder="Search">
					</div>
				</li>
				<li class="nav-item">
					<a class="btn btn-light m-2" href="#"><i class="fa fa-bell"></i></a>
				</li>
				<li class="nav-item">
					<a class="btn btn-light m-2" href="#"><i class="fas fa-user-alt"></i></a>
				</li>
			</ul>
		</div>
	</nav>
</section>