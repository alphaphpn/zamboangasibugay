<?php
	include_once "../../../content/template-part/".$themename."/dashboard-navbar.php";
	include_once "../../../inc/core.php";
	include_once "../../../inc/srvr.php";
	$cnn = new PDO("mysql:host={$host};dbname={$db}", $unameroot, $pw);	
?>
<script>
	window.addEventListener('load', function() {
		document.querySelector('#itemfilenem').addEventListener('change', function() {
			if (this.files && this.files[0]) {
				var img = document.querySelector('#itmvwimgfl');
				img.onload = () => {
					URL.revokeObjectURL(img.src);  // no longer needed, free memory
				}
				img.src = URL.createObjectURL(this.files[0]); // set src to blob url

				var img2 = document.querySelector('#itmvwimgfl2');
				img2.onload = () => {
					URL.revokeObjectURL(img2.src);  // no longer needed, free memory
				}
				img2.src = URL.createObjectURL(this.files[0]); // set src to blob url
			}
		});
	});
</script>
<main id="dash-itemprod" class="page-content">
	<div class="container-fluid bg-light-opacity">
		<div class="w360center">
			<form method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
				<div class="form-group text-center">
					<div class="input-group my-3">
						<input type="file" id="itemfilenem" name="itemfilenem" class="form-control" placeholder="Upload File" accept="image/*">
					</div>
					<img id="itmvwimgfl" src="../../../storage/img/no-image.jpg" class="img-thumbnail" data-toggle="modal" data-target="#ymModalItemPreview">
				</div>

				<!-- div class="input-group mb-3 input-group-sm">
					<div class="input-group-prepend">
						<span class="input-group-text">Item Code</span>
					</div>
					<input id="barcode" type="text" class="form-control" placeholder="Item BarCode" name="barcode" readonly disabled autofocus>
					<div class="valid-feedback">Valid.</div>
					<div class="invalid-feedback">Please fill out this field.</div>
				</div -->

				<div class="input-group mb-3 input-group-sm">
					<div class="input-group-prepend">
						<span class="input-group-text">Item</span>
					</div>
					<input id="nameitem" type="text" class="form-control" placeholder="Name of the Item" name="nameitem" required autofocus>
					<div class="valid-feedback">Valid.</div>
					<div class="invalid-feedback">Please fill out this field.</div>
				</div>

				<!-- div class="input-group mb-3 input-group-sm">
					<div class="input-group-prepend">
						<span class="input-group-text">Item Description</span>
					</div>
					<textarea id="description" class="form-control" rows="5" placeholder="Item Description" name="description" autofocus></textarea>
				</div -->

				<div class="input-group mb-3 input-group-sm">
					<div class="input-group-prepend">
						<span class="input-group-text">Unit</span>
					</div>
					<input id="unit" type="text" class="form-control" placeholder="Unit" name="unit" list="unitList" required autofocus>
					<div class="valid-feedback">Valid.</div>
					<div class="invalid-feedback">Please fill out this field.</div>
					<datalist id="unitList">
					<?php
						$stmtunit = $cnn->prepare("SELECT * FROM tbl_item GROUP BY unit ORDER BY unit ASC");
						$stmtunit->execute();
						$resultunit = $stmtunit->setFetchMode(PDO::FETCH_ASSOC);
						foreach ($stmtunit as $rowunit) {
							echo "<option value='".$rowunit['unit']."'>";
						}
					?>
					</datalist>
				</div>

				<div class="input-group mb-3 input-group-sm">
					<div class="input-group-prepend">
						<span class="input-group-text">Category</span>
					</div>
					<input id="category" type="text" class="form-control" placeholder="Category" name="category" list="categoryList" required autofocus>
					<div class="valid-feedback">Valid.</div>
					<div class="invalid-feedback">Please fill out this field.</div>
					<datalist id="categoryList">
					<?php
						$stmtcategory = $cnn->prepare("SELECT * FROM tbl_item GROUP BY category ORDER BY category ASC");
						$stmtcategory->execute();
						$resultcategory = $stmtcategory->setFetchMode(PDO::FETCH_ASSOC);
						foreach ($stmtcategory as $rowcategory) {
							echo "<option value='".$rowcategory['category']."'>";
						}
					?>
					</datalist>
				</div>

				<div class="input-group mb-3 input-group-sm">
					<div class="input-group-prepend">
						<span class="input-group-text">Size</span>
					</div>
					<input id="size" type="text" class="form-control" placeholder="Size" name="size" list="sizeList" autofocus>
					<datalist id="sizeList">
					<?php
						$stmtsize = $cnn->prepare("SELECT * FROM tbl_item GROUP BY size ORDER BY size ASC");
						$stmtsize->execute();
						$resultsize = $stmtsize->setFetchMode(PDO::FETCH_ASSOC);
						foreach ($stmtsize as $rowsize) {
							echo "<option value='".$rowsize['size']."'>";
						}
					?>
					</datalist>
				</div>

				<div class="input-group mb-3 input-group-sm">
					<div class="input-group-prepend">
						<span class="input-group-text">Color</span>
					</div>
					<input id="color" type="text" class="form-control" placeholder="Color" name="color" list="colorList" autofocus>
					<datalist id="colorList">
					<?php
						$stmtcolor = $cnn->prepare("SELECT * FROM tbl_item GROUP BY color ORDER BY color ASC");
						$stmtcolor->execute();
						$resultcolor = $stmtcolor->setFetchMode(PDO::FETCH_ASSOC);
						foreach ($stmtcolor as $rowcolor) {
							echo "<option value='".$rowcolor['color']."'>";
						}
					?>
					</datalist>
				</div>

				<div class="input-group mb-3 input-group-sm d-none">
					<div class="input-group-prepend">
						<span class="input-group-text">Quality</span>
					</div>
					<input id="quality" type="text" class="form-control" placeholder="Quality" name="quality" list="qualityList" autofocus>
					<datalist id="qualityList">
					<?php
						$stmtquality = $cnn->prepare("SELECT * FROM tbl_item GROUP BY quality ORDER BY quality ASC");
						$stmtquality->execute();
						$resultquality = $stmtquality->setFetchMode(PDO::FETCH_ASSOC);
						foreach ($stmtquality as $rowquality) {
							echo "<option value='".$rowquality['quality']."'>";
						}
					?>
					</datalist>
				</div>

				<div class="input-group mb-3 input-group-sm">
					<div class="input-group-prepend">
						<span class="input-group-text">Selling Price</span>
					</div>
					<input id="sell_price" type="number" class="form-control" placeholder="Selling Price" value="0.00" name="sell_price" min="0.01" step=".01" required autofocus>
					<div class="valid-feedback">Valid.</div>
					<div class="invalid-feedback">Please fill out this field.</div>
				</div>

				<!-- div class="input-group mb-3 input-group-sm">
					<div class="input-group-prepend">
						<span class="input-group-text">Sale Price</span>
					</div>
					<input id="sale_price" type="number" class="form-control" placeholder="Sale Price" name="sale_price" value="0.00" step=".01">
				</div -->

				<!-- div class="input-group mb-3 input-group-sm">
					<div class="input-group-prepend">
						<span class="input-group-text">Supplier Price</span>
					</div>
					<input id="supplier_price" type="number" class="form-control" placeholder="Supplier Price" name="supplier_price" value="0.00" step=".01">
				</div -->

				<div class="input-group mb-3 input-group-sm">
					<div class="input-group-prepend">
						<span class="input-group-text">Stock Available</span>
					</div>
					<input id="stock_available" type="number" class="form-control" placeholder="Fieldtxt" name="stock_available" value="0" step="1" onkeydown="if(event.key==='.'){event.preventDefault();}" oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');">
				</div>

				<div class="row justify-content-end">
					<input id="btnSaveItem" type="submit" name="btnSave" value="Save" class="btn btn-info btn-sm m-2" onclick="return VerifyUploadSizeIsOK();">
					<a href="../../../routes/item" class="btn btn-danger btn-sm m-2">Close</a>
				</div>
			</form>
			<?php
				try {
					if (isset($_POST['btnSave'])) {
						if (empty(trim($_POST['nameitem']))) {
							$err_msg = "Please fill-up the form properly.";
						} else {
							// search for duplicate
							$stblname = "tbl_item";
							$dupli_txt = "name";
							// $qry_dupli = "SELECT * FROM {$stblname} WHERE {$dupli_txt}=:itemname OR barcode=:barcode LIMIT 1";
							$qry_dupli = "SELECT * FROM {$stblname} WHERE {$dupli_txt}=:itemname AND theme_name=:themename LIMIT 1";
							$stmt_dupli = $cnn->prepare($qry_dupli);
							// $barcode = trim($_POST['barcode']);
							$itemname = trim($_POST['nameitem']);
							$stmt_dupli->bindParam(':itemname', $itemname);
							$stmt_dupli->bindParam(':themename', $themename);
							// $stmt_dupli->bindParam(':barcode', $barcode);
							$stmt_dupli->execute();
							$rw_counts = $stmt_dupli->rowCount();

							if ($rw_counts > 0) {
								$err_msg = "Record already exist.";
								echo "<script>alert('".$err_msg."');</script>";
							} else {
								// $qry_insert = "INSERT INTO {$stblname} SET barcode=:barcode, name=:nameitem, description=:description, category=:category, unit=:unit, sell_price=:sell_price, sale_price=:sale_price, supplier_price=:supplier_price, stock_available=:stock_available, deletedx=0";
								$qry_insert = "INSERT INTO {$stblname} SET name=:nameitem, category=:category, unit=:unit, sell_price=:sell_price, stock_available=:stock_available, extnem=:extnem, size=:gsize, deletedx=0, theme_name=:themename";
								$stmt_insert = $cnn->prepare($qry_insert);

								// $barcode = trim($_POST['barcode']);
								$nameitem = trim($_POST['nameitem']);
								// $description = trim($_POST['description']);
								$category = trim($_POST['category']);
								$unit = trim($_POST['unit']);
								$size = trim($_POST['size']);
								$sell_price = trim($_POST['sell_price']);
								// $sale_price = trim($_POST['sale_price']);
								// $supplier_price = trim($_POST['supplier_price']);
								$stock_available = trim($_POST['stock_available']);

								// Get Filename Extension
								$filename = $_FILES['itemfilenem']['name'];
								$ext = pathinfo($filename, PATHINFO_EXTENSION);

								// $stmt_insert->bindParam(':barcode', $barcode);
								$stmt_insert->bindParam(':nameitem', $nameitem);
								// $stmt_insert->bindParam(':description', $description);
								$stmt_insert->bindParam(':category', $category);
								$stmt_insert->bindParam(':unit', $unit);
								$stmt_insert->bindParam(':gsize', $size);
								$stmt_insert->bindParam(':sell_price', $sell_price);
								// $stmt_insert->bindParam(':sale_price', $sale_price);
								// $stmt_insert->bindParam(':supplier_price', $supplier_price);
								$stmt_insert->bindParam(':stock_available', $stock_available);
								$stmt_insert->bindParam(':extnem', $ext);
								$stmt_insert->bindParam(':themename', $themename);

								$stmt_insert->execute();

								$err_msg = "Save successfully.";
								echo "<script>alert('".$err_msg."');</script>";

								// Get last record ID
								$qry_lastid = "SELECT item_id FROM tbl_item ORDER BY item_id DESC";
								$stmt_lastid = $cnn->prepare($qry_lastid);
								$stmt_lastid->execute();
								$row_lastid = $stmt_lastid->fetch(PDO::FETCH_ASSOC);
								$thelastid = $row_lastid['item_id'];
								$imgitemnem = trim('ITEM'.$thelastid);

								$target_dir = "../../../content/theme/".$themename."/storage/img/item/".$imgitemnem.".".$ext;
								$target_file = $target_dir . basename($_FILES["itemfilenem"]["name"]);
								$uploadOk = 1;
								$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

								// Check if image file is a actual image or fake image
								$check = getimagesize($_FILES["itemfilenem"]["tmp_name"]);
								if($check !== false) {
									echo "File is an image - " . $check["mime"] . ".";
									$uploadOk = 1;
								} else {
									$err_msg = "File is not an image.";
									echo "<script>alert('".$err_msg."');</script>";
									$uploadOk = 0;
								}

								// Check if file already exists
								if (file_exists($target_file)) {
									$err_msg = "Sorry, file already exists.";
									echo "<script>alert('".$err_msg."');</script>";
									$uploadOk = 0;
								}

								// Check file size
								// if ($_FILES["itemfilenem"]["size"] > 500000) {
								// 	$err_msg = "Sorry, your file is too large.";
								// 	echo "<script>alert('".$err_msg."');</script>";
								// 	$uploadOk = 0;
								// }

								// Allow certain file formats
								if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
									$err_msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
									echo "<script>alert('".$err_msg."');</script>";
									$uploadOk = 0;
								}

								// Check if $uploadOk is set to 0 by an error
								if ($uploadOk == 0) {
									$err_msg = "Sorry, your file was not uploaded.";
									echo "<script>alert('".$err_msg."');</script>";
								} else {
									if (move_uploaded_file($_FILES["itemfilenem"]["tmp_name"], $target_dir)) {
										$err_msg = "The file ". htmlspecialchars( basename( $_FILES["itemfilenem"]["name"])). " has been uploaded.";
										echo "<script>alert('".$err_msg."');</script>";
									} else {
										$err_msg = "Sorry, there was an error uploading your file.";
										echo "<script>alert('".$err_msg."');</script>";
									}
								}
							}
						}
					}
				} catch (PDOException $error) {
					$err_msg = $error->getMessage();
					echo "<p>Error: {$err_msg}</p>";
					die;
				}
			?>
		</div>
	</div>
</main>

<div class="modal" id="ymModalItemPreview">
	<div class="modal-dialog">
		<div class="modal-content">
			<button type="button" class="close text-right mr-1" data-dismiss="modal">&times;</button>
			<div class="modal-body">
				<img id="itmvwimgfl2" src="../../../storage/img/no-image.jpg">
			</div>
		</div>
	</div>
</div>