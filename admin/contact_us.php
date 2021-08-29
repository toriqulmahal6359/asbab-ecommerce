<?php
	require('top.inc.php');
	
	if(isset($_GET['type']) && $_GET['type'] != ''){
		$type = get_safe_value($con, $_GET['type']);
		
		if($type=='delete'){
			$id = get_safe_value($con, $_GET['id']);
			$delete_sql = "DELETE FROM contact_us WHERE id='$id'";
			mysqli_query($con, $delete_sql);
		}
		
	}
	$sql = "SELECT * FROM contact_us ORDER BY id DESC";
	$result = mysqli_query($con, $sql);
	
?>
<div class="content pb-0">
	<!-- Orders -->
	<div class="orders">
		<div class="row">
			<div class="col-xl-12">
				<div class="card">
					<div class="card-body">
						<h4 class="box-title">Contact Us </h4>
					</div>
					<div class="card-body--">
						<div class="table-stats order-table ov-h">
							<table class="table ">
								<thead>
									<tr>
										<th class="serial">#</th>
										<th>ID</th>
										<th>Name</th>
										<th>Email</th>
										<th>Mobile</th>
										<th>Comment</th>
										<th>Date</th>
										<th>Action</th>
									</tr>
										
								</thead>
								<tbody>
									<?php 
									$i = 1;
									while($row=mysqli_fetch_assoc($result)){ ?>
									<tr>
										<td class="serial"><?php echo $i; ?>.</td>
										<td><?php echo $row['id']; ?></td>
										<td><?php echo $row['name']; ?></td>
										<td><?php echo strtolower($row['email']); ?></td>
										<td><?php echo $row['mobile']; ?></td>
										<td><?php echo $row['message']; ?></td>
										<td><?php
											$dateStr = strtotime($row['added_on']); 
											echo date('d-m-Y H:i:s', $dateStr); ?></td>
										<td>
											<?php 
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