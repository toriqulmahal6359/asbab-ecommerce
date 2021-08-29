function send_message() {

    var name = jQuery("#name").val();
    var email = jQuery("#email").val();
    var mobile = jQuery("#mobile").val();
    var subject = jQuery("#subject").val();
    var message = jQuery("#message").val();

    if(name == ""){
        alert("Please enter Name");
    } else if (email == ""){
        alert("Please enter Email");
    }else if (mobile == ""){
        alert("Please enter Mobile");
    }else if (subject == ""){
        alert("Please enter Subject");
    }else if (message == ""){
        alert("Please enter Message");
    }else{
        jQuery.ajax({
            url: "send_message.php",
            type: 'post',
            data: 'name='+name+'&email='+email+'&mobile='+mobile+'&subject='+subject+'&message='+message,
            success: function(result){
                alert(result);
            }
        })
    }
}

function user_register(){

    jQuery(".field_error").html('');
    jQuery(".form-message").html('');

    var name = jQuery("#name").val();
    var email = jQuery("#email").val();
    var mobile = jQuery("#mobile").val();
    var password = jQuery("#password").val();
    var is_error = '';

    if(name == ""){
        jQuery("#name_error").html('Please Enter Your Name');
        is_error = 'yes';
    }
    if(email == ""){
        jQuery("#email_error").html('Please Enter Your Email');
        is_error = 'yes';
    }
    if(mobile == ""){
        jQuery("#mobile_error").html('Please Enter Your Mobile');
        is_error = 'yes';
    } 
    if(password == ""){
        jQuery("#password_error").html('Please Enter Your Password');
        is_error = 'yes';
    }

    if(is_error == ""){
        jQuery.ajax({
            url: 'register_submit.php',
            type: 'post',
            data: 'name='+name+'&email='+email+'&mobile='+mobile+'&password='+password,
            success: function(result){
                if(result=='email_exists'){
                    jQuery('#email_error').html('Email has already been exists');
                }
                if(result=='mobile_exists'){
                    jQuery('#mobile_error').html('Mobile Number has already been exists');
                }
                if(result=='inserts'){
                    jQuery('.form-message').html('Thanks For Registration');
                    jQuery('#regForm')[0].reset();
                    window.location.href = 'index.php';
                }
            }
        })
    }
       
}

function user_login(){
    jQuery(".field_error").html('');
    jQuery(".form-message").html('');

    var email = jQuery("#login_email").val();
    var password = jQuery("#login_password").val();
    var is_error = '';

    if(email == ""){
        jQuery("#login_email_error").html('Please Enter Valid Email');
        is_error = 'yes';
    }else if(password == ""){
        jQuery("#login_password_error").html('Please Enter Valid Password');
        is_error = 'yes';
    }

    if(is_error == ""){
        jQuery.ajax({
            url: 'login_submit.php',
            type: 'post',
            data: 'email='+email+'&password='+password,
            success: function(result){
                if(result=='wrong'){
                    jQuery('.form-output p').removeClass("form-message");
                    jQuery('.form-output p').addClass("form-error");
                    jQuery('.form-error').html("Please enter valid Credentials");
                }
                if(result=='correct'){
                    jQuery('.form-message').html('Please Wait......');
                    window.location.href = 'index.php';
                }
            }
        })
    }
}

function checkout_login(){
    jQuery(".field_error").html('');

    var email = jQuery("#login_email").val();
    var password = jQuery("#login_password").val();
    var is_error = '';

    if(email == ""){
        jQuery("#login_email_error").html('Please Enter Valid Email');
        is_error = 'yes';
    }else if(password == ""){
        jQuery("#login_password_error").html('Please Enter Valid Password');
        is_error = 'yes';
    }

    if(is_error == ""){
        jQuery.ajax({
            url: 'login_submit.php',
            type: 'post',
            data: 'email='+email+'&password='+password,
            success: function(result){
                if(result=='wrong'){
                    jQuery('.form-output p').removeClass("form-message");
                    jQuery('.form-output p').addClass("form-error");
                    jQuery('.form-error').html("Please enter valid Credentials");
                }
                if(result=='correct'){
                    window.location.href = window.location.href;
                }
            }
        })
    }
}

function add_to_cart(pid, type){
    if(type=='update'){
        var qty = jQuery('#'+pid+'qty').val();
    }else{
        var qty = jQuery('#qty').val();
    }
    
    jQuery.ajax({
        url: "manage_cart.php",
        type: 'post',
        data: 'pid='+pid+'&qty='+qty+'&type='+type,
        success: function(result){
            if(type=='update' || type == 'remove'){
                window.location.href = window.location.href;
            }
            jQuery(".htc__qua").html(result);
        }
    })
}

function sort_product_list(cat_id, site_path){
    var sort_product = jQuery('#sort_product_id').val();
    window.location.href = site_path+"categories.php?id="+cat_id+"&sort_by="+sort_product;
}

function manage_wishlist(pid, type){ 
    jQuery.ajax({
        url: "manage_wishlist.php",
        type: 'post',
        data: 'pid='+pid+'&type='+type,
        success: function(result){
            if(result=='not_login'){
                alert("You must Login before to continue for purchase");
                window.location.href = 'login_register.php';
            }else{
                window.location.href=window.location.href;
            }
        }
    })
}