<?php

	include_once "../../inc/core.php";
	include_once "../../inc/webconfig/conf.php";
	$page_title = "Cart";
	include_once "../../content/theme/frontend-header.php";
?>
<script>
	$("#myHome").addClass("page-innerx");
</script>
<?php
	include_once "../../content/view/mcart/index.php";
	include_once "../../content/theme/frontend-footer.php";