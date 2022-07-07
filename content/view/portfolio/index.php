<?php
	include_once "../../content/theme/".$themename."/frontend-navbar.php";
?>
	<!-- script src="../../assets/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script -->
	<style>
		.content {
			display: none;
		}

		#loadMore {
			width: 200px;
			color: #fff;
			display: block;
			text-align: center;
			margin: 20px auto;
			padding: 10px;
			border-radius: 10px;
			border: 1px solid transparent;
			background-color: <?php echo $primarycolor; ?>;
			transition: .3s;
		}

		#loadMore:hover {
			color: <?php echo $primarycolor; ?>;
			background-color: #fff;
			border: 1px solid <?php echo $primarycolor; ?>;
			text-decoration: none;
		}

		.noContent {
			color: #000 !important;
			background-color: transparent !important;
			pointer-events: none;
		}
	</style>
	<div class="pt-5 pb-5" style="background-color: transparent;">
		<div class="<?php echo $contentwidth; ?>">
			<div class="pt-5 pb-5 mt-5">
				<h2 class="text-center">Portfolio</h2>
				<div class="d-flex flex-wrap">

					<div class="content m-5 flex-fill">
						<div class="card" style="width: 100%; max-width: 256px;">
							<a href="#1" class="text-decoration-none text-body">
								<img class="card-img-top" src="https://www.w3schools.com/bootstrap4/img_avatar1.png" alt="Card image" style="width:100%">
								<div class="card-body">
									<h4 class="card-title">Project Title Project Title Project Title</h4>
									<p class="card-text">Some example text some example text. John Doe is an architect and engineer</p>
								</div>
							</a>
						</div>
					</div>

					<div class="content m-5 flex-fill">
						<div class="card" style="width: 100%; max-width: 256px;">
							<a href="#2" class="text-decoration-none text-body">
								<img class="card-img-top" src="https://www.w3schools.com/bootstrap4/img_avatar1.png" alt="Card image" style="width:100%">
								<div class="card-body">
									<h4 class="card-title">Project Title Project Title Project Title</h4>
									<p class="card-text">Some example text some example text. John Doe is an architect and engineer</p>
								</div>
							</a>
						</div>
					</div>

					<div class="content m-5 flex-fill">
						<div class="card" style="width: 100%; max-width: 256px;">
							<a href="#3" class="text-decoration-none text-body">
								<img class="card-img-top" src="https://www.w3schools.com/bootstrap4/img_avatar1.png" alt="Card image" style="width:100%">
								<div class="card-body">
									<h4 class="card-title">Project Title Project Title Project Title</h4>
									<p class="card-text">Some example text some example text. John Doe is an architect and engineer</p>
								</div>
							</a>
						</div>
					</div>
					
				</div>
				<a href="#" id="loadMore">Load More</a>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$(".content").slice(0, 6).show();$(window).scroll(function() {
				if($(window).scrollTop() == $(document).height() - $(window).height()) {
					$(".content:hidden").slice(0, 2).show();
					if($(".content:hidden").length == 0) {
						$("#loadMore").text("No more Content").addClass("noContent");
					}
				}
			});

			$("#loadMore").on("click", function(e){
				e.preventDefault();
				$(".content:hidden").slice(0, 2).show();
				if($(".content:hidden").length == 0) {
					$("#loadMore").text("No more Content").addClass("noContent");
				}
			});
		});
	</script>