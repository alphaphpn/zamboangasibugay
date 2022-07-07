<?php

	if ($profstyleimg==1) {
		?>
			<!-- Current User Profile -->
			<div class="sidebar-header">
				<div class="user-pic user-pic-circle">
					<img class="img-responsive" src="<?php echo $profpicsurr; ?>" alt="User picture">
				</div>
				<div class="user-info">
					<span class="user-name"><?php echo $givename; ?>
						<strong><?php echo $lastname; ?></strong>
					</span>
					<span class="user-role"><?php echo $ptitle; ?></span>
					<span class="user-status">
						<i class="fa fa-circle"></i>
						<span>Online</span>
					</span>
				</div>
			</div>
			<!-- Current User Profile -->
		<?php
	} elseif ($profstyleimg==2) {
		?>
			<!-- Current User Profile v2 -->
			<div id="user-pro-v2" class="sidebar-header border-0 text-center">
				<div class="user-pic user-pic-circle float-none m-auto">
					<span class="user-status position-absolute"><i class="fa fa-circle text-success"></i></span>
					<img class="img-responsive rounded-circle border border-white box-shadow-default" src="<?php echo $profpicsurr; ?>" alt="User picture">
				</div>
				<div class="user-info float-none">
					<span class="user-name text-body"><strong><?php echo $ptitle; ?></strong></span>
					<span class="user-role"><?php echo $cremail; ?></span>
				</div>
			</div>
			<!-- Current User Profile  -->
		<?php
	} else {
		?>
			<!-- Current User Profile -->
			<div class="sidebar-header">
				<div class="user-pic user-pic-circle">
					<img class="img-responsive" src="<?php echo $profpicsurr; ?>" alt="User picture">
				</div>
				<div class="user-info">
					<span class="user-name"><?php echo $givename; ?>
						<strong><?php echo $lastname; ?></strong>
					</span>
					<span class="user-role"><?php echo $ptitle; ?></span>
					<span class="user-status">
						<i class="fa fa-circle"></i>
						<span>Online</span>
					</span>
				</div>
			</div>
			<!-- Current User Profile -->
		<?php
	}