<?php
include('admin/connection.inc.php');
include('admin/functions.inc.php');


$type = get_safe_value($con, $_POST['type']);

if($type == 'email'){
    $otp = get_safe_value($con, $_POST['email_otp']);
    if($otp == $_SESSION['EMAIL_OTP']){
        echo 'done';
    }else{
        echo 'otp_error';
    }
}
if($type == 'mobile'){
    $mobile_otp = get_safe_value($con, $_POST['mobile_otp']);
    if($mobile_otp == $_SESSION['MOBILE_OTP']){
        echo 'done';
    }else{
        echo 'otp_error';
    }
}

?>