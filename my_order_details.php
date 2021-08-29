<?php
    include('header.php');
    $order_id = get_safe_value($con, $_GET['id']);
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
                                                <th class="product-name"><span class="nobr">Product Image</span></th>
                                                <th class="product-price"><span class="nobr"> Product Name </span></th>
                                                <th class="product-stock-stauts"><span class="nobr"> Quantity </span></th>
                                                <th class="product-stock-stauts"><span class="nobr"> Price </span></th>
                                                <th class="product-stock-stauts"><span class="nobr"> Total Price </span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $uid = $_SESSION['USER_ID'];
                                                $my_order_query = "SELECT DISTINCT(order_details.id), order_details.*, product.image, product.name FROM order_details, product, orders WHERE order_details.order_id = '$order_id' AND order_details.product_id = product.id AND orders.user_id = '$uid'";
                                                $my_order_res = mysqli_query($con, $my_order_query);
                                                
                                                $total_price = 0;
                                                while($row = mysqli_fetch_array($my_order_res, MYSQLI_ASSOC)){
                                                    $total_price = $total_price + ($row['qty']*$row['price']);
                                            ?>
                                            <tr>
                                                <td class="product-name"><img src="<?php echo SITE_PRODUCT_IMAGE.$row['image']; ?>" alt="<?php echo $row['name']; ?>" width="100px"></td>
                                                <td class="product-name"><?php echo $row['name']; ?></td>
                                                <td class="product-name"><?php echo $row['qty']; ?></td>
                                                <td class="product-name"><?php echo $row['price']; ?></td>
                                                <td class="product-name"><?php echo $row['qty']*$row['price']; ?></td>
                                            </tr>
                                         <?php } ?>
                                                <tr>
                                                    <td colspan="3"></td>
                                                    <td class="product-name">Total Price :</td>
                                                    <td class="product-name"><?php echo $total_price; ?></td>
                                                </tr>
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