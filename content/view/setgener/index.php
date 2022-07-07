<?php
	include_once "../../content/template-part/{$themename}/dashboard-navbar.php";
	include_once "../../content/template-part/{$themename}/dashboard-navbar-top.php";
	include_once "../../inc/core.php";
	include_once "../../inc/srvr.php";
	$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);

	$etblname = "conf";
	$qry_edit = "SELECT * FROM {$etblname} WHERE id=:ownerid LIMIT 1";
	$stmt_edit = $cnn->prepare($qry_edit);
	$stmt_edit->bindParam(':ownerid', $owner_id);
	$stmt_edit->execute();
	$row_curr = $stmt_edit->fetch(PDO::FETCH_ASSOC);
	$vcmpny_name = $row_curr['cmpny_name'];
	$vsys_name = $row_curr['sys_name'];
	$vsys_ver = $row_curr['sys_ver'];
	$vsys_logo = $row_curr['sys_logo'];
	$vnavbar_logo = $row_curr['navbar_logo'];
	$vnavbar_logo_scroll = $row_curr['navbar_logo_scroll'];
	$vfavicon = $row_curr['favicon'];
	$vquote_title = $row_curr['quote_title'];
	$vceo_pres = $row_curr['ceo_pres'];
	$vmemail = $row_curr['memail'];
	$vtelno = $row_curr['telno'];
	$vmobileno = $row_curr['mobileno'];
	$vmaddress = $row_curr['maddress'];
	$vidletime = $row_curr['idletime'];
	$vgeo_map = $row_curr['geo_map'];
	$vnavbarorrient = $row_curr['nav_bar_orrient'];
	$vcontentwidth = $row_curr['content_width'];
	$vfacebook = $row_curr['facebook'];

	$vprimarycolor = $row_curr['primary_color'];
	$vsecondcolor = $row_curr['second_color'];
	$vthirdcolor = $row_curr['third_color'];
	$vforthcolor = $row_curr['forth_color'];
	$vfifthcolor = $row_curr['fifth_color'];
	$vsixthcolor = $row_curr['sixth_color'];
	$vseventhcolor = $row_curr['seventh_color'];
	$veightcolor = $row_curr['eight_color'];
	$vninghtcolor = $row_curr['ninght_color'];
	$vtenthcolor = $row_curr['tenth_color'];
	$vmenugradientcolor = $row_curr['menu_gradient_color'];

	$vcustom_link_register = $row_curr['custom_link_register'];
?>

<main id="general-settings" class="page-content">
	<div class="container-fluid">
		<h4><?php echo $page_title; ?></h4>
		<form method="post" class="needs-validation" novalidate>
			<div class="row">
				<div class="col-lg-6">
					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">Company</span>
						</div>
						<input id="idxcmpny_name" type="text" class="form-control" placeholder="Company" name="idxcmpny_name" required value="<?php echo $vcmpny_name; ?>">
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">System Title</span>
						</div>
						<input id="idxsys_name" type="text" class="form-control" placeholder="System Title" name="idxsys_name" required value="<?php echo $vsys_name; ?>">
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">System Version</span>
						</div>
						<input id="idxsys_ver" type="text" class="form-control" placeholder="System Version" name="idxsys_ver" required value="<?php echo $vsys_ver; ?>">
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">Tagline</span>
						</div>
						<textarea class="form-control" id="idxquote_title" name="idxquote_title" placeholder="Tagline" required><?php echo $vquote_title; ?></textarea>				
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">In-Charge</span>
						</div>
						<input id="idxceo_pres" type="text" class="form-control" placeholder="In-Charge" name="idxceo_pres" required value="<?php echo $vceo_pres; ?>">
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">E-mail</span>
						</div>
						<input id="idxmemail" type="email" class="form-control" placeholder="E-mail" name="idxmemail" required value="<?php echo $vmemail; ?>">
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">Facebook</span>
						</div>
						<input id="idxfacebook" type="url" class="form-control" placeholder="facebook" name="idxfacebook" required value="<?php echo $vfacebook; ?>">
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">Tel. No.</span>
						</div>
						<input id="idxtelno" type="text" class="form-control" placeholder="Tel. No." name="idxtelno" required value="<?php echo $vtelno; ?>">
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">Mobile No.</span>
						</div>
						<input id="idxmobileno" type="text" class="form-control" placeholder="Mobile No." name="idxmobileno" required value="<?php echo $vmobileno; ?>">
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">Idle Time</span>
						</div>
						<input id="idxidletime" type="number" class="form-control" placeholder="Idle Time" name="idxidletime" required value="<?php echo $vidletime; ?>">
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">Location Coordinate</span>
						</div>
						<input id="idxgeo_map" type="text" class="form-control" placeholder="Location Coordinate" name="idxgeo_map" required value="<?php echo $vgeo_map; ?>">
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">Menu Position</span>
						</div>
						<select id="idxnavbarorrient" name="idxnavbarorrient" class="form-control" required>
							<option value="sticky-top" <?php if($vnavbarorrient=='sticky-top') echo 'selected="selected"'; ?>>Sticky Top</option>
							<option value="fixed-top" <?php if($vnavbarorrient=='fixed-top') echo 'selected="selected"'; ?>>Fix Top</option>
						</select>
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">Address</span>
						</div>
						<textarea class="form-control" id="idxmaddress" name="idxmaddress" placeholder="Address" required><?php echo $vmaddress; ?></textarea>
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">Button Size</span>
						</div>
						<select id="idxbtnsize" name="idxbtnsize" class="form-control" required>
							<option value="btn-lg" <?php if($buttonsize=='btn-lg') echo 'selected="selected"'; ?>>Large</option>
							<option value="" <?php if($buttonsize=='') echo 'selected="selected"'; ?>>Default</option>
							<option value="btn-sm" <?php if($buttonsize=='btn-sm') echo 'selected="selected"'; ?>>Small</option>
						</select>
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">Content Width</span>
						</div>
						<select id="idxcontentwidth" name="idxcontentwidth" class="form-control" required>
							<option value="container" <?php if($vcontentwidth=='container') echo 'selected="selected"'; ?>>Wide</option>
							<option value="container-fluid" <?php if($vcontentwidth=='container-fluid') echo 'selected="selected"'; ?>>Full Width</option>
						</select>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">Custom Register Link</span>
						</div>
						<input id="idxcustomlinkregister" type="text" class="form-control" placeholder="Custom Register Link" name="idxcustomlinkregister" value="<?php echo $vcustom_link_register; ?>">
					</div>
				</div>

				<div class="col-lg-6">
					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">Gradient Menu</span>
						</div>
						<input id="idxmenugradientcolor" type="text" class="form-control" placeholder="Gradient Menu" name="idxmenugradientcolor" value="<?php echo $vmenugradientcolor; ?>">
					</div>
					<label class="w-100">Sample Gradient: <em class="float-right">linear-gradient(rgb(238, 103, 45), rgb(248, 174, 51), rgb(238, 103, 45))</em></label>
				</div>

				<!-- Color Picker Start -->
				<hr>
				<div class="col-lg-6">
					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">Color 1</span>
						</div>
						<input id="idxcolor_1" type="text" class="form-control" placeholder="Primary Color" name="idxcolor_1" value="<?php echo $vprimarycolor; ?>" style="<?php echo 'background-color: '.$vprimarycolor.';'; ?>">
					</div>
				</div>

				<div class="col-lg-6">
					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">Color 2</span>
						</div>
						<input id="idxcolor_2" type="text" class="form-control" placeholder="Secondary Color" name="idxcolor_2" value="<?php echo $vsecondcolor; ?>" style="<?php echo 'background-color: '.$vsecondcolor.';'; ?>">
					</div>
				</div>

				<div class="col-lg-6">
					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">Color 3</span>
						</div>
						<input id="idxcolor_3" type="text" class="form-control" placeholder="Tertiaty Color" name="idxcolor_3" value="<?php echo $vthirdcolor; ?>" style="<?php echo 'background-color: '.$vthirdcolor.';'; ?>">
					</div>
				</div>

				<div class="col-lg-6">
					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">Color 4</span>
						</div>
						<input id="idxcolor_4" type="text" class="form-control" placeholder="Forth Color" name="idxcolor_4" value="<?php echo $vforthcolor; ?>" style="<?php echo 'background-color: '.$vforthcolor.';'; ?>">
					</div>
				</div>

				<div class="col-lg-6">
					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">Color 5</span>
						</div>
						<input id="idxcolor_5" type="text" class="form-control" placeholder="Fifth Color" name="idxcolor_5" value="<?php echo $vfifthcolor; ?>" style="<?php echo 'background-color: '.$vfifthcolor.';'; ?>">
					</div>
				</div>

				<div class="col-lg-6">
					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">Color 6</span>
						</div>
						<input id="idxcolor_6" type="text" class="form-control" placeholder="Sixth Color" name="idxcolor_6" value="<?php echo $vsixthcolor; ?>" style="<?php echo 'background-color: '.$vsixthcolor.';'; ?>">
					</div>
				</div>

				<div class="col-lg-6">
					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">Color 7</span>
						</div>
						<input id="idxcolor_7" type="text" class="form-control" placeholder="Seventh Color" name="idxcolor_7" value="<?php echo $vseventhcolor; ?>" style="<?php echo 'background-color: '.$vseventhcolor.';'; ?>">
					</div>
				</div>

				<div class="col-lg-6">
					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">Color 8</span>
						</div>
						<input id="idxcolor_8" type="text" class="form-control" placeholder="Eight Color" name="idxcolor_8" value="<?php echo $veightcolor; ?>" style="<?php echo 'background-color: '.$veightcolor.';'; ?>">
					</div>
				</div>

				<div class="col-lg-6">
					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">Color 9</span>
						</div>
						<input id="idxcolor_9" type="text" class="form-control" placeholder="Nine Color" name="idxcolor_9" value="<?php echo $vninghtcolor; ?>" style="<?php echo 'background-color: '.$vninghtcolor.';'; ?>">
					</div>
				</div>

				<div class="col-lg-6">
					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">Color 10</span>
						</div>
						<input id="idxcolor_10" type="text" class="form-control" placeholder="Tenth Color" name="idxcolor_10" value="<?php echo $vtenthcolor; ?>" style="<?php echo 'background-color: '.$vtenthcolor.';'; ?>">
					</div>
				</div>
				<!-- Color Picker End -->

				<!-- System Logo (Start) -->
				<hr>
				<div class="col-lg-6">
					<div class="card">
						<div class="bg-secondary" style="height: 100px;">
							<img class="card-img-top" src="<?php echo '../../content/theme/'.$themename.'/storage/img/'.$vsys_logo; ?>" alt="System Logo" style="height: inherit; object-fit: contain;">
						</div>
					</div>
					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">System Logo</span>
						</div>
						<input id="idxsys_logo" type="text" class="form-control" placeholder="System Logo" name="idxsys_logo" required value="<?php echo $vsys_logo; ?>">
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="card">
						<div class="bg-secondary" style="height: 100px;">
							<img class="card-img-top" src="<?php echo '../../content/theme/'.$themename.'/storage/img/'.$vnavbar_logo; ?>" alt="Navbar Logo" style="height: inherit; object-fit: contain;">
						</div>
					</div>
					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">Navbar Logo</span>
						</div>
						<input id="idxnavbar_logo" type="text" class="form-control" placeholder="Navbar Logo" name="idxnavbar_logo" required value="<?php echo $vnavbar_logo; ?>">
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="card">
						<div class="bg-secondary" style="height: 100px;">
							<img class="card-img-top" src="<?php echo '../../content/theme/'.$themename.'/storage/img/'.$vnavbar_logo_scroll; ?>" alt="Navbar Logo on Scroll" style="height: inherit; object-fit: contain;">
						</div>
					</div>
					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">Navbar Logo on Scroll</span>
						</div>
						<input id="idxnavbar_logo_scroll" type="text" class="form-control" placeholder="Navbar Logo on Scroll" name="idxnavbar_logo_scroll" required value="<?php echo $vnavbar_logo_scroll; ?>">
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="card">
						<div class="bg-secondary" style="height: 100px;">
							<img class="card-img-top" src="<?php echo '../../content/theme/'.$themename.'/storage/img/'.$vfavicon; ?>" alt="Web Icon" style="height: inherit; object-fit: contain;">
						</div>
					</div>
					<div class="input-group mb-3 input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">Web Icon</span>
						</div>
						<input id="idxfavicon" type="text" class="form-control" placeholder="Web Icon" name="idxfavicon" required value="<?php echo $vfavicon; ?>">
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>
				</div>
				<!-- System Logo (End) -->
			</div>
			<div class="row justify-content-end">
				<input type="submit" name="btnUpdate" value="Update" class="btn btn-warning btn-sm m-2">
				<a href="../../routes/dashboard" class="btn btn-danger btn-sm m-2">Close</a>
			</div>
		</form>
	</div>
</main>

<?php

	try {
		if (isset($_POST['btnUpdate'])) {
			if (empty(
				$_POST['idxcmpny_name'] || 
				$_POST['idxsys_ver']
			)) {
				$err_msg = "Please fill-up the form properly.";
				echo "<script>alert('".$err_msg."');window.location='../../routes/setgener';</script>";
			} else {
				// search for duplicate
				$stblname = "conf";
				$setstr_cmpny_name = "cmpny_name";
				$setstr_sys_name = "sys_name";
				$setstr_sys_ver = "sys_ver";
				$setstr_sys_logo = "sys_logo";
				$setstr_navbar_logo = "navbar_logo";
				$setstr_navbar_logo_scroll = "navbar_logo_scroll";
				$setstr_favicon = "favicon";
				$setstr_quote_title = "quote_title";
				$setstr_ceo_pres = "ceo_pres";
				$setstr_memail = "memail";
				$setstr_facebook = "facebook";
				$setstr_telno = "telno";
				$setstr_mobileno = "mobileno";
				$setstr_maddress = "maddress";
				$setstr_idletime = "idletime";
				$setstr_geo_map = "geo_map";
				$setstr_nav_bar_orrient = "nav_bar_orrient";
				$setstr_button_size = "button_size";
				$setstr_content_width = "content_width";
				$setstr_primarycolor = 'primary_color';
				$setstr_secondcolor = 'second_color';
				$setstr_thirdcolor = 'third_color';
				$setstr_forthcolor = 'forth_color';
				$setstr_fifthcolor = 'fifth_color';
				$setstr_sixthcolor = 'sixth_color';
				$setstr_seventhcolor = 'seventh_color';
				$setstr_eightcolor = 'eight_color';
				$setstr_ninghtcolor = 'ninght_color';
				$setstr_tenthcolor = 'tenth_color';
				$setstr_menugradientcolor = 'menu_gradient_color';
				$setstr_customlinkregister = 'custom_link_register';

				$qry_insert = "UPDATE {$stblname} SET 
					{$setstr_cmpny_name}=:cmpny_name, 
					{$setstr_sys_name}=:sys_name, 
					{$setstr_sys_ver}=:sys_ver, 
					{$setstr_sys_logo}=:sys_logo, 
					{$setstr_navbar_logo}=:navbar_logo, 
					{$setstr_navbar_logo_scroll}=:navbar_logo_scroll, 
					{$setstr_favicon}=:favicon, 
					{$setstr_quote_title}=:quote_title, 
					{$setstr_ceo_pres}=:ceo_pres, 
					{$setstr_memail}=:memail, 
					{$setstr_facebook}=:facebook, 
					{$setstr_telno}=:telno, 
					{$setstr_mobileno}=:mobileno, 
					{$setstr_maddress}=:maddress, 
					{$setstr_idletime}=:idletime, 
					{$setstr_geo_map}=:geo_map, 
					{$setstr_nav_bar_orrient}=:navbarorrient, 
					{$setstr_button_size}=:buttonsize, 
					{$setstr_content_width}=:contentwidth, 
					{$setstr_primarycolor}=:primarycolor, 
					{$setstr_secondcolor}=:secondcolor, 
					{$setstr_thirdcolor}=:thirdcolor, 
					{$setstr_forthcolor}=:forthcolor, 
					{$setstr_fifthcolor}=:fifthcolor, 
					{$setstr_sixthcolor}=:sixthcolor, 
					{$setstr_seventhcolor}=:seventhcolor, 
					{$setstr_eightcolor}=:eightcolor, 
					{$setstr_ninghtcolor}=:ninghtcolor, 
					{$setstr_tenthcolor}=:tenthcolor, 
					{$setstr_menugradientcolor}=:menugradientcolor, 
					{$setstr_customlinkregister}=:customlinkregister
					WHERE 
					id=:ownerid
				";
				$stmt_insert = $cnn->prepare($qry_insert);
				$itxtcmpny_name = $_POST['idxcmpny_name'];
				$itxtsys_name = $_POST['idxsys_name'];
				$itxtsys_ver = $_POST['idxsys_ver'];
				$itxtsys_logo = $_POST['idxsys_logo'];
				$itxtnavbar_logo = $_POST['idxnavbar_logo'];
				$itxtnavbar_logo_scroll = $_POST['idxnavbar_logo_scroll'];
				$itxtfavicon = $_POST['idxfavicon'];
				$itxtquote_title = $_POST['idxquote_title'];
				$itxtceo_pres = $_POST['idxceo_pres'];
				$itxtmemail = $_POST['idxmemail'];
				$itxtfacebook = $_POST['idxfacebook'];
				$itxttelno = $_POST['idxtelno'];
				$itxtmobileno = $_POST['idxmobileno'];
				$itxtmaddress = $_POST['idxmaddress'];
				$itxtidletime = $_POST['idxidletime'];
				$itxtgeo_map = $_POST['idxgeo_map'];
				$itxtnavbarorrient = $_POST['idxnavbarorrient'];
				$itxtbtnsize = $_POST['idxbtnsize'];
				$itxtcontentwidth = $_POST['idxcontentwidth'];
				$idxcolor1 = $_POST['idxcolor_1'];
				$idxcolor2 = $_POST['idxcolor_2'];
				$idxcolor3 = $_POST['idxcolor_3'];
				$idxcolor4 = $_POST['idxcolor_4'];
				$idxcolor5 = $_POST['idxcolor_5'];
				$idxcolor6 = $_POST['idxcolor_6'];
				$idxcolor7 = $_POST['idxcolor_7'];
				$idxcolor8 = $_POST['idxcolor_8'];
				$idxcolor9 = $_POST['idxcolor_9'];
				$idxcolor10 = $_POST['idxcolor_10'];
				$idxmenugradientcolor = $_POST['idxmenugradientcolor'];
				$txtcustomlinkregister = $_POST['idxcustomlinkregister'];
				$stmt_insert->bindParam(':ownerid', $owner_id);
				$stmt_insert->bindParam(':cmpny_name', $itxtcmpny_name);
				$stmt_insert->bindParam(':sys_name', $itxtsys_name);
				$stmt_insert->bindParam(':sys_ver', $itxtsys_ver);
				$stmt_insert->bindParam(':sys_logo', $itxtsys_logo);
				$stmt_insert->bindParam(':navbar_logo', $itxtnavbar_logo);
				$stmt_insert->bindParam(':navbar_logo_scroll', $itxtnavbar_logo_scroll);
				$stmt_insert->bindParam(':favicon', $itxtfavicon);
				$stmt_insert->bindParam(':quote_title', $itxtquote_title);
				$stmt_insert->bindParam(':ceo_pres', $itxtceo_pres);
				$stmt_insert->bindParam(':memail', $itxtmemail);
				$stmt_insert->bindParam(':facebook', $itxtfacebook);
				$stmt_insert->bindParam(':telno', $itxttelno);
				$stmt_insert->bindParam(':mobileno', $itxtmobileno);
				$stmt_insert->bindParam(':maddress', $itxtmaddress);
				$stmt_insert->bindParam(':idletime', $itxtidletime);
				$stmt_insert->bindParam(':geo_map', $itxtgeo_map);
				$stmt_insert->bindParam(':navbarorrient', $itxtnavbarorrient);
				$stmt_insert->bindParam(':buttonsize', $itxtbtnsize);
				$stmt_insert->bindParam(':contentwidth', $itxtcontentwidth);
				$stmt_insert->bindParam(':primarycolor', $idxcolor1);
				$stmt_insert->bindParam(':secondcolor', $idxcolor2);
				$stmt_insert->bindParam(':thirdcolor', $idxcolor3);
				$stmt_insert->bindParam(':forthcolor', $idxcolor4);
				$stmt_insert->bindParam(':fifthcolor', $idxcolor5);
				$stmt_insert->bindParam(':sixthcolor', $idxcolor6);
				$stmt_insert->bindParam(':seventhcolor', $idxcolor7);
				$stmt_insert->bindParam(':eightcolor', $idxcolor8);
				$stmt_insert->bindParam(':ninghtcolor', $idxcolor9);
				$stmt_insert->bindParam(':tenthcolor', $idxcolor10);
				$stmt_insert->bindParam(':menugradientcolor', $idxmenugradientcolor);
				$stmt_insert->bindParam(':customlinkregister', $txtcustomlinkregister);
				$stmt_insert->execute();
				$err_msg = "Update successfully.";
				echo "<script>alert('".$err_msg."');window.location='../../routes/setgener';</script>";
			}
		}
	} catch (PDOException $error) {
		$err_msg = $error->getMessage();
		echo "<p>Error: {$err_msg}</p>";
		die;
	}