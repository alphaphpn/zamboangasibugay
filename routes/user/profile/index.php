<?php

	include_once "../../../inc/core.php";
	include_once "../../../inc/webconfig/conf.php";
	$page_title = "Profile";
	$foldername = "user";
	$tblname = "tbl_sysuser";
	$prim_id = "usercode";
	$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
	include_once "../../../content/template-part/{$themename}/dashboard-header.php";
	include_once "../../../content/view/{$foldername}/profile.php";
	include_once "../../../content/template-part/{$themename}/dashboard-footer.php";