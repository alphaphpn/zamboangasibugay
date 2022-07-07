<?php

	include_once "../../inc/cnndb.php";
	$tblname = "tbl_crud";
	$tblname2 = strtoupper($tblname);
	$TableTitle = "CRUD";
	$msg_insert = "Insert default data for {$TableTitle} <br>";

	$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
	$chksql = "SELECT 1 FROM {$tblname} LIMIT 1";
	$chksql = $cnn->query($chksql);

	if($chksql) {
		echo "Database Table: {$TableTitle}; Already exist!<br>";
	} else {
		try {
			$sql = "CREATE TABLE IF NOT EXISTS {$tblname2}(
				id INT(11) AUTO_INCREMENT PRIMARY KEY, 
				fieldtxt VARCHAR(254) NOT NULL, 
				status INT(1) NOT NULL, 
				created DATETIME NOT NULL DEFAULT current_timestamp(), 
				modified TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(), 
				deletedx INT(1) NOT NULL
			);";
			$cnn->exec($sql);
			echo "Database Table created successfully: {$TableTitle}.<br>";

			$sql_insert = "INSERT INTO {$tblname} (
					fieldtxt, 
					status, 
					deletedx
				) 
				VALUES (
					'Sample', 
					1, 
					0
				), (
					'Sample2', 
					0, 
					0
				)
				";
			$cnn->exec($sql_insert);
			echo $msg_insert;
		} catch(PDOException $e) {
			echo $e->getMessage()."<br>";
		}
		$cnn = null;
	}