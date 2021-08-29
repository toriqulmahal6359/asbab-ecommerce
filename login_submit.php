<?php
include('admin/connection.inc.php');
include('admin/functions.inc.php');


$email = get_safe_value($con, $_POST['email']);
$password = get_safe_value($con, $_POST['password']);

$login_query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$login_res = mysqli_query($con, $login_query);

$check_user = mysqli_num_rows($login_res);

if($check_user > 0){
    $row = mysqli_fetch_array($login_res, MYSQLI_ASSOC);
    $_SESSION['USER_LOGIN'] = 'yes';
    $_SESSION['USER_ID'] = $row['id'];
    $_SESSION['USER_NAME'] = $row['name'];
    $_SESSION['USER_EMAIL'] = $row['email'];

    if(isset($_SESSION['WISHLIST_ID']) && $_SESSION['WISHLIST_ID']!=''){
        wishlist_add($con, $_SESSION['USER_ID'], $_SESSION['WISHLIST_ID']);
    }
    
    echo "correct";
}else{
    echo "wrong";
}
?>