<?php
    include('header.php');
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
        <!-- wishlist-area start -->
        <div class="wishlist-area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="wishlist-content">
                            <form action="#">
                                <div class="wishlist-table table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product-thumbnail">Order ID</th>
                                                <th class="product-name"><span class="nobr">Order Date</span></th>
                                                <th class="product-price"><span class="nobr"> Address </span></th>
                                                <th class="product-stock-stauts"><span class="nobr"> Payment Type </span></th>
                                                <th class="product-stock-stauts"><span class="nobr"> Payment Status </span></th>
                                                <th class="product-stock-stauts"><span class="nobr"> Order Status </span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $uid = $_SESSION['USER_ID'];
                                                $my_order_query = "SELECT orders.*, order_status.name AS order_status FROM orders, order_status WHERE orders.user_id = '$uid' AND orders.order_status = order_status.id";
                                                $my_order_res = mysqli_query($con, $my_order_query);

                                                while($row = mysqli_fetch_array($my_order_res, MYSQLI_ASSOC)){
                                            ?>
                                            <tr>
                                                <td class="product-add-to-cart"><a href="my_order_details.php?id=<?php echo $row['id']; ?>"><?php echo $row['id']; ?></a></td>
                                                <td class="product-name">
                                                    <?php 
                                                        $dateStr = strtotime($row['added_on']); 
                                                        echo date('d-m-Y h:i:s', $dateStr);
                                                    ?>
                                                </td>
                                                <td class="product-name">
                                                    <?php echo $row['street_address']; ?>,<br>
                                                    <?php echo $row['state']; ?>,
                                                    <?php echo $row['city']; ?>,
                                                    <?php echo $row['zip_code']; ?>
                                                </td>
                                                <td class="product-name"><?php echo $row['payment_type']; ?></td>
                                                <td class="product-name"><?php echo $row['payment_status']; ?></td>
                                                <td class="product-name"><?php echo $row['order_status']; ?></td>
                                            </tr>
                                         <?php } ?>
                                        </tbody>
                                    </table>
                                </div>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- wishlist-area end -->
        <!-- Start Brand Area -->
        
        <!-- End Brand Area -->
        <!-- Start Banner Area -->
       
        <!-- End Banner Area -->
        <!-- End Banner Area -->
<?php
    include('footer.php');
?>