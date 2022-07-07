<?php

	include_once "../../inc/srvr.php";

	try {
		$cnn = new PDO("mysql:host={$host};", $unameroot, $pw);
		$cnn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DROP DATABASE ".$db;
		$cnn->exec($sql);
		echo "Database Successfully Deleted!<br>";
		echo "<a href='../../'>Goto Homepage</a>";
	} catch(PDOException $e) {
		echo "Error: ".$e->getMessage()."<br>";
	}