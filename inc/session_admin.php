<?php

	if (empty($_SESSION["usercode"]) || empty($_SESSION["username"]) || empty($_SESSION["fullname"]) || empty($_SESSION["ulevpos"]) || empty($_SESSION["surname"]) || empty($_SESSION["firstname"]) || empty($_SESSION["middlename"]) || empty($_SESSION["postitle"])) {
		echo '<script>alert("Please login.");window.open("'.$dir.'routes/login","_self");</script>';
	} elseif ($_SESSION["ulevpos"]!==1) {
		// Access denied! Only Admin Account
		echo '<script>alert("Access denied! Only Admin Account is Authorize.");window.open("'.$dir.'","_self");</script>';
	} else {

	}