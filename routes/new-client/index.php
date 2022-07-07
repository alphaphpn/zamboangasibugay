<?php

	$companyname		= isset($_GET['companyname']) ? $_GET['companyname'] : die('ERROR: Company not found.');
	$fullname			= isset($_GET['fullname']) ? $_GET['fullname'] : die('ERROR: Name not found.');
	$email				= isset($_GET['email']) ? $_GET['email'] : die('ERROR: Email not found.');
	$phone				= isset($_GET['phone']) ? $_GET['phone'] : die('ERROR: Phone not found.');

	$phone2				= preg_replace('/\D/', '', $phone);
	$remphnz			= preg_replace('/\s+/', '', $phone2);
	$rcnt				= strlen($remphnz) - 10;
	$rphone				= substr($remphnz,$rcnt,10);

	$permitted_chars2	= '0123456789';
	$pin				= trim(substr(str_shuffle($permitted_chars2), 0, 6));
	$getfullname		= explode(' ',$fullname);
	$fname				= $getfullname[0];
	$lname				= $getfullname[1];

	$getusername = explode('@',$email);
	$younickname = $getusername[0];
	$urlmail = $getusername[1];

	$agentData = array( array(
			"phone"				=> $rphone,
			"firstName"			=> $fname,
			"lastName"			=> $lname,
			"identifier"		=> $rphone,
			"email"				=> $email,
			"isPrimaryContact"	=> true,
			"timeZone"			=> "Newfoundland Standard Time"
		)
	);

	$postData = [ "clientName"	=> $companyname, 
		"primaryEmail"			=> $email, 
		"password"				=> $pin, 
		"timezone"				=> "Eastern Standard Time", 
		"Email"					=> $email, 
		"product"				=> "Generic", 
		"numberofattempts"		=> 3, 
		"concurrentsessions"	=> 1, 
		"agentwaittime"			=> 300, 
		"requiredChat"			=> false, 
		"requiredSMS"			=> true, 
		"serviceType"			=> "URL", 
		"agents"				=> $agentData
	];

	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL				=> 'https://portal.taptext.com/api/client',
		CURLOPT_RETURNTRANSFER	=> true,
		CURLOPT_ENCODING		=> '',
		CURLOPT_MAXREDIRS		=> 10,
		CURLOPT_TIMEOUT			=> 0,
		CURLOPT_FOLLOWLOCATION	=> true,
		CURLOPT_HTTP_VERSION	=> CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST	=> 'POST',
		CURLOPT_POSTFIELDS		=> json_encode($postData),
		CURLOPT_HTTPHEADER => array('Authorization: Bearer eyJJZCI6MjY3NiwiVXNlck5hbWUiOiJtb2t1YXBpIiwiRmlyc3ROYW1lIjoiTW9rdSIsIkxhc3ROYW1lIjoiTW9rdSIsIlVzZXJUeXBlIjoiQXBpIiwiQ3JlYXRlRGF0ZVRpbWUiOiIwMDAxLTAxLTAxVDAwOjAwOjAwIiwiQXV0aFRva2VuIjpudWxsLCJGdWxsTmFtZSI6Ik1va3UgTW9rdSIsIkFjdGl2ZSI6dHJ1ZSwiRW1haWwiOiJzdXBwb3J0QG1va3UuY29tIiwiRGF0YUlkIjpudWxsLCJSZXNldFJlcXVpcmVkIjpmYWxzZSwiQ2xpZW50cyI6bnVsbCwiSXNOZXdVc2VyIjpmYWxzZX0=','Content-Type: application/json','Cookie: ARRAffinity=494acb0649f73ac431c4f5fb9dcc6c4205d4ebcd2f84ed07bca9c66614909a36;ARRAffinitySameSite=494acb0649f73ac431c4f5fb9dcc6c4205d4ebcd2f84ed07bca9c66614909a36'),
	));

	$response = curl_exec($curl);

	curl_close($curl);
	echo $response;

	$obj = json_decode($response);

	// ----------------------------------------------------------

	try {
		include_once "../../inc/core.php";
		include_once "../../inc/srvr.php";
		$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);

		$urlhttp = $_SERVER['HTTP_HOST'];
		// $portalurl = "https://portal.taptext.com?login_username=".$obj->clientId}."&login_password=".$pin;
		$portalurl = $urlhttp.$dir."/routes/login/?username=".$younickname."&passcode=".$pin;

		$qry_insert = "INSERT INTO tbl_sysuser SET 
				usercode=:idx, 
				img_url=:imgurl, 
				username=:younicknamex, 
				fullname=:fullname, 
				lname=:lname, 
				fname=:fname, 
				mname=:mname, 
				cmpny=:company, 
				uemail=:xemail, 
				umobileno=:xphone, 
				passcode=:passcode1x, 
				ulevpos=4, 
				xposition=:xposition, 
				address=:address, 
				ustatz=1, 
				gogfirstime=0, 
				pin=:pin"
			;
		$stmt_insert = $cnn->prepare($qry_insert);

		$fromidted = $obj->clientId;
		$imgurl = "https://www.w3schools.com/bootstrap4/img_avatar3.png";
		
		$passcode1 = trim(md5($pin));
		$xposition = "Client";
		$address = "Address";

		$stmt_insert->bindParam(':idx', $fromidted);
		$stmt_insert->bindParam(':imgurl', $imgurl);
		$stmt_insert->bindParam(':younicknamex', $younickname);
		$stmt_insert->bindParam(':fullname', $fullname);
		$stmt_insert->bindParam(':lname', $lname);
		$stmt_insert->bindParam(':fname', $fname);
		$stmt_insert->bindParam(':mname', $lname);
		$stmt_insert->bindParam(':company', $companyname);
		$stmt_insert->bindParam(':xemail', $email);
		$stmt_insert->bindParam(':xphone', $rphone);
		$stmt_insert->bindParam(':passcode1x', $passcode1);
		$stmt_insert->bindParam(':xposition', $xposition);
		$stmt_insert->bindParam(':address', $address);
		$stmt_insert->bindParam(':pin', $pin);
		$stmt_insert->execute();

		$err_msg = "Account successfully registered. Kindly check your email inbox/spam for your credential.";
		echo "<script>alert('{$err_msg}');window.open('{$portalurl}','_blank');</script>";

		$msg =	"Click the link below to login to the portal.\n{$portalurl}\nCompany: {$companyname}\nUsername: {$younickname}\nTemporary Password: {$pin}\nTo secure your account, kindly change your password immediately.\nClient ID: {$obj->clientId}\nFirst Name: {$fname}\nLast Name: {$lname}\nEmail: {$email}\nPhone: {$rphone}";
		$msg = wordwrap($msg,70);
		mail("{$email}","Whisp Credential New Account",$msg);
	} catch (PDOException $exception) {
		die('ERROR: ' . $exception->getMessage());
	}

	// ----------------------------------------------------------
