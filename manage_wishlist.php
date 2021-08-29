<?php
include('admin/connection.inc.php');
include('admin/functions.inc.php');
include('add_to_cart.inc.php');

$pid = get_safe_value($con, $_POST['pid']);
$type = get_safe_value($con, $_POST['type']);

if(isset($_SESSION['USER_LOGIN'])){
    $uid = $_SESSION['USER_ID'];
    $query = "SELECT * FROM wishlist WHERE user_id = '$uid' AND product_id = '$pid'";
    $wishlist_res = mysqli_query($con, $query);

    if(mysqli_num_rows($wishlist_res) > 0){
        echo "Product Already added";
    }else{
        wishlist_add($con, $uid, $pid);
    }
    
}else{
    $_SESSION['WISHLIST_ID'] = $pid;
    echo "not_login";
}

?>