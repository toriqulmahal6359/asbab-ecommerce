<?php
include('admin/connection.inc.php');
include('admin/functions.inc.php');
include('add_to_cart.inc.php');

$pid = get_safe_value($con, $_POST['pid']);
$qty = get_safe_value($con, $_POST['qty']);
$type = get_safe_value($con, $_POST['type']);

$obj = new add_to_cart();

if($type == 'add'){
    $obj->add_product($pid, $qty);
}

if($type == 'update'){
    $obj->update_product($pid, $qty);
}

if($type == 'remove'){
    $obj->remove_product($pid);
}

echo $obj->totalCart();

?>