<?php

	$chckfle = file_exists("inc/srvr.php");
	if ($chckfle) {
		include_once "inc/srvr.php";
	} else {
		$chckfle1 = file_exists("../../inc/srvr.php");
		if ($chckfle1) {
			include_once "../../inc/srvr.php";
		} else {
			$chckfle2 = file_exists("../../../inc/srvr.php");
			if ($chckfle2) {
				include_once "../../../inc/srvr.php";
			} else {
				include_once "../../../../inc/srvr.php";
			}
		}
	}

	try {
		$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
		
		$update_pagevisit = "UPDATE conf SET page_visit=page_visit+1 WHERE id=:uownerid";
		$stmtup_pagevisit = $cnn->prepare($update_pagevisit);
		$stmtup_pagevisit->bindParam(':uownerid', $owner_id);
		$stmtup_pagevisit->execute();
	} catch(PDOException $e) {
		$err = $e->getMessage();
		$err2 = strrchr($e,"1049");
		if($err2=1049){
			echo "Error: Unknown Database.<br><a href='../../dbase/creadb'>Fix It!</a>";
			die;
		}
	}
	$cnn = null;