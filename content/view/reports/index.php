<?php
	include_once "../../content/template-part/{$themename}/dashboard-navbar.php";
	include_once "../../inc/core.php";
	include_once "../../inc/srvr.php";
	$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
?>

<main class="page-content">
	<div class="container-fluid"></div>
</main>