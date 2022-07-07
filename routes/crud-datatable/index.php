<?php

	include_once "../../inc/core.php";
	include_once "../../inc/webconfig/conf.php";
	$page_title = "CRUD DataTable";
	$foldername = "crud-datatable";
	$tblname = "tbl_crud";
	$prim_id = "id";
	$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
	include_once "../../content/template-part/{$themename}/dashboard-header.php";
	include_once "../../content/view/{$foldername}/index.php";
	include_once "../../content/template-part/{$themename}/dashboard-footer.php";