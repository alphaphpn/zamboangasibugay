<?php

	include_once "../../../inc/core.php";
	include_once "../../../inc/srvr.php";
	include_once "../../../inc/webconfig/conf.php";
	$page_title = "Edit record";
	$foldername = "crud-datatable";
	$tblname = "tbl_crud";
	$prim_id = "id";
	$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
	include_once "../../../content/template-part/{$themename}/dashboard-header.php";
	include_once "../../../content/view/{$foldername}/editupdate.php";
	include_once "../../../content/template-part/{$themename}/dashboard-footer.php";