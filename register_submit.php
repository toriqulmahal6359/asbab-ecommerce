<?php
include('admin/connection.inc.php');
include('admin/functions.inc.php');

$name = get_safe_value($con, $_POST['name']);
$email = get_safe_value($con, $_POST['email']);
$password = get_safe_value($con, $_POST['password']);
$mobile = get_safe_value($con, $_POST['mobile']);

$check_email = "SELECT * FROM users WHERE email='$email'";
$check_email_res = mysqli_query($con, $check_email);
$check_mobile = "SELECT * FROM users WHERE mobile='$mobile'";
$check_mobile_res = mysqli_query($con, $check_mobile);

$chck_email = mysqli_num_rows($check_email_res);
$chck_mobile = mysqli_num_rows($check_mobile_res);

if($chck_email > 0){
    echo "email_exists";
}else if($chck_mobile > 0){
    echo "mobile_exists";
}else{
    $added_on = date('Y-m-d h:i:s');
    $register_query = "INSERT INTO users(name,email,password,mobile,status,added_on) VALUES('$name','$email','$password','$mobile',1,'$added_on')";
    mysqli_query($con, $register_query);
    echo "inserts";
}
?>