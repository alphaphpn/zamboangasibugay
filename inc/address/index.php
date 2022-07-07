<div class="modal" id="ymModalAddress">
	<div class="modal-dialog">
		<div class="modal-content">
			<button type="button" class="close text-right mr-1" data-dismiss="modal">&times;</button>
			<div class="modal-body">
				<form class="needs-validation" novalidate>
					<p class="note"><em>* = required field</em></p>

					<div class="form-group">
						<label for="ship-address">Search location *</label>
						<input id="ship-address" type="text" class="form-control" placeholder="Search location" name="ship-address" list="locationList" required autofocus>
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
						<datalist id="locationList">
						<?php
							// $stmtLocAddrs = $cnn->prepare("SELECT * FROM vw_address ORDER BY purok, barangay, municipality_town, zipostal_code, districtno, province, abrv, island_archipelago, country, continent ASC");

							$stmtLocAddrs = $cnn->prepare("SELECT `tbl_address_prk`.`prk_id` AS `prk_id`,`tbl_address_prk`.`purok` AS `purok`,`tbl_address_brgy`.`barangay` AS `barangay`,`tbl_address_city_town`.`municipality_town` AS `municipality_town`,`tbl_address_city_town`.`zipostal_code` AS `zipostal_code`,`tbl_address_city_town`.`districtno` AS `districtno`,`tbl_address_province`.`province` AS `province`,`tbl_address_region`.`abrv` AS `abrv`,`tbl_address_island`.`island_archipelago` AS `island_archipelago`,`tbl_address_country`.`country` AS `country`,`tbl_address_continent`.`continent` AS `continent` FROM (((((((`tbl_address_prk` JOIN `tbl_address_brgy` ON(`tbl_address_prk`.`brgy_id` = `tbl_address_brgy`.`brgy_id`)) JOIN `tbl_address_city_town` ON(`tbl_address_brgy`.`town_id` = `tbl_address_city_town`.`town_id`)) JOIN `tbl_address_province` ON(`tbl_address_city_town`.`province_id` = `tbl_address_province`.`province_id`)) JOIN `tbl_address_region` ON(`tbl_address_province`.`region_id` = `tbl_address_region`.`region_id`)) JOIN `tbl_address_island` ON(`tbl_address_region`.`island_code` = `tbl_address_island`.`island_code`)) JOIN `tbl_address_country` ON(`tbl_address_island`.`country_id` = `tbl_address_country`.`country_id`)) JOIN `tbl_address_continent` ON(`tbl_address_country`.`continent_code` = `tbl_address_continent`.`continent_code`)) ORDER BY purok, barangay, municipality_town, zipostal_code, districtno, province, abrv, island_archipelago, country, continent ASC");

							$stmtLocAddrs->execute();
							$resultLocAddrs = $stmtLocAddrs->setFetchMode(PDO::FETCH_ASSOC);
							foreach ($stmtLocAddrs as $rowLocAddrs) {
								$purok = $rowLocAddrs['purok'];
								$brgy = $rowLocAddrs['barangay'];
								$town = $rowLocAddrs['municipality_town'];
								$zcode = $rowLocAddrs['zipostal_code'];
								$districtno = $rowLocAddrs['districtno'];
								$province = $rowLocAddrs['province'];
								$region = $rowLocAddrs['abrv'];
								$island = $rowLocAddrs['island_archipelago'];
								$country = $rowLocAddrs['country'];
								$continent = $rowLocAddrs['continent'];
								$clocationz = $purok.', '.$brgy.', '.$town.' '.$zcode.', District-'.$districtno.', '.$province.', '.$region.', '.$island.', '.$country.', '.$continent;
								echo "<option value='".$clocationz."'>";
							}
						?>
						</datalist>
					</div>

					<div class="form-group">
						<label for="address2">Street, apartment, unit, suite, landmark or floor# *</label>
						<input id="address2" type="text" class="form-control" placeholder="Street, apartment, unit, suite, landmark or floor#" name="address2" required>
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>

					<div class="row justify-content-end">
						<button type="reset" class="btn btn-info btn-sm m-2">Clear Form</button>
						<button type="button" id="btnSaveAddressz" onclick="fnGetAddloc();" class="btn btn-secondary btn-sm m-2">Save location</button>
						<button type="button" id="clzedanger" name="btnClozex" class="btn btn-danger btn-sm m-2" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	function fnGetAddloc() {
		let adrex4 = document.getElementById("ship-address").value;
		let adrex3 = document.getElementById("address2").value;
		let adrex2 = adrex3 + ', ' + adrex4;

		if (adrex4==='' || adrex3==='') {
			alert('Please fillup the address properly.');
		} else {
			document.getElementById("zaddress").innerHTML = adrex2;
			document.getElementById("clzedanger").click();
		}
	}
</script>