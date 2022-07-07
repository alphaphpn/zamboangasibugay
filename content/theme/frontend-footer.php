	<section style="<?php echo 'background-color: '.$thirdcolor.';'; ?>">
		<footer class="<?php echo $contentwidth; ?> text-center footer pt-2 pb-2">
			<a href="#myHome" id="topnotchaer" title="To Top">
				<span class="fas fa-chevron-circle-up"></span>
			</a>
			<p class="m-0" style="color: #fff;">Copyright &copy; <?php echo date('Y'); ?> <a href="//<?php echo $cwebzite ?>" style="color: #fff;" target="_blank" title="Visit <?php echo $cmpnyname ?>"><?php echo $cmpnyname ?></a> | <a href="#" title="Terms & Conditions" style="color: #fff;">Terms & Conditions</a> | <a href="#" title="Privacy Policy" style="color: #fff;">Privacy Policy</a> | All Rights Reserved.</p>
			<p style="color: #fff;">Made by: <a href="<?php echo $cwebzite; ?>" target="_blank" style="color: #fff;"><?php echo $build_by; ?></a></p>
		</footer>
	</section>
	<script src="<?php echo $domainhome; ?>assets/js/script.js"></script>
	<script src="<?php echo $domainhome; ?>content/theme/<?php echo $themename; ?>/assets/js/script.js"></script>
	<script>
		function scrollFunction() {
			if (document.body.scrollTop > 0 || document.documentElement.scrollTop > 0) {
				document.getElementById("navbar").style.padding = ".5rem 1rem";
				document.getElementById("mlogo").style.maxHeight = "48px";
				document.getElementById("mlogo").src = "<?php echo $domainhome.'content/theme/'.$themename.'/storage/img/'.$navbarlogoscroll; ?>";
				document.getElementById("secnavbr").style.backgroundColor = "<?php echo $primarycolor; ?>";
				document.getElementById("secnavbr").style.backgroundImage = "<?php echo $menugradientcolor; ?>";
				document.getElementById("navbar").getElementsByClassName("dropdown-menu")[0].style.backgroundColor = "<?php echo $primarycolor; ?>";
			} else {
				document.getElementById("navbar").style.padding = ".8rem 1rem";
				document.getElementById("mlogo").style.maxHeight = "58px";
				document.getElementById("mlogo").src = "<?php echo $domainhome.'content/theme/'.$themename.'/storage/img/'.$navbarlogo; ?>";
				document.getElementById("secnavbr").style.backgroundColor = "<?php echo $forthcolor; ?>";
				document.getElementById("secnavbr").style.backgroundImage = "none";
				document.getElementById("navbar").getElementsByClassName("dropdown-menu")[0].style.backgroundColor = "<?php echo $forthcolor; ?>";
			}
		}
	</script>
	<script src="<?php echo $domainhome.'content/theme/'.$themename.'/assets/js/custom-script.js'; ?>"></script>
	<script><?php echo $customscript; ?></script>
	<?php
		if(!isset($_SESSION["ulevpos"])) {
			
		} elseif($_SESSION["ulevpos"]==1 || $_SESSION["ulevpos"]==3) {
			echo '<script>window.open("routes/dashboard","_self");</script>';
		}
	?>
</body>
</html>
<!-- Lludvick Novechskie PHP CMS Framework -->