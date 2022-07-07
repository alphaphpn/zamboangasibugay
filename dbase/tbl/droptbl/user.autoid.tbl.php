<?php

	include_once "../../../inc/cnndb.php";
	$tblname = "tbl_sysuser_autoid";
	$tblname2 = strtoupper($tblname);

	$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
	$chksql=$cnn->prepare("DROP TABLE {$tblname}");

	if ($chksql->execute()) {
		echo "Database Table: {$tblname2}; Deleted!<br>";
	} else {
		echo "{$tblname2} Already Deleted!<br>";
		echo "<a href='/weseems'>Back</a>";
	}