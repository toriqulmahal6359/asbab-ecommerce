<?php
	require('top.inc.php');

	$sql = "SELECT * FROM users ORDER BY id DESC";
	$result = mysqli_query($con, $sql);
	
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
										<th class="product-thumbnail">Order ID</th>
										<th class="product-name"><span class="nobr">Order Date</span></th>
										<th class="product-price"><span class="nobr"> Address </span></th>
										<th class="product-stock-stauts"><span class="nobr"> Payment Type </span></th>
										<th class="product-stock-stauts"><span class="nobr"> Payment Status </span></th>
										<th class="product-stock-stauts"><span class="nobr"> Order Status </span></th>
										<th class="product-stock-stauts"><span class="nobr"> Order Details </span></th>
									</tr>
								</thead>
								<tbody>
									<?php
										$my_order_query = "SELECT orders.*, order_status.name AS order_status FROM orders, order_status WHERE orders.order_status = order_status.id";
										$my_order_res = mysqli_query($con, $my_order_query);

										while($row = mysqli_fetch_array($my_order_res, MYSQLI_ASSOC)){
									?>
									<tr>
										<td class="product-add-to-cart"><?php echo $row['id']; ?></td>
										<td class="product-name">
											<?php 
												$dateStr = strtotime($row['added_on']); 
												echo date('d-m-Y h:i:s', $dateStr);
											?>
										</td>
										<td class="product-name">
											<?php echo $row['street_address']; ?>,<br>
											<?php echo $row['state']; ?>,
											<?php echo $row['city']; ?>,
											<?php echo $row['zip_code']; ?>
										</td>
										<td class="product-name"><?php echo $row['payment_type']; ?></td>
										<td class="product-name"><?php echo $row['payment_status']; ?></td>
										<td class="product-name"><?php echo $row['order_status']; ?></td>
										<td class="product-name"><a href="order_master_details.php?id=<?php echo $row['id']; ?>" class="badge badge-complete">Click For Details</a></td>
									</tr>
								 <?php } ?>
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