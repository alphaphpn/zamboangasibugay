<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta http-equiv="refresh" content="<?php echo $idletime ?>">
	<title>
		<?php
			if (empty($page_title)) {
				echo $sysname;
			} else {
				echo $sysname.": ".$page_title;
			}
		?>
	</title>
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<META HTTP-EQUIV="Expires" CONTENT="-1">
	<meta name="google-signin-scope" content="profile email">
	<meta name="google-signin-client_id" content="<?php echo $gauthlogin; ?>">
	<link rel="icon" type="image/png" href="<?php echo $domainhome.'content/theme/'.$themename.'/storage/img/'.$favicon; ?>">
	<link rel="stylesheet" href="<?php echo $fontglobal; ?>">
	<link rel="stylesheet" href="<?php echo $domainhome; ?>assets/fontawesome/releases/v5.7.0/css/all.css">
	<link rel="stylesheet" href="<?php echo $domainhome; ?>assets/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo $domainhome; ?>assets/npm/slick-carousel@1.8.1/slick/slick.css">
	<link rel="stylesheet" href="<?php echo $domainhome; ?>assets/css/style.css">
	<link rel="stylesheet" href="<?php echo $domainhome; ?>content/theme/<?php echo $themename; ?>/assets/css/style.css">
	<link rel="stylesheet" href="<?php echo $domainhome; ?>content/theme/<?php echo $themename; ?>/assets/css/custom-style.css">
	<style><?php echo $customstyle; ?></style>
	<script src="<?php echo $domainhome; ?>assets/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="<?php echo $domainhome; ?>assets/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="<?php echo $domainhome; ?>assets/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="<?php echo $domainhome; ?>assets/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
	<script src="//apis.google.com/js/platform.js" async defer></script>
</head>
<body id="myHome" data-spy="scroll" data-target=".navbar" data-offset="60" oncontextmenu="return false;" class="bg-default">