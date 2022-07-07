<?php

	include_once "../cnndb.php";

	try {
		$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
		$qry_webconf = "SELECT * FROM conf LIMIT 1";
		$stmt_webconf = $cnn->prepare($qry_webconf);
		$stmt_webconf->execute();
		$row_webconf = $stmt_webconf->fetch(PDO::FETCH_ASSOC);

		$cmpnyname = $row_webconf['cmpny_name'];
		$sysname = $row_webconf['sys_name'];
		$sysver = $row_webconf['sys_ver'];
		$syslogo = $row_webconf['sys_logo'];
		$navbarlogo = $row_webconf['navbar_logo'];
		$favicon = $row_webconf['favicon'];
		$quotetitle = $row_webconf['quote_title'];
		$ceopres = $row_webconf['ceo_pres'];
		$memail = $row_webconf['memail'];
		$telno = $row_webconf['telno'];
		$mobileno = $row_webconf['mobileno'];
		$maddress = $row_webconf['maddress'];
		$themename = "content/theme/".$row_webconf['themename'];
		$domainhome = $row_webconf['domainhome'];
		$idletime = $row_webconf['idletime'] * 60;
		$navbarorrient = $row_webconf['nav_bar_orrient'];

		$appinfo = array(
				"CompanyName"	=> $cmpnyname, 
				"AppTitle"		=> $sysname, 
				"AppVersion"	=> $sysver, 
				"AppLogo"		=> $syslogo, 
				"NavBarLogo"	=> $navbarlogo, 
				"AppIcon"		=> $favicon, 
				"QuoteTitle"	=> $quotetitle, 
				"OwnerCEO"		=> $ceopres, 
				"Email"			=> $memail, 
				"TelNo"			=> $telno, 
				"MobileNo"		=> $mobileno, 
				"Address"		=> $maddress, 
				"ThemeName"		=> $themename, 
				"xHomeDomain"	=> $domainhome, 
				"IdleTime"		=> $idletime, 
				"MenuPosition"	=> $navbarorrient
			);

		print(json_encode($appinfo));
	} catch(PDOException $e) {
		$err = $e->getMessage();
		$err2 = strrchr($e,"1049");
		if($err2=1049){
			echo "Error: Unknown Database.<br><a href='dbase/creadb'>Fix It!</a>";
			die;
		}
	}
	$cnn = null;