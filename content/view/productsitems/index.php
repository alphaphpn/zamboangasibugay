<?php
	include_once "../../content/theme/{$themename}/frontend-navbar.php";
	include_once "../../content/theme/{$themename}/slick-home-banner.php";
	?>
	<div class="pt-5 pb-5" style="background-color: transparent;">
	<?php
	include_once "../../content/theme/{$themename}/template-part/productsitem.php";
	if ( empty($geomap) ) {
		echo "<p align='center'>Can't Load Map.</p>";
	} else {
		echo '<iframe class="responsive-iframe map-footer" src="https://maps.google.com/maps?q='.$geomap.'&t=&z=15&ie=UTF8&iwloc=&output=embed" width="100%" height="450" frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>';
	}
?>