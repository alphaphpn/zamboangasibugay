<?php

	include_once "../../inc/cnndb.php";
	$tblname = "tbl_themename";
	$tblname2 = strtoupper($tblname);
	$TableTitle = "Theme";
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
				themename VARCHAR(254) NOT NULL, 
				version VARCHAR(254) NOT NULL, 
				authorby VARCHAR(254) NOT NULL, 
				description TEXT NOT NULL, 
				tagz VARCHAR(254) NOT NULL, 
				thumbnailt VARCHAR(254) NOT NULL, 
				created DATETIME NOT NULL DEFAULT current_timestamp(), 
				modified TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(), 
				deletedx INT(1) NOT NULL
			);";
			$cnn->exec($sql);
			echo "Database Table created successfully: {$TableTitle}.<br>";

			$sql_insert = "INSERT INTO {$tblname} (
					themename, 
					version, 
					authorby, 
					description, 
					tagz, 
					thumbnailt, 
					deletedx
				) 
				VALUES (
					'default', 
					'1.0.0', 
					'Author B. Cone', 
					'Web Theme Skin is a custom bootstrap 4 design. It features custom styles for all the default blocks, and is built so that what you see in the editor looks like what you’ll see on your website. Web Theme Skin is designed to be adaptable to a wide range of websites, whether you’re running a photo blog, launching a new business, or supporting a non-profit. Featuring ample whitespace and modern sans-serif headlines paired with classic serif body text, it’s built to be beautiful on all screen sizes.', 
					'custom-background, custom-logo, custom-menu, featured-images, threaded-comments, translation-ready', 
					'Thumbnail.jpg', 
					0
				), (
					'Sample', 
					'0.0.0', 
					'None', 
					'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 
					'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 
					'Thumbnail.jpg', 
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