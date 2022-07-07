<?php

	if(empty($_SESSION["usercode"]) || empty($_SESSION["username"]) || empty($_SESSION["fullname"]) || empty($_SESSION["ulevpos"]) || empty($_SESSION["surname"]) || empty($_SESSION["firstname"]) || empty($_SESSION["middlename"]) || empty($_SESSION["postitle"])) {
		header("location:../login");
	} else {
		$uid			= $_SESSION['usercode'];
		$uname			= $_SESSION["username"];
		$comname		= $_SESSION["fullname"];
		$positionx		= $_SESSION["ulevpos"];
		$imgpixg		= $_SESSION["imglnkurl"];
		$imgpext		= $_SESSION["imglnkext"];

		$lastname		= $_SESSION["surname"];
		$givename		= $_SESSION["firstname"];
		$mamaname		= $_SESSION["middlename"];
		$ptitle			= $_SESSION["postitle"];
		$cremail		= $_SESSION["email"];

		$gogfirstime	= $_SESSION["gogfirstime"];
	}