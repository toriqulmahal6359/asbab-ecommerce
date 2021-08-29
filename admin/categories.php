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
			$update_status_sql = "UPDATE categories SET status='$status' WHERE id='$id'";
			mysqli_query($con, $update_status_sql);
		}
		
		if($type=='delete'){
			$id = get_safe_value($con, $_GET['id']);
			$delete_sql = "DELETE FROM categories WHERE id='$id'";
			mysqli_query($con, $delete_sql);
		}
		
	}
	
	$sql = "SELECT * FROM categories ORDER BY categories ASC";
	$result = mysqli_query($con, $sql);
	
?>
<div class="content pb-0">
	<!-- Orders -->
	<div class="orders">
		<div class="row">
			<div class="col-xl-12">
				<div class="card">
					<div class="card-body">
						<h4 class="box-title">Categories </h4>
						<h4 class="box-link"><a href="manage_categories.php">Add Categories</a></h4>
					</div>
					<div class="card-body--">
						<div class="table-stats order-table ov-h">
							<table class="table ">
								<thead>
									<tr>
										<th class="serial">#</th>
										<th>ID</th>
										<th>categories ID</th>
										<th>Status</th>
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
										<td><?php echo $row['categories']; ?>
										</td>
										<td>
											<?php 
												if($row['status']==1){
													echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=".$row['id']."'>Active</a></span>&nbsp&nbsp";
												}else{
													echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=".$row['id']."'>Deactive</a></span>&nbsp&nbsp";
												}
												echo "<span class='badge badge-edit'><a href='manage_categories.php?type=edit&id=".$row['id']."'>Edit</a></span>&nbsp&nbsp";
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