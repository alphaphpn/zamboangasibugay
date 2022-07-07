<?php
	// Theme: -default

	if ($xposition == 'Administrator') {
		$currposit = 1;
	} elseif ($xposition == 'Staff') {
		$currposit = 2;
	} elseif ($xposition == 'Cashier') {
		$currposit = 3;
	} elseif ($xposition == 'Client') {
		$currposit = 4;
	} elseif ($xposition == 'Agent') {
		$currposit = 5;
	} elseif ($xposition == 'Customer') {
		$currposit = 6;
	} else {
		$currposit = 0;
	}