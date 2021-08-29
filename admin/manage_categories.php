<?php
require('top.inc.php');
	
	$category = '';
	$msg = '';
	
	if(isset($_GET['id']) && $_GET['id'] != ''){
		$id = get_safe_value($con, $_GET['id']);
		$query = "SELECT * FROM categories WHERE id='$id'";
		$res = mysqli_query($con, $query);
		$check = mysqli_num_rows($res);
		if($check > 0){
			$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
			$category = $row['categories'];
		}else{
			redirect('categories.php');
			die();
		}
		
	}
	
	if(isset($_POST['add_categories'])){
		$categories = get_safe_value($con, $_POST['categories']);
			$sql = "SELECT * FROM categories WHERE categories='$categories'";
			$res = mysqli_query($con, $sql);
			$check = mysqli_num_rows($res);
			if($check > 0){
				if(isset($_GET['id']) && $_GET['id'] != ''){
					$getData = mysqli_fetch_assoc($res);
					if($id==$getData['id']){
						
					}else{
						$msg = "Category Already Exists";
					}
				}else{
					$msg = "Category Already Exists";
				}
			}
			if($msg==''){
				if(isset($_GET['id']) && $_GET['id'] != ''){
					$update_category_query = "UPDATE categories SET categories='$categories' WHERE id='$id'";
					mysqli_query($con, $update_category_query);
				}else{
					$category_query = "INSERT INTO categories(categories, status) VALUES('$categories', '1')";
					mysqli_query($con, $category_query);
				}
			
				redirect('categories.php');
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
					<form method="post">
						<div class="card-body card-block">
							<div class="form-group">
								<label for="company" class=" form-control-label">Categories</label>
								<input type="text" id="categories" name="categories" class="form-control" value="<?php echo $category; ?>" required>
								<div class="field_error"><?php echo $msg; ?></div> 
							</div>
							<button id="payment-button" type="submit" name="add_categories" class="btn btn-lg btn-info btn-block">
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