<?php
include('admin/connection.inc.php');
include('admin/functions.inc.php');


$type = get_safe_value($con, $_POST['type']);

if($type == 'email'){
    $email = get_safe_value($con, $_POST['email']);

    $check_email = "SELECT * FROM users WHERE email = '$email'";
    $check_email_res = mysqli_query($con, $check_email);
    $chck_mail = mysqli_num_rows($check_email_res);
    if($chck_mail > 0){
        echo 'email_exists';
        die();
    }

    $otp = rand(11111, 99999);
    $_SESSION['EMAIL_OTP'] = $otp; 
    $html = "$otp is your current OTP";

    include('smtp/PHPMailerAutoload.php');
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->SMTPSecure = "tls";
    $mail->SMTPAuth = true;
    $mail->Username = "toriqulmahal6359@gmail.com";
    $mail->Password = "3bc2tMaF";
    $mail->setFrom('toriqulmahal6359@gmail.com', 'Toriqul Mahal', true);
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = "Your OTP Password From Asbab";
    $mail->Body = $html;
    $mail->SMTPOptions = array('ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => false
    ));
    if($mail->send()){
        echo 'done';
    }else{
        echo 'error_email';
    }
}

if($type == 'mobile'){
    $mobile = get_safe_value($con, $_POST['mobile']);

    $check_mobile = "SELECT * FROM users WHERE mobile = '$mobile'";
    $check_mobile_res = mysqli_query($con, $check_mobile);
    $chck_phone = mysqli_num_rows($check_mobile_res);
    if($chck_phone > 0){
        echo 'mobile_exists';
        die();
    }

    $mobile_otp = rand(1111, 9999);
    $_SESSION['MOBILE_OTP'] = $mobile_otp; 
    $html = "$mobile_otp is your current OTP";
    if(isset($mobile)){
        echo 'done';
    }else{
        echo 'mobile_error';
    }
    
}

?>