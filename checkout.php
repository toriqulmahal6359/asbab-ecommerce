<?php
include('header.php');

if(!isset($_SESSION['cart']) || count($_SESSION['cart'])==0){
    redirect("index.php");
    die();
}

$cart_total = 0;
foreach($_SESSION['cart'] as $key=>$val){
    $cart_product_arr = get_product($con, '', null, $key);
    $price = $cart_product_arr[0]['price'];
    $qty = $val['qty'];
    $cart_total = $cart_total + ($price*$qty);
}

if(isset($_POST['submit'])){

    $first_name = get_safe_value($con, $_POST['first_name']);
    $last_name = get_safe_value($con, $_POST['last_name']);
    $street_address = get_safe_value($con, $_POST['street_address']);
    $state = get_safe_value($con, $_POST['state']);
    $city = get_safe_value($con, $_POST['city']);
    $zip_code = get_safe_value($con, $_POST['zip_code']);
    $email = get_safe_value($con, $_POST['email']);
    $phone = get_safe_value($con, $_POST['phone']);
    $payment_type = get_safe_value($con, $_POST['payment_type']);
    $user_id = $_SESSION['USER_ID'];
    $total_price = $cart_total;
    $payment_status = 'pending';
    if($payment_type=='COD'){
        $payment_status = 'success';
    }
    $order_status = 1;
    $added_on = date('Y-m-d h:i:s');

    $checkout_query = "INSERT INTO orders(user_id, first_name, last_name, street_address, state, city, zip_code, email, phone, payment_type, total_price, payment_status, order_status, added_on) VALUES('$user_id', '$first_name', '$last_name', '$street_address', '$state', '$city', '$zip_code', '$email', '$phone', '$payment_type', '$total_price', '$payment_status', '$order_status', '$added_on')";
    mysqli_query($con, $checkout_query);

    $order_id = mysqli_insert_id($con);

    $cart_total = 0;
    foreach($_SESSION['cart'] as $key=>$val){
        $cart_product_arr = get_product($con, '', null, $key);
        $price = $cart_product_arr[0]['price'];
        $qty = $val['qty'];

        $order_query = "INSERT INTO order_details(order_id, product_id, qty, price) VALUES('$order_id', '$key', '$qty', '$price')";
        mysqli_query($con, $order_query);
    }

    unset($_SESSION['cart']);
    redirect('thank_you.php');
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
        <!-- cart-main-area start -->
        <div class="checkout-wrap ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="checkout__inner">
                            <div class="accordion-list">
                                <div class="accordion">
                                        <?php 
                                            if(!isset($_SESSION['USER_LOGIN'])){
                                        ?>
                                    <div class="accordion__title">
                                        Checkout Process
                                    </div>
                                    <div class="accordion__body">
                                        <div class="accordion__body__form">
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <div class="checkout-method__login" >
                                                        <form id="loginForm" action="#" method="post">
                                                            <h5 class="checkout-method__title">Login</h5>
                                                            <div class="single-input">
                                                                <label for="user-email">Email Address</label>
                                                                <input type="email" name="login_email" id="login_email" placeholder="Your Email" >
                                                                <span class="field_error" id="login_email_error"></span>
                                                            </div>
                                                            <div class="single-input">
                                                                <label for="user-pass">Passwords</label>
                                                                <input type="password" name="login_password" id="login_password" placeholder="Your Password">
                                                                <span class="field_error" id="login_password_error"></span>
                                                            </div>
                                                            <div class="dark-btn">
                                                                <button type="button" class="frm_btn" onclick="checkout_login()">Login</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } else{ ?>
                                    <form method="post">
                                    <div class="accordion__title">
                                        Billing Information
                                    </div>
                                    <div class="accordion__body">
                                        <div class="bilinfo">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="single-input">
                                                            <input type="text" name="first_name" placeholder="First name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="single-input">
                                                            <input type="text" name="last_name" placeholder="Last name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="single-input">
                                                            <input type="text" name="street_address" placeholder="Street Address" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="single-input">
                                                            <input type="text" name="state" placeholder="State" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="single-input">
                                                            <input type="text" name="city" placeholder="City" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="single-input">
                                                            <input type="text" name="zip_code" placeholder="Post code/ zip" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="single-input">
                                                            <input type="email" name="email" placeholder="Email address" value="<?php if(isset($_SESSION['USER_EMAIL'])!=NULL){ echo $_SESSION['USER_EMAIL']; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="single-input">
                                                            <input type="text" name="phone" placeholder="Phone number">
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="accordion__title">
                                        payment information
                                    </div>
                                    <div class="accordion__body">
                                        <div class="paymentinfo">
                                            <div class="single-method">
                                                <input type="radio" name="payment_type" value="COD" required>&nbsp;COD
                                                &nbsp;&nbsp;
                                                <input type="radio" name="payment_type" value="payU" required>&nbsp;payU
                                            </div>
                                            <div class="single-method">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <input type="submit" name="submit">
                                    </form>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="order-details">
                            <h5 class="order-details__title">Your Order</h5>
                            <div class="order-details__item">
                            <?php
                                $cart_total = 0;
                                foreach($_SESSION['cart'] as $key=>$val){
                                    $cart_product_arr = get_product($con, '', null, $key);
                                    $name = $cart_product_arr[0]['name'];
                                    $image = $cart_product_arr[0]['image'];
                                    $mrp = $cart_product_arr[0]['mrp'];
                                    $price = $cart_product_arr[0]['price'];
                                    $qty = $val['qty'];
                                    $cart_total = $cart_total + ($price*$qty);
                            ?>
                                <div class="single-item">
                                    <div class="single-item__thumb">
                                        <img src="<?php echo SITE_PRODUCT_IMAGE.$image; ?>" alt="<?php echo $name; ?>">
                                    </div>
                                    <div class="single-item__content">
                                        <a href="#"><?php echo $name; ?></a>
                                        <span class="price">$ <?php echo $price*$qty; ?></span>
                                    </div>
                                    <div class="single-item__remove">
                                        <a href="javascript:void(0)" onclick="add_to_cart(<?php echo $key;?>,'remove')"><i class="zmdi zmdi-delete"></i></a>
                                    </div>
                                </div>
                            <?php } ?> 
                            </div>
                            <div class="order-details__count">
                                <div class="order-details__count__single">
                                    <h5>sub total</h5>
                                    <span class="price">$909.00</span>
                                </div>
                                <div class="order-details__count__single">
                                    <h5>Tax</h5>
                                    <span class="price">$9.00</span>
                                </div>
                                <div class="order-details__count__single">
                                    <h5>Shipping</h5>
                                    <span class="price">0</span>
                                </div>
                            </div>
                            <div class="ordre-details__total">
                                <h5>Order total</h5>
                                <span class="price">$ <?php echo $cart_total; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- cart-main-area end -->
        <!-- Start Brand Area -->

        <!-- End Brand Area -->

<?php
include('footer.php');
?>