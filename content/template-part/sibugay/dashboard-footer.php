<?php
	$chckfledashf = file_exists("../../assets/css/style.css");
	if ($chckfledashf) {
		$dirbakf = "../../";
	} else {
		$chckfledashf1 = file_exists("../../../assets/css/style.css");
		if ($chckfledashf1) {
			$dirbakf = "../../../";
		} else {
			$dirbakf = "../../../../";
		}
	}
?>

	</div>

	<?php include_once $dirbakf."content/view/item-pay/index.php" ?>
	<script>
		function scrollFunction() {
			if (document.body.scrollTop > 0 || document.documentElement.scrollTop > 0) {
				document.getElementById("navbar").style.padding = ".5rem 1rem";
				document.getElementById("dbrd-navbar").style.backgroundColor = "<?php echo $primarycolor; ?>";
				document.getElementById("navbar").getElementsByClassName("dropdown-menu")[0].style.backgroundColor = "<?php echo $primarycolor; ?>";
			} else {
				document.getElementById("navbar").style.padding = ".8rem 1rem";
				document.getElementById("dbrd-navbar").style.backgroundColor = "<?php echo $forthcolor; ?>";
				document.getElementById("dbrd-navbar").style.backgroundImage = "none";
				document.getElementById("navbar").getElementsByClassName("dropdown-menu")[0].style.backgroundColor = "<?php echo $forthcolor; ?>";
			}
		}
	</script>
	<script src="<?php echo $dirbakf; ?>assets/js/dashboard.js"></script>
	<script src="<?php echo $dirbakf; ?>assets/js/dashboard-script.js"></script>
</body>
</html>