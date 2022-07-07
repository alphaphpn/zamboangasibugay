<?php
	if(empty($_SESSION["usercode"])) {
		$deuzerked = 0;
	} else {
		$deuzerked = $_SESSION['usercode'];
	}
	
	$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);
	$qry = "SELECT * FROM tbl_item WHERE theme_name=:themename AND deletedx=0 ORDER BY item_id DESC";
	$stmt = $cnn->prepare($qry);
	$stmt->bindParam(':themename', $themename);
	$stmt->execute();
	$num = $stmt->rowCount();
	$xno = 0;
?>
<script>
	function getIdOnClick(id) {
		var theitemiz = document.getElementById(id).getAttribute('data-item-id');
		var curnzy = document.getElementById(id).getAttribute('data-currency');
		var img = document.getElementById(id).getAttribute('data-value');
		var prodtitle = document.getElementById(id).getAttribute('data-item-name');
		var prodprice = document.getElementById(id).getAttribute('data-price');
		var prodsize = document.getElementById(id).getAttribute('data-size');
		var prodcolor = document.getElementById(id).getAttribute('data-color');
		var prodquality = document.getElementById(id).getAttribute('data-quality');
		var prodstock = document.getElementById(id).getAttribute('data-stock');
		var produnit = document.getElementById(id).getAttribute('data-unit');
		$("#itmvwimgfl3").attr("style","background-image: url('"+img+"');");
		$("#temidon").attr("data-iditem",theitemiz);
		$('#ghtitle').html(prodtitle);
		$('#ghprice').html(curnzy+prodprice);
		$('#ghsize').html(prodsize);
		$('#ghcolor').html(prodcolor);
		$('#ghquality').html(prodquality);
		$('#ghunit').html(prodstock+produnit+" available");
		$("#ghqty").attr("max",prodstock);
	}
</script>

	<div id="productitemz" class="<?php echo $contentwidth; ?>">
		<h2>Products</h2>
		<div class="pt-5 pb-5">
			<div class="card-deck align-items-center slick-products slideanim">
			<?php
				if ($num>0) {
					foreach ($stmt as $row) {
						$xno++;
						extract($row);
						$id4img = 'xditem'.$item_id;
			?>

				<div class="card border-0">
					<div class="card-header">
						<img id="<?php echo $id4img; ?>" class="card-img-top img-front-product" style="background-image: url('<?php echo $domainhome."content/theme/".$themename."/storage/img/item/ITEM".$item_id.".".$extnem; ?>');" data-item-id="<?php echo $item_id; ?>" data-unit="<?php echo $unit; ?>" data-currency="<?php echo $dcurrencyx; ?>" data-toggle="modal" data-target="#ymModalItemPreviewFront" data-item-name="<?php echo $name; ?>" data-price="<?php echo number_format($sell_price,2); ?>" data-size="<?php echo $size; ?>" data-color="<?php echo $color; ?>" data-quality="<?php echo $quality; ?>" data-stock="<?php echo $stock_available; ?>" onclick="getIdOnClick(this.id);" data-value="<?php echo $domainhome."content/theme/".$themename."/storage/img/item/ITEM".$item_id.".".$extnem; ?>">
					</div>
					<div class="card-body text-right p-1">
						<h5 class="card-title mb-0"><?php echo $name; ?></h5>
						<p class="card-text mb-0"><?php echo $dcurrencyx.' '.number_format($sell_price,2); ?></p>
						<div class="text-center"><a href="#" class="btn btn-link" onclick="document.getElementById('<?php echo $id4img; ?>').click();">See details</a></div>		
					</div>
					<div class="card-footer">
						<a href="#" class="btn btn-danger w-100" onclick="fnAddToCartz(<?php echo $item_id; ?>); return false;">Add to Cart</a>
					</div>
				</div>

			<?php
					}
				} else {
			?>

				<div class="card border-0">
					<div class="card-header">
						<img class="card-img-top img-front-product" style="background-image: url('<?php echo $domainhome; ?>storage/img/no-image.jpg');" alt="No Item" data-toggle="modal" data-target="#ymModalItemPreviewFront">
					</div>
					<div class="card-body text-right">
						<h4 class="card-title">No Item</h4>
					</div>
				</div>

			<?php
				}
			?>

			</div>
		</div>
	</div>
</div>

<div class="modal" id="ymModalItemPreviewFront">
	<div class="modal-dialog">
		<div class="modal-content">
			<button type="button" class="close text-right mr-1" data-dismiss="modal">&times;</button>
			<div class="modal-body">
				<img id="itmvwimgfl3">
				<div class="position-absolute">
					<div class="card">
						<div class="card-body text-right">
							<h5 id="ghtitle" class="card-title"></h5>
							<h4 id="ghprice" class="card-text"></h4>
							<p class="mb-0" id="ghsize"></p>
							<p class="mb-0" id="ghcolor"></p>
							<p class="mb-0 d-none" id="ghquality"></p>
							<div class="d-flex">
								<div class="input-group fit-product-qty">
									<input type="button" value="-" class="button-minus" data-field="quantity">
									<input id="ghqty" type="number" step="1" min="1" value="1" name="quantity" class="addminusentry text-center" onkeydown="if(event.key==='.'){event.preventDefault();}" oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');">
									<input type="button" value="+" class="button-plus" data-field="quantity">
								</div>
								<p id="ghunit"></p>
							</div>
							<a id="temidon" href="#" class="btn btn-danger w-100" onclick="fnPopToCart(this.id);" data-iditem>Add to Cart</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	function fnAddToCartz(itemid) {
		var dir = "<?php echo $domainhome; ?>";
		var userCode = "<?php echo $deuzerked; ?>";
		if (userCode==0) {
			console.log('No User');
			window.open(dir+'routes/login', '_self');
		} else {
			console.log(userCode);
			// Add to Cart
			window.open(dir+'content/view/productsitems/tocart.php?itemid='+itemid+'&uid='+userCode+'&gqty=1', '_self');
		}
	}

	function fnPopToCart(e) {
		var h = document.getElementById(e).getAttribute('data-iditem');
		var kuantity = document.getElementById("ghqty").value;
		var dirg = "<?php echo $domainhome; ?>";
		var userCodeg = "<?php echo $deuzerked; ?>";
		console.log(h);
		console.log(userCodeg);
		if (userCodeg==0) {
			console.log('No User');
			window.open(dirg+'routes/login', '_self');
		} else {
			console.log(userCodeg);
			// Add to Cart
			if ( kuantity==0 || kuantity=='' ) {
				window.open(dirg+'content/view/productsitems/tocart.php?itemid='+h+'&uid='+userCodeg+'&gqty=1', '_self');
			} else {
				window.open(dirg+'content/view/productsitems/tocart.php?itemid='+h+'&uid='+userCodeg+'&gqty='+kuantity, '_self');
			}
		}
	}
</script>