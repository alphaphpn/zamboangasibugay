				<!-- follow link below for more icon @ class -->
				<!-- https://www.w3schools.com/icons/fontawesome5_icons_files.asp -->
				<!-- <?php //echo $baklnk; ?>routes/ -->

				<li class="sidebar-dropdown"> <!-- Human Resource -->
					<a href="#" title="Human Resource">
						<i class="far fa-file-alt"></i>
						<span>Human Resource</span>
					</a>
					<div class="sidebar-submenu">
						<ul>
							<li>
								<a href="#">Personal Profile</a>
							</li>
							<li>
								<a href="#">Daily Time Record</a>
							</li>
							<li>
								<a href="#">Payroll</a>
							</li>
							<li>
								<a href="#">Benifits</a>
							</li>
							<li>
								<a href="#">Talent Acquisition</a>
							</li>
							<li>
								<a href="#">Job Board</a>
							</li>
						</ul>
					</div>
				</li>

				<li class="sidebar-dropdown"> <!-- Point of Sale -->
					<a href="#" title="Sample Menu">
						<i class="far fa-file-alt"></i>
						<span>Point of Sale</span>
					</a>
					<div class="sidebar-submenu">
						<ul>
							<li>
								<a href="<?php echo $baklnk; ?>routes/item-order">Order(s)</a>
							</li>
							<li class="d-none">
								<a href="<?php echo $baklnk; ?>routes/item">Complete</a>
							</li>
							<li class="d-none">
								<a href="#" data-toggle="modal" data-target="#mPayMode">Pay</a>
							</li>
							<li>
								<a href="#" class="d-none">Inventory</a>
							</li>
						</ul>
					</div>
				</li>

				<li class="sidebar-dropdown"> <!-- Reporst -->
					<a href="#" title="Sample Menu">
						<i class="far fa-file-alt"></i>
						<span>Logs / Reports</span>
					</a>
					<div class="sidebar-submenu">
						<ul>
							<!-- System Default Report -->
							<?php
								if ($_SESSION["ulevpos"]==1) {
									?>
									<li class="d-none">
										<a href="#">User(s)</a>
									</li>
									<?php
								}
							?>
							<li>
								<a href="#" title="d-none">Sales</a>
								<div class="sidebar-dropdown">
									<ul>
										<li><a href="<?php echo $baklnk; ?>routes/reports/daily">Daily</a></li>
										<li><a href="<?php echo $baklnk; ?>routes/reports/monthly">Monthly</a></li>
										<li><a href="<?php echo $baklnk; ?>routes/reports/yearly">Yearly</a></li>
									</ul>
								</div>
							</li>
						</ul>
					</div>
				</li>

				<li class="sidebar-dropdown"> <!-- Sample Menu 1 -->
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