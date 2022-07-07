<?php

	$chckfledash = file_exists("../../assets/css/style.css");
	if ($chckfledash) {
		$dirbak = "../../";
	} else {
		$chckfledash1 = file_exists("../../../assets/css/style.css");
		if ($chckfledash1) {
			$dirbak = "../../../";
		} else {
			$dirbak = "../../../../";
		}
	}

	if (empty($_SESSION["usercode"]) || empty($_SESSION["username"]) || empty($_SESSION["fullname"]) || empty($_SESSION["ulevpos"]) || empty($_SESSION["surname"]) || empty($_SESSION["firstname"])) {
		echo '<script>alert("Please login.");window.open("'.$dirbak.'routes/login","_self");</script>';
	} elseif ($_SESSION["ulevpos"]==1) {
		
	} elseif ($_SESSION["ulevpos"]==4) {
		
	} else {
		// Access denied! Authorized person only.
		echo '<script>alert("Access denied! Only Admin Account is Authorize.");window.open("'.$dir.'","_self");</script>';
	}

	if (empty(trim($dboardbgimg))) {
		$dboardbgimg2 = "none";
	} else {
		$dboardbgimg2 = 'url('.$dirbak.'content/theme/'.$themename.'/storage/img/'.$dboardbgimg.')';
	}

	if (empty(trim($bgsidebarimg))) {
		$bgsidebarimg2 = "none";
	} else {
		$bgsidebarimg2 = 'url('.$dirbak.'content/theme/'.$themename.'/storage/img/'.$bgsidebarimg.')';
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $page_title; ?></title>
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<META HTTP-EQUIV="Expires" CONTENT="-1">
	<meta name="google-signin-scope" content="profile email">
	<meta name="google-signin-client_id" content="<?php echo $gauthlogin; ?>">
	<link rel="icon" type="image/png" href="<?php echo $dirbak.'content/theme/'.$themename.'/storage/img/'.$favicon; ?>">
	<link rel="stylesheet" href="<?php echo $dirbak; ?>assets/fontawesome/releases/v5.7.0/css/all.css">
	<link rel="stylesheet" href="<?php echo $dirbak; ?>assets/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo $dirbak; ?>assets/ajax/libs/octicons/3.5.0/octicons.min.css">
	<link rel="stylesheet" href="<?php echo $dirbak; ?>assets/boots/css/bootstrap-colorpicker/bootstrap-colorpicker.css">
	<link rel="stylesheet" href="<?php echo $dirbak; ?>assets/boots/css/bootstrap-colorpicker/main.css">
	<link rel="stylesheet" href="<?php echo $dirbak; ?>assets/npm/slick-carousel@1.8.1/slick/slick.css">
	<link rel="stylesheet" href="<?php echo $dirbak; ?>assets/css/dashboard.css">
	<link rel="stylesheet" href="<?php echo $dirbak; ?>assets/css/dashboard-style.css">
	<style>
		.chiller-theme .sidebar-wrapper {
			background: <?php echo $tenthcolor ?>;
			background-image: <?php echo $bgsidebarimg2; ?>;
			background-repeat: no-repeat;
			background-position: bottom;
			background-size: contain;
		}

		.chiller-theme .sidebar-wrapper .sidebar-menu ul li a i, .chiller-theme .sidebar-wrapper .sidebar-menu .sidebar-dropdown div, .chiller-theme .sidebar-wrapper .sidebar-search input.search-menu, .chiller-theme .sidebar-wrapper .sidebar-search .input-group-text {
			background: <?php echo $tenthcolor ?>;
		}

		.dboardbg {
			background-image: <?php echo $dboardbgimg2; ?>;
			background-repeat: no-repeat;
			background-size: cover;
			background-color: <?php echo $ninghtcolor ?>; /* rgb(255 255 255 / 60%); */
			background-position: right;
			background-position-y: top;
		}
	</style>
	<script src="<?php echo $dirbak; ?>assets/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="<?php echo $dirbak; ?>assets/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="<?php echo $dirbak; ?>assets/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="<?php echo $dirbak; ?>assets/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
	<script src="<?php echo $dirbak; ?>assets/boots/js/bootstrap-colorpicker/bootstrap-colorpicker.js"></script>
	<script src="//apis.google.com/js/platform.js" async defer></script>
</head>
<body id="myDashB" class="bg-light" data-spy="scroll" data-target=".navbar" data-offset="60" oncontextmenu="return false;">
	<!-- page-wrapper -->
	<div class="page-wrapper chiller-theme toggled dboardbg">