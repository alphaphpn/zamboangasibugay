<?php
	$chckfle2 = file_exists("../../inc/xsession.php");
	if ($chckfle2) {
		include_once "../../inc/xsession.php";
		$baklnk = "../../";
	} else {
		include_once "../../../inc/xsession.php";
		$baklnk = "../../../";
	}

	if ($imgpext == '') {
		$profpicsurr = $imgpixg;
	} else {
		$profpicsurr = $baklnk.'content/theme/'.$themename.'/storage/img/profile/'.$imgpixg.'.'.$imgpext;
	}

	if (empty(trim($dmaintitle))) {
		$dmaintitle2 = "Main";
		$dmaintitle2_display = "d-none";
	} else {
		$dmaintitle2 = $dmaintitle;
		$dmaintitle2_display = "";
	}

	if (empty(trim($dsystemtitle))) {
		$dsystemtitle2 = "System";
		$dsystemtitle2_display = "d-none";
	} else {
		$dsystemtitle2 = $dsystemtitle;
		$dsystemtitle2display = "";
	}

	if (empty(trim($dapptitle))) {
		$dapptitle2 = "App";
		$dapptitle2_display = "d-none";
	} else {
		$dapptitle2 = $dapptitle;
		$dapptitle2_display = "";
	}

	if (empty(trim($dextratitle))) {
		$dextratitle2 = "Extra";
		$dextratitle2_display = "d-none";
	} else {
		$dextratitle2 = $dextratitle;
		$dextratitle2_display = "";
	}

	if (empty(trim($dtrashtitle))) {
		$dtrashtitle2 = "Trash Data";
		$dtrashtitle2_display = "d-none";
	} else {
		$dtrashtitle2 = $dtrashtitle;
		$dtrashtitle2_display = "";
	}

	if (empty(trim($dabouttitle))) {
		$dabouttitle2 = "About";
		$dabouttitle2_display = "d-none";
	} else {
		$dabouttitle2 = $dabouttitle;
		$dabouttitle2_display = "";
	}
?>

<a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
	<i class="fas fa-bars"></i>
</a>

<!-- sidebar-wrapper  -->
<nav id="sidebar" class="sidebar-wrapper box-shadow-default">
	<div class="sidebar-brand">
		<?php
			if ($sidelogdbr=1) {
				?>
					<a href="<?php echo $baklnk; ?>routes/dashboard" class="text-center">
						<img src="<?php echo $baklnk.'content/theme/'.$themename.'/storage/img/'.$navbarlogo; ?>" class="dboard-top-left-logo">
					</a>
				<?php
			} else {
				?>
					<a href="<?php echo $baklnk; ?>">Visit Site</a>
				<?php
			}
		?>
		<div id="close-sidebar">
			<i class="fas fa-times"></i>
		</div>
	</div>

	<?php include_once "dashboard-img-profile.php"; ?>

	<div class="sidebar-content">
		<!-- Menu  -->
		<div class="sidebar-menu border-0">
			<ul>
				<!-- Main Menu -->
				<li class="header-menu">
					<span style="cursor: pointer;" onclick="window.open('<?php echo $baklnk; ?>routes/dashboard','_self');"><?php echo $dmaintitle2; ?></span>
				</li>

				<?php
					if ($_SESSION["ulevpos"]==1) {
						?>
							<li class="">
								<a href="<?php echo $baklnk; ?>routes/dashboard">
									<i class="fas fa-server"></i>
									<span>Dashboard</span>
									<span class="badge badge-pill badge-primary">Main</span>
								</a>
							</li>
						<?php
					}
				?>

				<li class="">
					<a href="<?php echo $baklnk; ?>routes/user/profile">
						<i class="fas fa-user"></i>
						<span>Profile</span>
						<span class="badge badge-pill badge-info">Info</span>
					</a>
				</li>

				<?php
					if ($_SESSION["ulevpos"]==1) {
						?>
						<li class="">
							<a href="<?php echo $baklnk; ?>routes/item">
								<i class="fas fa-tags"></i>
								<span>Products</span>
								<span class="badge badge-pill badge-danger">Items</span>
							</a>
						</li>
						<?php
					}
				?>

				<li class="sidebar-dropdown">
					<a href="#" title="User">
						<i class="fas fa-users"></i>
						<span>Users</span>
					</a>
					<div class="sidebar-submenu">
						<ul>
							<?php
								if ($_SESSION["ulevpos"]==1 || $_SESSION["ulevpos"]==4 ||  $_SESSION["ulevpos"]==2) {
									?>
										<li>
											<a href="<?php echo $baklnk; ?>routes/user">All</a>
										</li>
										<li>
											<a href="<?php echo $baklnk; ?>routes/user/addnew">Add New</a>
										</li>
									<?php
								}
							?>
						</ul>
					</div>
				</li>
				<?php
					if ($_SESSION["ulevpos"]==1) {
						?>
						<li class="sidebar-dropdown">
							<a href="#">
								<i class="fas fa-cogs"></i>
								<span>Setting</span>
							</a>
							<div class="sidebar-submenu">
								<ul>
									<li>
										<a href="<?php echo $baklnk; ?>routes/setgener" title="General Settings">General</a>
									</li>
									<li>
										<a href="#" class="">Writing</a>
									</li>
									<li>
										<a href="#" class="">Reading</a>
									</li>
									<li>
										<a href="#" class="">Discussion</a>
									</li>
									<li>
										<a href="#" class="">Privacy</a>
									</li>
									<li class="">
										<a href="<?php echo $baklnk; ?>routes/address" title="Address List">Address</a>
									</li>
								</ul>
							</div>
						</li>

						<li class="sidebar-dropdown">
							<a href="#">
								<i class="fas fa-palette"></i>
								<span>Apperance</span>
							</a>
							<div class="sidebar-submenu">
								<ul>
									<li>
										<a href="#">Theme</a>
									</li>
									<li>
										<a href="#">Color</a>
									</li>
									<li>
										<a href="<?php echo $baklnk; ?>routes/banner">Banner</a>
									</li>
									<li>
										<a href="#">Custom Style Sheet (CSS)</a>
									</li>
									<li>
										<a href="#">Custom JavaScript</a>
									</li>
								</ul>
							</div>
						</li>

						<li class="sidebar-dropdown">
							<a href="#">
								<i class="fas fa-sticky-note"></i>
								<span>Site</span>
							</a>
							<div class="sidebar-submenu">
								<ul>
									<li class="sidebar-dropdown">
										<a href="#">Post</a>
										<div>
											<ul>
												<li>
													<a href="#">Product & Services</a>
												</li>
												<li>
													<a href="#">Testimonial</a>
												</li>
												<li>
													<a href="#">FAQ</a>
												</li>
												<li>
													<a href="#">Blog</a>
												</li>
												<li>
													<a href="#">Comments</a>
												</li>
											</ul>
										</div>
									</li>
									<li>
										<a href="#">Media</a>
									</li>
									<li>
										<a href="#">Page</a>
										<div>
											<ul>
												<li>
													<a href="<?php echo $baklnk; ?>routes/page-about">About</a>
												</li>
											</ul>
										</div>
									</li>
								</ul>
							</div>
						</li>
						<?php
					}
				?>
				<li class="sidebar-dropdown">
					<a href="#">
						<i class="fa fa-inbox"></i>
						<span>Contact</span>
					</a>
					<div class="sidebar-submenu">
						<ul>
							<li>
								<a href="<?php echo $baklnk; ?>routes/contact-messages">Message(s)</a>
							</li>
							<li class="">
								<a href="#">Contact List</a>
							</li>
						</ul>
					</div>
				</li>
				<!-- Main Menu -->

				<!-- Custom Menu -->
				<li class="header-menu <?php echo $dsystemtitle2_display; ?>">
					<span><?php echo $dsystemtitle2; ?></span>
				</li>
				<?php include_once "dashboard-navbar-menu.php"; ?>
				<!-- Custom Menu -->

				<!-- Built-in App -->
				<li class="header-menu <?php echo $dapptitle2_display; ?>">
					<span><?php echo $dapptitle2; ?></span>
				</li>
				<?php include_once "dashboard-navbar-app.php"; ?>
				<!-- Built-in App -->

				<!-- Extra Menu -->
				<li class="header-menu <?php echo $dextratitle2_display; ?>">
					<span><?php echo $dextratitle; ?></span>
				</li>
					<li class="<?php echo $dextratitle2_display; ?>">
						<a href="<?php echo $baklnk; ?>routes/crud" title="Create Read Update Delete Search">
							<i class="fa fa-book"></i>
							<span>CRUD</span>
							<span class="badge badge-pill badge-secondary">Native PHP</span>
						</a>
					</li>
					<li class="<?php echo $dextratitle2_display; ?>">
						<a href="<?php echo $baklnk; ?>routes/crud-datatable" title="Create Read Update Delete Search">
							<i class="fa fa-book"></i>
							<span>CRUD</span>
							<span class="badge badge-pill badge-success">DataTable</span>
						</a>
					</li>
				<!-- Extra Menu -->

				<!-- Trash / Recycle Bin -->
				<li class="header-menu <?php echo $dtrashtitle2_display; ?>">
					<span><?php echo $dtrashtitle2; ?></span>
				</li>
				<li class="sidebar-dropdown <?php echo $dtrashtitle2_display; ?>"> <!-- Sample Menu 1 -->
					<a href="#" title="Sample Menu">
						<i class="far fa-file-alt"></i>
						<span>Sample Menu 1</span>
					</a>
					<div class="sidebar-submenu">
						<ul>
							<li>
								<a href="#">Sample Sub-Menu 1</a>
							</li>
							<li>
								<a href="#">Sample Sub-Menu 2</a>
							</li>
						</ul>
					</div>
				</li>
				<!-- Trash / Recycle Bin -->

				<!-- About -->
				<li class="header-menu <?php echo $dabouttitle2_display; ?>">
					<span><?php echo $dabouttitle2; ?></span>
				</li>
				<li class="<?php echo $dabouttitle2_display; ?>">
					<a href="<?php echo $baklnk; ?>routes/dashboard-theme" title="Dashboard Theme">
						<i class="fa fa-copyright"></i>
						<span>Dashboard</span>
						<span class="badge badge-pill badge-info">Theme</span>
					</a>
				</li>
				<!-- About -->
			</ul>
		</div>
		<!-- Menu  -->
	</div>

	<div id="" class="sidebar-footer bg-transparent border-0 rounded-0 box-shadow-none clearfix d-none">
		<button class="btn btn-light box-shadow-default w-100 m-4">
			<a href="<?php echo $baklnk; ?>inc/logout" class="text-dark">
				<i class="fas fa-sign-out-alt"></i>
				<span>Log out</span>
			</a>
		</button>
	</div>

	<!-- Notification  -->
	<div class="sidebar-footer">
		<a href="#" title="Notification">
			<i class="fa fa-bell"></i>
			<span class="badge badge-pill badge-warning notification">3</span>
		</a>
		<a href="#" title="Message">
			<i class="fa fa-envelope"></i>
			<span class="badge badge-pill badge-success notification">7</span>
		</a>
		<a href="<?php echo $baklnk; ?>routes/setgener" title="Settings">
			<i class="fa fa-cog"></i>
			<span class="badge-sonar"></span>
		</a>
		<a href="" title="Refresh">
			<i class="fas fa-sync"></i>
		</a>
		<a href="<?php echo $baklnk; ?>inc/logout" title="Logout">
			<i class="fa fa-power-off"></i>
		</a>
	</div>
	<!-- Notification  -->
</nav>
<!-- sidebar-wrapper  -->