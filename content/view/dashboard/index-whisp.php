<?php
	// Theme: -whisp

	// Top Container
	// Sidebar - Menu
	include_once "../../content/template-part/{$themename}/dashboard-navbar.php";
	include_once "../../content/template-part/{$themename}/dashboard-navbar-top.php";
?>

<main class="page-content">
	<div class="container-fluid">
		<?php
			if ($_SESSION["ulevpos"]==1) {
				?>
					<p>*All information below show the stats for the last 7 days</p>
					<div class="row">
						<div class="col-lg-9">
							<div class="row">
								<div class="col-md-4">Clicks</div>
								<div class="col-md-4">Conversations</div>
								<div class="col-md-4">Conversions</div>
								<div class="col-md-4">Button Clicks</div>
								<div class="col-md-4">Chat Clicks</div>
								<div class="col-md-4">URL Sessions</div>
							</div>
						</div>
						<div class="col-lg-3 text-center">
							<img class="dboardimglogo" src="<?php echo '../../content/theme/'.$themename.'/storage/img/'.$syslogo; ?>">
						</div>
					</div>

					<div class="row">
						<div class="col-lg-9">
							<div class="row">
								<div class="col-md-8">Recent Clients</div>
								<div class="col-md-4">Device Used</div>
								<div class="col-md-12">Conversations By Contacts</div>
							</div>
						</div>
						<div class="col-lg-3">Click By Products</div>
					</div>
				<?php
			}
		?>
	</div>
</main>