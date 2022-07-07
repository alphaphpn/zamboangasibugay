<?php

	include_once "../../inc/cnndb.php";
	$tblname = "tbl_contactform";
	$tblname2 = strtoupper($tblname);
	$TableTitle = "Contact Form";
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
				fullname VARCHAR(150) NOT NULL, 
				email VARCHAR(100) NOT NULL, 
				phone VARCHAR(30) NOT NULL, 
				subject VARCHAR(100) NOT NULL, 
				message TEXT NOT NULL, 
				created DATETIME NOT NULL DEFAULT current_timestamp(), 
				deleted INT(1) NOT NULL, 
			);";
			$cnn->exec($sql);
			echo "Database Table created successfully: {$TableTitle}.<br>";

			$sql_insert = "INSERT INTO {$tblname} (
					fullname, 
					email, 
					phone, 
					subject, 
					message, 
					deleted
				) 
				VALUES (
					'Fullname', 
					'E-mail', 
					'+639154826025', 
					'Subject', 
					'Message', 
					0
				)";
			$cnn->exec($sql_insert);
			echo $msg_insert;
		} catch(PDOException $e) {
			echo $e->getMessage()."<br>";
		}
		$cnn = null;
	}