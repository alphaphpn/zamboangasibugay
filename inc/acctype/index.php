<?php
	// Theme: -default

	if($_SESSION["ulevpos"]==1) {
		?>
			<option value="Guest" selected>- Select User Type -</option>
			<option value="Administrator" <?php if($xposition=="Administrator") echo 'selected="selected"'; ?>>Administrator</option>
			<option value="Staff" <?php if($xposition=="Staff") echo 'selected="selected"'; ?>>Staff</option>
			<option value="Cashier" <?php if($xposition=="Cashier") echo 'selected="selected"'; ?>>Cashier</option>
			<option value="Client" <?php if($xposition=="Client") echo 'selected="selected"'; ?>>Client</option>
			<option value="Agent" <?php if($xposition=="Agent") echo 'selected="selected"'; ?>>Agent</option>
			<option value="Customer" <?php if($xposition=="Customer") echo 'selected="selected"'; ?>>Customer</option>
		<?php
	} elseif ($_SESSION["ulevpos"]==4) {
		?>
			<option value="Guest" datav="Guest" selected>- Select User Type -</option>
			<option value="Staff" <?php if($xposition=="Staff") echo 'selected="selected"'; ?>>Staff</option>
			<option value="Agent" <?php if($xposition=="Agent") echo 'selected="selected"'; ?>>Agent</option>
		<?php
	} else {
		?>
			<option value="Guest" datav="Guest" selected>- Select User Type -</option>
			<option value="Customer" <?php if($xposition=="Customer") echo 'selected="selected"'; ?>>Customer</option>
		<?php
	}
?>

