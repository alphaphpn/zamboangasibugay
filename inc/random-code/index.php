<?php

	$strand_01 = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$strand_02 = '0123456789';
	$strand_03 = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$strand_04 = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ~!@^*';
	$strand_05 = '0123456789abcdefghijklmnopqrstuvwxyz';

	// Not allowed: # & + \ ' ?

	// 6 digit random number
	$randcode6 = substr(str_shuffle($strand_02), 0, 6);

	// Weak Password
	$randWPass = substr(str_shuffle($strand_05), 0, 8);

	// Semi-Strong Password
	$randSSPass = substr(str_shuffle($strand_04), 0, 12);

	// Strong Password
	$randSPass = substr(str_shuffle($strand_04), 0, 24);

	// WiFi Random Password
	$randWiFi6 = substr(str_shuffle($strand_01), 0, 6);



