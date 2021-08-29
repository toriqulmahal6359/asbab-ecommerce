<?php
require('top.inc.php');
	
	$categories_id = '';
	$name = '';
	$mrp = '';
	$price = '';
	$qty = '';
	$image = '';
	$short_desc = '';
	$description = '';
	$meta_title = '';
	$meta_desc = '';
	$meta_keyword = '';
	$best_seller = '';
	
	$msg = '';
	$img_required = 'required';
	
	if(isset($_GET['id']) && $_GET['id'] != ''){
		$img_required = '';
		$id = get_safe_value($con, $_GET['id']);
		$query = "SELECT * FROM product WHERE id='$id'";
		$res = mysqli_query($con, $query);
		$check = mysqli_num_rows($res);
		if($check > 0){
			$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
			$categories_id = $row['categories_id'];
			$name = $row['name'];
			$mrp = $row['mrp'];
			$price = $row['price'];
			$qty = $row['qty'];
			$short_desc = $row['short_desc'];
			$description = $row['description'];
			$meta_title = $row['meta_title'];
			$meta_desc = $row['meta_desc'];
			$meta_keyword = $row['meta_keyword'];
			$best_seller = $row['best_seller'];
		}else{
			redirect('product.php');
			die();
		}
		
	}
	
	if(isset($_POST['add_product'])){
		$categories_id = get_safe_value($con, $_POST['categories_id']);
		$name = get_safe_value($con, $_POST['name']);
		$mrp = get_safe_value($con, $_POST['mrp']);
		$price = get_safe_value($con, $_POST['price']);
		$qty = get_safe_value($con, $_POST['qty']);
		$short_desc = get_safe_value($con, $_POST['short_desc']);
		$description = get_safe_value($con, $_POST['description']);
		$meta_title = get_safe_value($con, $_POST['meta_title']);
		$meta_desc = get_safe_value($con, $_POST['meta_desc']);
		$meta_keyword = get_safe_value($con, $_POST['meta_keyword']);
		$best_seller = get_safe_value($con, $_POST['best_seller']);
			$sql = "SELECT * FROM product WHERE name='$name'";
			$res = mysqli_query($con, $sql);
			$check = mysqli_num_rows($res);
			if($check > 0){
				if(isset($_GET['id']) && $_GET['id'] != ''){
					$getData = mysqli_fetch_assoc($res);
					if($id==$getData['id']){
						
					}else{
						$msg = "Product Already Exists";
					}
				}else{
					$msg = "Product Already Exists";
				}
			}
			
			if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpeg' && $_FILES['image']['type']!='image/jpg'){
				$msg = "Please select valid image format";
			}
			if($msg==''){
				if(isset($_GET['id']) && $_GET['id'] != ''){
					if($_FILES['image']['name']!=''){
						$image = rand(111111111, 999999999).'_'.$_FILES['image']['name'];
						move_uploaded_file($_FILES['image']['tmp_name'], SERVER_PRODUCT_IMAGE.$image);
						
						$update_product_query = "UPDATE product SET categories_id='$categories_id',name='$name',mrp='$mrp',price='$price',qty='$qty',image='$image',short_desc='$short_desc',description='$description',best_seller='$best_seller',meta_title='$meta_title',meta_desc ='$meta_desc',meta_keyword='$meta_keyword' WHERE id='$id'";
					}else{
						$update_product_query = "UPDATE product SET categories_id='$categories_id', name='$name', mrp='$mrp', price='$price',qty='$qty',short_desc='$short_desc',description='$description',best_seller='$best_seller',meta_title='$meta_title',meta_desc ='$meta_desc',meta_keyword='$meta_keyword' WHERE id='$id'";
					}
					mysqli_query($con, $update_product_query);
				}else{
					$image = rand(111111111, 999999999).'_'.$_FILES['image']['name'];
					move_uploaded_file($_FILES['image']['tmp_name'], SERVER_PRODUCT_IMAGE.$image);
					
					$product_query = "INSERT INTO product(categories_id,name,mrp,price,qty,image,short_desc,description,best_seller, meta_title, meta_desc, meta_keyword, status) VALUES('$categories_id','$name','$mrp','$price','$qty','$image','$short_desc','$description','$best_seller','$meta_title','$meta_desc','$meta_keyword','1')";
					mysqli_query($con, $product_query);
				}
			
				redirect('product.php');
				die();
			}
		}
?>
<div class="content">
	<div class="animated fadeIn">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<strong>Category</strong>
						<small> Form</small>
					</div>
					<form method="post" enctype="multipart/form-data">
						<div class="card-body card-block">
							<div class="form-group">
								<label for="company" class=" form-control-label">Categories</label>
								<select class="form-control" name='categories_id'>
									<option>Select Categories</option>
									<?php
										$category_query = "SELECT * FROM categories ORDER BY categories ASC";
										$category_res = mysqli_query($con, $category_query);
											while($row_category = mysqli_fetch_array($category_res, MYSQLI_ASSOC)){
												if($row_category['id'] == $categories_id){
													echo '<option value="'.$row_category['id'].'" selected>'.$row_category['categories'].'</option>';
												}else{
													echo '<option value="'.$row_category['id'].'">'.$row_category['categories'].'</option>';
												}
													
									?>
									<?php
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label for="company" class=" form-control-label">Name</label>
								<input type="text" name="name" class="form-control" placeholder="Enter Product name" value="<?php echo $name; ?>" required>
							</div>
							<div class="form-group">
								<label for="company" class=" form-control-label">MRP</label>
								<input type="text" name="mrp" class="form-control" value="<?php echo $mrp; ?>" required>
							</div>
							<div class="form-group">
								<label for="company" class=" form-control-label">Price</label>
								<input type="text" name="price" class="form-control" value="<?php echo $price; ?>" required>
							</div>
							<div class="form-group">
								<label for="company" class=" form-control-label">qty</label>
								<input type="text" name="qty" class="form-control" value="<?php echo $qty; ?>" required>
							</div>
							<div class="form-group">
								<label for="company" class=" form-control-label">Image</label>
								<input type="file" name="image" class="form-control" <?php echo $img_required; ?>>
								<div class="field_error"><?php echo $msg; ?></div>
							</div>
							<div class="form-group">
								<label for="company" class=" form-control-label">Short Description</label>
								<textarea name="short_desc" class="form-control" placeholder="Enter Product short description...." required><?php echo $short_desc; ?></textarea>
							</div>
							<div class="form-group">
								<label for="company" class=" form-control-label">Description</label>
								<textarea name="description" class="form-control" placeholder="Enter Product description...." required><?php echo $description; ?></textarea>
							</div>
							<div class="form-group">
								<label for="company" class=" form-control-label">Meta Title</label>
								<textarea name="meta_title" class="form-control" placeholder="Enter Product meta title...." ><?php echo $meta_title; ?></textarea>
							</div>
							<div class="form-group">
								<label for="company" class=" form-control-label">Meta Description</label>
								<textarea name="meta_desc" class="form-control" placeholder="Enter Product meta description...." ><?php echo $meta_desc; ?></textarea>
							</div>
							<div class="form-group">
								<label for="company" class=" form-control-label">Meta Keyword</label>
								<textarea name="meta_keyword" class="form-control" placeholder="Enter Product meta keyword...." ><?php echo $meta_keyword; ?></textarea>
							</div>
							<div class="form-group">
								<label for="best_seller" class=" form-control-label">Best Seller</label>
								<?php 
									if($best_seller == 0){
										echo '<input type="checkbox" name="best_seller" value="1" id="best_seller"/>';
									}else{
										echo '<input type="checkbox" name="best_seller" value="0" id="best_seller" checked/>';
									}
								?>
								
							</div>
							<button id="payment-button" type="submit" name="add_product" class="btn btn-lg btn-info btn-block">
								<span id="payment-button-amount">Submit</span>
							</button>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>


<?php
	require('footer.inc.php');
?>