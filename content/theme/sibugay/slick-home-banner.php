<div class="slick-frontbanner">
	<?php
		try {
			$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
			$qry_banner = "SELECT * FROM tbl_headbanner WHERE enabled=1 AND theme_name=:xthemename ORDER BY hb_id ASC";
			$stmt_banner = $cnn->prepare($qry_banner);
			$stmt_banner->bindParam(':xthemename', $themename);
			$stmt_banner->execute();
			$cnt_banner = $stmt_banner->rowCount();

			if ($cnt_banner > 0) {
				foreach ($stmt_banner as $row_banner) {
					$bhbid = $row_banner['hb_id'];
					$bheadtitle = $row_banner['head_title'];
					$bheadtitle2 = $row_banner['head_title2'];
					$bsubtext = $row_banner['sub_text'];
					$bimgloc = $row_banner['img_loc'];
					$bbannerwidth = $row_banner['banner_width'];
					$bcontentalignment = $row_banner['content_alignment'];
					?>
						<div class="card">
							<div class="<?php echo $contentwidth; ?> card-img-overlay d-flex h-100 justify-content-left align-items-center">
								<div class="<?php echo $bcontentalignment.' '.$bbannerwidth; ?>">
									<h2 class="card-title"><?php echo $bheadtitle; ?></h2>
									<h4 class="card-title"><?php echo $bheadtitle2; ?></h4>
									<p class="card-text"><?php echo $bsubtext; ?></p>
									<?php
										$qry_banner_btn = "SELECT * FROM tbl_headbanner_btn WHERE hb_id=:hbid ORDER BY hbtn_id ASC";
										$stmt_banner_btn = $cnn->prepare($qry_banner_btn);
										$stmt_banner_btn->bindParam(':hbid', $bhbid);
										$stmt_banner_btn->execute();
										$cnt_banner_btn = $stmt_banner_btn->rowCount();

										if ($cnt_banner_btn > 0) {
											foreach ($stmt_banner_btn as $row_banner_btn) {
												$btncaption		= $row_banner_btn['caption'];
												$btnbtnclass	= $row_banner_btn['btn_class'];
												$btnlinkurl		= $row_banner_btn['link_url'];
												$btnalt			= $row_banner_btn['alt'];
												$btntooltip		= $row_banner_btn['tool_tip'];
												$btnopenin		= $row_banner_btn['open_in'];
												?>
													<a href="<?php echo $btnlinkurl; ?>" class="<?php echo 'btn '.$btnbtnclass.' '.$buttonsize; ?>" target="<?php echo $btnopenin; ?>"><?php echo $btncaption; ?></a>
												<?php
											}
										}
									?>
								</div>
							</div>
							<img class="card-img-top vh-100" src="<?php echo $domainhome; ?>storage/img/img-transparent-banner-1024x438.png" style="background-image: url(<?php echo $domainhome.'content/theme/'.$themename.'/storage/img/'.$bimgloc; ?>);">
						</div>
					<?php
				}
			} else {
				// Center = text-center mr-auto ml-auto
				// Left = text-left mr-auto
				// Right = text-right ml-auto

				// Full-width = w-100
				// Half-width = w-100 mxw-half
			}
		} catch (PDOException $error) {
			die('ERROR: ' . $exception->getMessage());
		}
	?>
</div>