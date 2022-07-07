<?php

	// ID Format :	 2020 11 24 000 	||		4 2 2 3		||		=> 11
	include_once "../../inc/cnndb.php";
	$tblname = "tbl_sysuser";
	$tblname2 = strtoupper($tblname);
	$TableTitle = "System User";
	$msg_insert = "Insert default data for {$TableTitle} <br>";

	$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
	$chksql = "SELECT 1 FROM {$tblname} LIMIT 1";
	$chksql = $cnn->query($chksql);

	if($chksql) {
		echo "Database Table: {$TableTitle}; Already exist!<br>";
	} else {
		try {
			$sql = "CREATE TABLE IF NOT EXISTS {$tblname2}(
				usercode VARCHAR(254) PRIMARY KEY, 
				username VARCHAR(254) NOT NULL, 
				passcode VARCHAR(254) NOT NULL, 
				pin VARCHAR(6) NOT NULL, 
				fullname text NOT NULL, 
				uemail VARCHAR(254) NOT NULL, 
				umobileno VARCHAR(254) NOT NULL, 
				xposition VARCHAR(254) NOT NULL, 
				secquest VARCHAR(254) NOT NULL, 
				secans VARCHAR(254) NOT NULL, 
				ulevpos INT(3) NOT NULL, 
				uonline INT(1) NOT NULL, 
				ustatz INT(1) NOT NULL, 
				createdby VARCHAR(254) NOT NULL, 
				lname text NOT NULL, 
				fname text NOT NULL, 
				mname text NOT NULL, 
				img_url text NOT NULL, 
				deletedx INT(1) NOT NULL, 
				created DATETIME NOT NULL DEFAULT current_timestamp(), 
				modified TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp());";
			$cnn->exec($sql);
			echo "Database Table created successfully: {$TableTitle}.<br>";

			$autoID = date("Ymd");
			$admin = md5('admin');
			$user = md5('user');
			$guest = md5('guest');
			$sql_insert = "INSERT INTO {$tblname} (
					usercode, 
					username, 
					passcode, 
					pin, 
					fullname, 
					uemail, 
					umobileno, 
					xposition, 
					secquest, 
					secans, 
					ulevpos, 
					uonline, 
					ustatz, 
					createdby, 
					lname, 
					fname, 
					mname
					) 
				VALUES (
					'00000000000', 
					'admin', 
					'".$admin."', 
					'123456', 
					'Admin A. Minad', 
					'admin@info.com', 
					'+639154826025', 
					'Administrator', 
					'What is your the name of your favorite dog?', 
					'you', 
					'1', 
					'0', 
					'1', 
					'00000000000', 
					'Minad', 
					'Admin', 
					'Amind'
				), (
					'00000000001', 
					'user', 
					'".$user."', 
					'123456', 
					'User U. Resu', 
					'user@info.com', 
					'+639123456789', 
					'User',  
					'What is your the name of your favorite dog?', 
					'me', 
					'2', 
					'0', 
					'1', 
					'00000000000', 
					'Resu', 
					'User', 
					'Uesr'
				), (
					'00000000002', 
					'guest', 
					'".$guest."', 
					'123456', 
					'Guest G. Tseug', 
					'guest@info.com', 
					'+639123456789', 
					'Guest',  
					'What is your the name of your favorite dog?', 
					'him', 
					'3', 
					'0', 
					'0', 
					'00000000000', 
					'Tseug', 
					'Guest', 
					'Geust'
				)
				";
			$cnn->exec($sql_insert);
			echo $msg_insert;
		} catch(PDOException $e) {
			echo $e->getMessage()."<br>";
		}
		$cnn = null;
	}