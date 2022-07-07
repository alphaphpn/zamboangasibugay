<?php

	include_once "../../inc/cnndb.php";
	$tblname = "conf";
	$tblname2 = strtoupper($tblname);
	$TableTitle = "Configuration";
	$msg_insert = "Insert default data for {$TableTitle} <br>";
	$dettodet = date("Ymd");

	$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
	$chksql = "SELECT 1 FROM {$tblname} LIMIT 1";
	$chksql = $cnn->query($chksql);

	if($chksql) {
		echo "Database Table: {$TableTitle}; Already exist!<br>";
	} else {
		try {
			$sql = "CREATE TABLE IF NOT EXISTS {$tblname2}(
				id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
				cmpny_name VARCHAR(254) NOT NULL, 
				sys_name VARCHAR(254) NOT NULL, 
				sys_ver VARCHAR(254) NOT NULL, 
				sys_logo VARCHAR(254) NOT NULL, 
				navbar_logo VARCHAR(254) NOT NULL, 
				favicon VARCHAR(254) NOT NULL, 
				quote_title VARCHAR(254) NOT NULL, 
				ceo_pres VARCHAR(254) NOT NULL, 
				memail VARCHAR(254) NOT NULL, 
				telno VARCHAR(254) NOT NULL, 
				mobileno VARCHAR(254) NOT NULL, 
				maddress TEXT NOT NULL, 
				idletime INT(11) NOT NULL, 
				themename VARCHAR(254) NOT NULL, 
				domainhome VARCHAR(254) NOT NULL, 
				fontglobal TEXT NOT NULL, 
				datetoday VARCHAR(8) NOT NULL, 
				created DATETIME NOT NULL, 
				primary_color VARCHAR(254) NOT NULL, 
				second_color VARCHAR(254) NOT NULL, 
				third_color VARCHAR(254) NOT NULL, 
				forth_color VARCHAR(254) NOT NULL, 
				fifth_color VARCHAR(254) NOT NULL, 
				sixth_color VARCHAR(254) NOT NULL, 
				seventh_color VARCHAR(254) NOT NULL, 
				eight_color VARCHAR(254) NOT NULL, 
				ninght_color VARCHAR(254) NOT NULL, 
				tenth_color VARCHAR(254) NOT NULL, 
				geo_map text NOT NULL, 
				build_by VARCHAR(254) NOT NULL, 
				cwebzite VARCHAR(254) NOT NULL, 
				dcurrencyx VARCHAR(15) NOT NULL, 
				modified TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp());";
			$cnn->exec($sql);
			echo "Database Table created successfully: {$TableTitle}.<br>";

			$sql_insert = "INSERT INTO {$tblname} (
					cmpny_name, 
					sys_name, 
					sys_ver, 
					sys_logo, 
					navbar_logo, 
					favicon, 
					quote_title, 
					ceo_pres, 
					memail, 
					telno, 
					mobileno, 
					maddress, 
					themename, 
					domainhome, 
					fontglobal, 
					datetoday, 
					idletime, 
					geo_map, 
					build_by, 
					cwebzite, 
					dcurrencyx, 
					created) 
				VALUES (
					'".$company."', 
					'".$title."', 
					'1.0.0', 
					'Logo.png', 
					'Logo.svg', 
					'favicon.ICO', 
					'".$tagline."', 
					'".$owner."', 
					'".$email."', 
					'".$telno."', 
					'".$mobileno."', 
					'".$address."', 
					'default', 
					'".$dir."', 
					'".$lnkfont."', 
					'".$dettodet."', 
					5, 
					'".$gps."', 
					'".$build_by."', 
					'".$cwebzite."', 
					'".$dcurrencyx."', 
					current_timestamp()
				)
				";
			$cnn->exec($sql_insert);
			echo $msg_insert;
		} catch(PDOException $e) {
			echo $e->getMessage()."<br>";
		}
		$cnn = null;
	}