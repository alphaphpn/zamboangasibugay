<?php

	include_once "../../inc/cnndb.php";
	$tblname = "tbl_item";
	$tblname2 = strtoupper($tblname);
	$TableTitle = "Item";
	$msg_insert = "Insert default data for {$TableTitle} <br>";

	$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
	$chksql = "SELECT 1 FROM {$tblname} LIMIT 1";
	$chksql = $cnn->query($chksql);

	if($chksql) {
		echo "Database Table: {$TableTitle}; Already exist!<br>";
	} else {
		try {
			$sql = "CREATE TABLE IF NOT EXISTS {$tblname2}(
				item_id INT(11) AUTO_INCREMENT PRIMARY KEY, 
				barcode VARCHAR(254) NOT NULL, 
				name VARCHAR(100) NOT NULL, 
				description VARCHAR(254) NOT NULL, 
				category VARCHAR(254) NOT NULL, 
				unit VARCHAR(254) NOT NULL, 
				sell_price DOUBLE NOT NULL, 
				sale_price DOUBLE NOT NULL, 
				supplier_price DOUBLE NOT NULL, 
				stock_available INT(11) NOT NULL, 
				size VARCHAR(50) NOT NULL, 
				color VARCHAR(50) NOT NULL, 
				quality VARCHAR(100) NOT NULL, 
				status INT(1) NOT NULL, 
				created DATETIME NOT NULL DEFAULT current_timestamp(), 
				modified TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(), 
				deletedx INT(1) NOT NULL
			);";
			$cnn->exec($sql);
			echo "Database Table created successfully: {$TableTitle}.<br>";
		} catch(PDOException $e) {
			echo $e->getMessage()."<br>";
		}
		$cnn = null;
	}

/**
	item_id
	barcode
	name
	description
	category
	unit
	sell_price
	sale_price
	supplier_price
	stock_available
	size
	color
	quality
	status
*/
