<?php
include('header.php');

if(isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN']=='yes'){
    redirect('my_orders.php');
    die();
}
?>
            <!-- Start Cart Panel -->
            <div class="shopping__cart">
                <div class="shopping__cart__inner">
                    <div class="offsetmenu__close__btn">
                        <a href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                    <div class="shp__cart__wrap">
                        <div class="shp__single__product">
                            <div class="shp__pro__thumb">
                                <a href="#">
                                    <img src="images/product-2/sm-smg/1.jpg" alt="product images">
                                </a>
                            </div>
                            <div class="shp__pro__details">
                                <h2><a href="product-details.html">BO&Play Wireless Speaker</a></h2>
                                <span class="quantity">QTY: 1</span>
                                <span class="shp__price">$105.00</span>
                            </div>
                            <div class="remove__btn">
                                <a href="#" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                            </div>
                        </div>
                        <div class="shp__single__product">
                            <div class="shp__pro__thumb">
                                <a href="#">
                                    <img src="images/product-2/sm-smg/2.jpg" alt="product images">
                                </a>
                            </div>
                            <div class="shp__pro__details">
                                <h2><a href="product-details.html">Brone Candle</a></h2>
                                <span class="quantity">QTY: 1</span>
                                <span class="shp__price">$25.00</span>
                            </div>
                            <div class="remove__btn">
                                <a href="#" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                            </div>
                        </div>
                    </div>
                    <ul class="shoping__total">
                        <li class="subtotal">Subtotal:</li>
                        <li class="total__price">$130.00</li>
                    </ul>
                    <ul class="shopping__btn">
                        <li><a href="cart.html">View Cart</a></li>
                        <li class="shp__checkout"><a href="checkout.html">Checkout</a></li>
                    </ul>
                </div>
            </div>
            <!-- End Cart Panel -->
        </div>
        <!-- End Offset Wrapper -->
        <!-- Start Bradcaump area -->
        
        <!-- End Bradcaump area -->
        <!-- Start Product Details Area -->
        
        <!-- End Product Details Area -->
        <!-- Start Product Description -->
        <section class="htc__produc__decription bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-lg-push-3">
                        <!-- Start List And Grid View -->
                        <ul class="register_login" style="clear:both" role="tablist">
                            <li role="presentation" class="login active"><a href="#login" role="tab" data-toggle="tab">Login</a></li>
                            <div>&nbsp;&nbsp;|&nbsp;&nbsp;</div>
                            <li role="presentation" class="register"><a href="#register" role="tab" data-toggle="tab">Register</a></li>
                        </ul>
                        <!-- End List And Grid View -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-9 col-lg-push-3">
                        <div class="ht__pro__details__content">
                            <!-- Start Single Content -->
                            <div role="tabpanel" id="login" class="pro__single__content tab-pane fade in active">
                                <div class="pro__tab__content__inner">
                                    <form id="loginForm" method="post">
                                        <div class="single-contact-form">
                                            <div class="contact-box name">
                                                <input type="email" name="login_email" id="login_email" placeholder="Your Email" >
                                            </div>
                                            <span class="field_error" id="login_email_error"></span>
                                        </div>
                                        <div class="single-contact-form">
                                            <div class="contact-box name">
                                                <input type="password" name="login_password" id="login_password" placeholder="Your Password">
                                            </div>
                                            <span class="field_error" id="login_password_error"></span>
                                        </div>
                                        <div class="contact_btn">
                                            <button type="button" class="frm_btn" onclick="user_login()">Login</button>
                                        </div>
                                    </form>
                                    <div class="form-output">
                                        <p class="form-message"></p>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content -->
                            <!-- Start Single Content -->
                            <div role="tabpanel" id="register" class="pro__single__content tab-pane fade">
                                <div class="pro__tab__content__inner">
                                <form id="regForm" method="post">
                                        <div class="single-contact-form">
                                            <div class="contact-box name">
                                                <input type="text" name="name" id="name" placeholder="Your Name" >
                                            </div>
                                            <span class="field_error" id="name_error"></span>
                                        </div>
                                        <div class="single-contact-form">
                                            <div class="contact-box name">
                                                <input type="email" name="email" id="email" placeholder="Your Email" >
                                                <button type="button" class="frm_btn email_send_otp" onclick="email_send_otp()" style="margin-top: 7px">Send OTP</button>
                                                <span class="send_otp_msg"></span>
                                            </div>
                                            <span class="field_error" id="email_error"></span>
                                        </div>
                                        <div class="single-contact-form send_otp" id="send_otp">
                                            <div class="contact-box name">
                                                <input type="text" name="sent_otp" id="sent_otp" placeholder="OTP Number" >
                                                <button type="button" class="frm_btn email_verify_otp" onclick="email_verify_otp()" style="margin-top: 7px">Verify OTP</button>
                                            </div>
                                        </div>
                                        <div class="single-contact-form">
                                            <div class="contact-box name">
                                                <input type="password" name="password" id="password" placeholder="Your Password" >
                                            </div>
                                            <span class="field_error" id="password_error"></span>
                                        </div>
                                        <div class="single-contact-form">
                                            <div class="contact-box name">
                                                <input type="text" name="mobile" id="mobile" placeholder="Your Mobile">
                                                <button type="button" class="frm_btn mobile_send_otp" onclick="mobile_send_otp()" style="margin-top: 7px">Send OTP</button>
                                                <span class="send_otp_mobile_msg"></span>
                                            </div>
                                            <span class="field_error" id="mobile_error"></span>
                                        </div>
                                        <div class="single-contact-form send_otp" id="mobile_send_otp">
                                            <div class="contact-box name">
                                                <input type="text" name="mobile_sent_otp" id="mobile_sent_otp" placeholder="OTP Number" >
                                                <button type="button" class="frm_btn mobile_verify_otp" onclick="mobile_verify_otp()" style="margin-top: 7px">Verify OTP</button>
                                            </div>
                                        </div>
                                        <div class="contact_btn">
                                            <button type="button" class="frm_btn" disabled id="register_btn" onclick="user_register()">Register</button>
                                        </div>
                                    </form>
                                    <div class="form-output">
                                        <p class="form-message"></p>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content -->
                            <!-- Start Single Content -->
            
                            <!-- End Single Content -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <input type="hidden" id="is_email_verified">
        <input type="hidden" id="is_mobile_verified">
        <!-- End Product Description -->
        <!-- Start Product Area -->
        
        <!-- End Product Area -->
        <!-- Start Banner Area -->
       
        <!-- End Banner Area -->
        <!-- End Banner Area -->
<?php
include('footer.php');
?>