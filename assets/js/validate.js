function email_send_otp(){
    var email = jQuery('#email').val();
    if(email != ''){
        jQuery('.email_send_otp').html('Please Wait....');
        jQuery('.email_send_otp').attr('disabled', true);
        jQuery('.email_send_otp');
        $.ajax({
            url: 'send_otp.php',
            type: 'post',
            data: 'email='+email+'&type=email',
            success: function(result){
                if(result == 'done'){
                    jQuery('#email_error').html('');
                    jQuery('#email').attr('disabled', true);
                    jQuery('#send_otp').show();
                    jQuery('.email_send_otp').attr('disabled', true).hide();
                }else if(result == 'email_exists'){
                    jQuery('.email_send_otp').html('Send OTP');
                    jQuery('.email_send_otp').attr('disabled', false);
                    jQuery('#email_error').html("Your Email have already been used");
                }else{
                    jQuery('.email_send_otp').html('Send OTP');
                    jQuery('.email_send_otp').attr('disabled', false);
                    jQuery('#email_error').html("Please Try Again Later");
                }
            }
        })
        
    }else{
        jQuery('#email_error').html("Please Enter Your Email First");
    }
}

function email_verify_otp(){
    var otp = jQuery('#sent_otp').val();
    jQuery('#email_error').html('');
    if(otp == ''){
        jQuery('#email_error').html('Please Enter OTP');
    }else{
        $.ajax({
            url: 'check_otp.php',
            type: 'post',
            data: 'email_otp='+otp+'&type=email',
            success: function(result){
                if(result == 'done'){
                    jQuery('#send_otp').hide();
                    jQuery('.send_otp_msg').html('Your Email has been verified');
                    jQuery('#is_email_verified').val('1');
                    if(jQuery('#is_mobile_verified').val() == 1){
                        jQuery('#register_btn').attr('disabled', false);
                    }
                }else{
                    jQuery('#email_error').html("Your OTP is incorrect");
                }
            }
        })
        
    }
}

function mobile_send_otp(){
    jQuery('#mobile_error').html('');
    var mobile = jQuery('#mobile').val();
    if(mobile != ''){
        jQuery('.mobile_send_otp').html('Please Wait...');
        jQuery('.mobile_send_otp').attr('disabled', true);
        jQuery('.mobile_send_otp');
        $.ajax({
            url: 'send_otp.php',
            type: 'post',
            data: 'mobile='+mobile+'&type=mobile',
            success: function(result){
                if(result == 'done'){
                    jQuery('#mobile').attr('disabled', true);
                    jQuery('.mobile_send_otp').attr('disabled', true).hide();
                    jQuery('#mobile_send_otp').show();
                }else if(result == 'mobile_exists'){
                    jQuery('.mobile_send_otp').html('Send OTP');
                    jQuery('.mobile_send_otp').attr('disabled', false);
                    jQuery('#mobile_error').html("Your Mobile has already been registered");
                }else{
                    jQuery('.mobile_send_otp').html('Send OTP');
                    jQuery('.mobile_send_otp').attr('disabled', false);
                    jQuery('#mobile_error').html("Please Try Again Later");
                }
            }
        })
    }else{
        jQuery('#mobile_error').html('Please Enter Mobile Number');
    }
    
}

function mobile_verify_otp(){
    jQuery('#mobile_error').html('');
    var mobile_otp = jQuery('#mobile_sent_otp').val();
    if(mobile_otp == ''){
        jQuery('#mobile_error').html('Please Enter OTP');
    }else{
        $.ajax({
            url: 'check_otp.php',
            type: 'post',
            data: 'mobile_otp='+mobile_otp+'&type=mobile',
            success: function(result){
                if(result == 'done'){
                    jQuery('#mobile_send_otp').hide();
                    jQuery('.send_otp_mobile_msg').html('Your Mobile Number has been verified');
                    jQuery('#is_mobile_verified').val('1');
                    if(jQuery('#is_email_verified').val() == 1){
                        jQuery('#register_btn').attr('disabled', false);
                    }
                }else{
                    jQuery('#mobile_error').html("Your OTP is incorrect");
                }
            }
        })
        
    }
    
}
