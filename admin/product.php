<?php
	require('top.inc.php');
	
	if(isset($_GET['type']) && $_GET['type'] != ''){
		$type = get_safe_value($con, $_GET['type']);
		if($type=='status'){
			$operation = get_safe_value($con, $_GET['operation']);
			$id = get_safe_value($con, $_GET['id']);
				if($operation=='active'){
					$status = '1';
				}else{
					$status = '0';
				}
			$update_status_sql = "UPDATE product SET status='$status' WHERE id='$id'";
			mysqli_query($con, $update_status_sql);
		}
		
		if($type=='delete'){
			$id = get_safe_value($con, $_GET['id']);
			$delete_sql = "DELETE FROM product WHERE id='$id'";
			mysqli_query($con, $delete_sql);
		}
		
	}
	
	$sql = "SELECT product.* , categories.categories FROM product,categories WHERE product.categories_id = categories.id ORDER BY product.id DESC";
	$result = mysqli_query($con, $sql);
	
?>
<div class="content pb-0">
	<!-- Orders -->
	<div class="orders">
		<div class="row">
			<div class="col-xl-12">
				<div class="card">
					<div class="card-body">
						<h4 class="box-title">Product </h4>
						<h4 class="box-link"><a href="manage_product.php">Add Product</a></h4>
					</div>
					<div class="card-body--">
						<div class="table-stats order-table ov-h">
							<table class="table ">
								<thead>
									<tr>
										<th class="serial">#</th>
										<th>ID</th>
										<th>Image</th>
										<th>Categories</th>
										<th>Name</th>
										<th>MRP</th>
										<th>Price</th>
										<th>Qty</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$i = 1;
									while($row=mysqli_fetch_assoc($result)){ ?>
									<tr>
										<td class="serial"><?php echo $i; ?>.</td>
										<td><?php echo $row['id']; ?>
										</td>
										<td>
											<a target="_blank" href="<?php echo SITE_PRODUCT_IMAGE.$row['image']; ?>"><img src="<?php echo SITE_PRODUCT_IMAGE.$row['image']; ?>" alt="<?php echo $row['name']?>" width="1000px"></a>
										</td>
										<td><?php echo $row['categories']; ?></td>
										<td><?php echo $row['name']; ?></td>
										<td><?php echo $row['mrp']; ?></td>
										<td><?php echo $row['price']; ?></td>
										<td><?php echo $row['qty']; ?></td>
										<td>
											<?php 
												if($row['status']==1){
													echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=".$row['id']."'>Active</a></span>&nbsp&nbsp";
												}else{
													echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=".$row['id']."'>Deactive</a></span>&nbsp&nbsp";
												}
												echo "<span class='badge badge-edit'><a href='manage_product.php?type=edit&id=".$row['id']."'>Edit</a></span>&nbsp&nbsp";
												echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['id']."'>Delete</a></span>";
											?>
										</td>
									</tr>
									<?php 
										$i++; 
										} 
									?>
								</tbody>
							</table>
						</div>
						<!-- /.table-stats -->
					</div>
				</div>
				<!-- /.card -->
			</div>
			<!-- /.col-lg-8 -->
		</div>
	</div>
	<!-- /.orders -->
</div>
<?php
	require('footer.inc.php');
?>