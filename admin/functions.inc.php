<?php

	function pr($arr)
	{
		echo "<pre>";
		print_r($arr);
	}
	
	function prx($arr)
	{
		echo "<pre>";
		print_r($arr);
		die();
	}
	
	function get_safe_value($con, $str){
		if($str!=''){
			$str = trim($str);
			return mysqli_real_escape_string($con, $str);
		}	
	}

	function get_product($con, $limit=0, $cat_id='', $product_id='', $search_str='', $sort_by='', $is_best_seller = ''){
		$product_query = "SELECT product.*, categories.categories FROM product,categories WHERE product.status = 1";
		if($cat_id != ''){
			$product_query .= " AND product.categories_id = '$cat_id'";
		}
		if($product_id != ''){
			$product_query .= " AND product.id = '$product_id'";
		}
		if($is_best_seller != ''){
			$product_query .= " AND product.best_seller = 1";
		}
		$product_query .= " AND product.categories_id = categories.id";
		if($search_str != ''){
			$product_query .= " AND (product.name LIKE '%$search_str%' OR product.description LIKE '%$search_str%')";
		}
		if($sort_by != ''){
			$product_query .= $sort_by;
		}else{
			$product_query .= " ORDER BY product.id DESC";
		}
		
		if($limit!=0){
			$product_query .= " LIMIT $limit";
		}
		$product_res = mysqli_query($con, $product_query);

		$data = array();
		while($row = mysqli_fetch_array($product_res, MYSQLI_ASSOC)){
			$data[] = $row;
		}

		return $data;
	}

	function wishlist_add($con, $user_id, $product_id){
		$added_on = date('Y-m-d h:i:s');
        $wishlist_query = "INSERT INTO wishlist(user_id, product_id, added_on) VALUES('$user_id', '$product_id', '$added_on')";
        mysqli_query($con, $wishlist_query);
	}
	
	function redirect($link){
		?>
		<script>window.location.href = '<?php echo $link; ?>'</script>
	<?php
		}
		
	?>
