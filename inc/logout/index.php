<?php

	session_start();
	session_destroy();
	echo "Redirect to login..";
	header('location:../../');