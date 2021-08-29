<?php
	require('top.inc.php');
	
	$order_id = get_safe_value($con, $_GET['id']);
	if(isset($_POST['update_order_status'])){
		$update_order_status = $_POST['update_order_status'];
		$update_order_status_query = "UPDATE orders SET order_status='$update_order_status' WHERE id='$order_id'";
		mysqli_query($con, $update_order_status_query);
	}
	
?>
<div class="content pb-0">
	<!-- Orders -->
	<div class="orders">
		<div class="row">
			<div class="col-xl-12">
				<div class="card">
					<div class="card-body">
						<h4 class="box-title">Order Master </h4>
					</div>
					<div class="card-body--">
						<div class="table-stats order-table ov-h">
							 <table class="table">
								<thead>
									<tr>
										<th class="product-name"><span class="nobr">Product Image</span></th>
										<th class="product-price"><span class="nobr"> Product Name </span></th>
										<th class="product-stock-stauts"><span class="nobr"> Quantity </span></th>
										<th class="product-stock-stauts"><span class="nobr"> Price </span></th>
										<th class="product-stock-stauts"><span class="nobr"> Current Address </span></th>
										<th class="product-stock-stauts"><span class="nobr"> Order Status </span></th>
										<th class="product-stock-stauts"><span class="nobr"> Total Price </span></th>
									</tr>
								</thead>
								<tbody>
									<?php
										$my_order_query = "SELECT DISTINCT (order_details.id), order_details.*, product.image, product.name, orders.street_address, orders.state, orders.city, orders.zip_code FROM order_details, product, orders WHERE order_details.order_id = '$order_id' AND order_details.product_id = product.id";
										$my_order_res = mysqli_query($con, $my_order_query);
										
										$total_price = 0;
										while($row = mysqli_fetch_array($my_order_res, MYSQLI_ASSOC)){
											$total_price = $total_price + ($row['qty']*$row['price']);
									?>
									<tr>
										<td class="product-name"><img src="<?php echo SITE_PRODUCT_IMAGE.$row['image']; ?>" alt="<?php echo $row['name']; ?>" width="100px"></td>
										<td class="product-name"><?php echo $row['name']; ?></td>
										<td class="product-name"><?php echo $row['qty']; ?></td>
										<td class="product-name"><?php echo $row['price']; ?></td>
										<td class="product-name">
											<?php echo $row['street_address']; ?>,<br>
											<?php echo $row['state'] ?>, <?php echo $row['city'] ?>, <?php echo $row['zip_code'];?>
										</td>
										<td>
											<?php
												$order_status_query = "SELECT order_status.name FROM order_status, orders WHERE order_status.id=orders.order_status AND orders.id='$order_id'";
												$order_status_res = mysqli_query($con, $order_status_query);
												$order_status_arr = mysqli_fetch_array($order_status_res, MYSQLI_ASSOC);
												echo $order_status_arr['name'];
											?>
										</td>
										<td class="product-name"><?php echo $row['qty']*$row['price']; ?></td>
									</tr>
								 <?php } ?>
										<tr>
											<td>
											<form method="POST">
												<select class="form-control" name="update_order_status">
													<option>Select Status</option>
													<?php
														$orders_id = mysqli_insert_id($con);
														$sql = "SELECT * FROM order_status";
														$res = mysqli_query($con, $sql);
														while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
															if($row['id']==$orders_id){
																echo "<option value=".$row['id']." selected>".$row['name']."</option>";
															}else{
																echo "<option value=".$row['id'].">".$row['name']."</option>";
															}
														}
													?>
												</select>
												<td><input type="submit" class="form-control"/></td>
											</form>
											</td>
											<td colspan="3"></td>
											<td class="product-name"><strong>Total Price :</strong></td>
											<td class="product-name"><strong><?php echo $total_price; ?></strong></td>
										</tr>
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