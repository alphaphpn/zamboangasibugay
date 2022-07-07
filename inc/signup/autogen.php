<?php

	// Get save date format string
	$qry_detsaved= "SELECT datetoday FROM conf WHERE id=:ownerid";
	$stmt_detsaved = $cnn->prepare($qry_detsaved);
	$stmt_detsaved->bindParam(':ownerid', $owner_id);
	$stmt_detsaved->execute();
	$row_detsaved = $stmt_detsaved->fetch(PDO::FETCH_ASSOC);
	$thedetsaved = $row_detsaved['datetoday'];

	$datecurr = date("Ymd");
	$finaldeta = '';
	if ($thedetsaved==$datecurr) {
		// continue process
		$finaldeta = $thedetsaved;
	} else {
		// truncate auto_id
		$qry_resetautoid= "TRUNCATE TABLE tbl_sysuser_autoid";
		$stmt_resetautoid = $cnn->prepare($qry_resetautoid);
		$stmt_resetautoid->execute();

		// Update Date on System Settings
		$qry_updetdet = "UPDATE conf SET datetoday=:datetodayx";
		$stmt_updetdet = $cnn->prepare($qry_updetdet);
		$stmt_updetdet->bindParam(':datetodayx', $datecurr);
		$stmt_updetdet->execute();
		$finaldeta = $datecurr;
	}

	// Auto ID Generate
	$qry_autoid = "INSERT INTO tbl_sysuser_autoid (fieldtxt) VALUES ('a')";
	$stmt_autoid = $cnn->prepare($qry_autoid);
	$stmt_autoid->execute();

	// Get last record ID
	$qry_lastid = "SELECT id FROM tbl_sysuser_autoid ORDER BY id DESC";
	$stmt_lastid = $cnn->prepare($qry_lastid);
	$stmt_lastid->execute();
	$row_lastid = $stmt_lastid->fetch(PDO::FETCH_ASSOC);
	$thelastid = $row_lastid['id'];

	$lengthid = 4;
	$stringid = substr(str_repeat(0, $lengthid).$thelastid, - $lengthid);

	$fromidted = $finaldeta.$stringid;