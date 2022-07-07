<?php

	include_once "../../../inc/core.php";
	include_once "../../../inc/webconfig/conf.php";
	$page_title = "Profile";
	if ($_SESSION["ulevpos"]==6) {
		echo '<script>alert("Access denied.");window.open("../../../","_self")</script>';
	}
	include_once "../../../content/template-part/".$themename."/dashboard-header.php";
	include_once "../../../content/view/user/profile.php";
	include_once "../../../content/template-part/".$themename."/dashboard-footer.php";