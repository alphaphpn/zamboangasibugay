<?php

	include_once "../../inc/srvr.php";

	try {
		$cnn = new PDO("mysql:host={$host};", $unameroot, $pw);
		$cnn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE DATABASE IF NOT EXISTS ".$db;
		$cnn->exec($sql);
		$sql = "use ".$db;
		$cnn->exec($sql);
		echo "Database Successfully Created!<br>";
		echo "<a href='../creatbl'>Install Default Data Storage.</a>";
	} catch(PDOException $e) {
		echo "Error: ".$e->getMessage()."<br>";
	}