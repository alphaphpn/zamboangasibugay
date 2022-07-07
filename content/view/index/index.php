<?php
	// Owner ID:	8
	// Theme:		-sibugay
	include_once "inc/pagevisit/index.php";
	include_once "content/theme/".$themename."/frontend-navbar.php";
	include_once "content/theme/".$themename."/slick-home-banner.php";
?>

	<div id="about" class="pt-5 pb-5" style="background-color: transparent;">
	<?php include_once "content/theme/".$themename."/template-part/aboutus.php"; ?>
	
	<div id="provincial-office" class="pt-5 pb-5" style="<?php echo 'background-color: '.$secondcolor.';'; ?>">
	<?php include_once "content/theme/".$themename."/template-part/provincial-office.php"; ?>

	<div id="municipality" class="pt-5 pb-5" style="background-color: transparent;">
	<?php include_once "content/theme/".$themename."/template-part/municipality.php"; ?>

	<div id="resources" class="pt-5 pb-5" style="<?php echo 'background-color: '.$secondcolor.';'; ?>">
	<?php include_once "content/theme/".$themename."/template-part/resources.php"; ?>

	<div id="careers"  class="pt-5 pb-5" style="background-color: transparent;">
	<?php include_once "content/theme/".$themename."/template-part/careers.php"; ?>

	<div id="transparency" class="pt-5 pb-5" style="<?php echo 'background-color: '.$secondcolor.';'; ?>">
	<?php include_once "content/theme/".$themename."/template-part/transparency.php"; ?>

<div id="contact" class="pt-5 pb-5" style="background-color: transparent;">
<?php
	include_once "content/theme/".$themename."/template-part/contactus.php";
	if ( empty($geomap) ) {
		echo "<p align='center'>Can't Load Map.</p>";
	} else {
		echo '<iframe class="responsive-iframe map-footer" src="https://maps.google.com/maps?q='.$geomap.'&t=&z=15&ie=UTF8&iwloc=&output=embed" width="100%" height="450" frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>';
	}
	// include_once('addon/chatbox/index.php');
?>