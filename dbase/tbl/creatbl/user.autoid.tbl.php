<?php

	include_once "../../inc/cnndb.php";
	$tblname = "tbl_sysuser_autoid";
	$tblname2 = strtoupper($tblname);
	$TableTitle = "System User AutoID";

	$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
	$chksql = "SELECT 1 FROM {$tblname} LIMIT 1";
	$chksql = $cnn->query($chksql);

	if($chksql) {
		echo "Database Table: {$TableTitle}; Already exist!<br>";
	} else {
		try {
			$sql = "CREATE TABLE IF NOT EXISTS {$tblname2}(
				id INT(11) AUTO_INCREMENT PRIMARY KEY, 
				fieldtxt TEXT NOT NULL, 
				created TIMESTAMP NOT NULL DEFAULT current_timestamp());";
			$cnn->exec($sql);
			echo "Database Table created successfully: {$TableTitle}.<br>";
		} catch(PDOException $e) {
			echo $e->getMessage()."<br>";
		}
		$cnn = null;
	}