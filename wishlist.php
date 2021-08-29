<?php
include('header.php');


if(isset($_SESSION['USER_LOGIN'])){
    $uid = $_SESSION['USER_ID'];
    $wishlist_query = "SELECT product.image, product.name, product.short_desc, product.description, product.mrp, product.price, wishlist.id FROM product, wishlist WHERE  wishlist.user_id='$uid' AND product.id = wishlist.product_id";
    $wishlist_res = mysqli_query($con, $wishlist_query);

    if(isset($_GET['id'])){
        $id= $_GET['id'];
        $wishlist_del_query = "DELETE FROM wishlist WHERE id='$id' AND user_id='$uid'";
        mysqli_query($con, $wishlist_del_query);
        redirect('wishlist.php');
    }
}else{
    redirect('login_register.php');
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
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(assets/images/bg/4.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.html">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">shopping cart</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="cart-main-area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <?php
                        if(isset($wishlist_res)){
                            if(empty($wishlist_res)){
                                echo "<h2>Your Wishlist Looks like Empty. Please Login From <a href='login_register.php'>Here</a> First</h2>";
                            }else{
                    ?>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <form action="#">               
                            <div class="table-content table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail" width="10%">Image</th>
                                            <th class="product-name" width="30%">Product Name</th>
                                            <th class="product-price" width="60%">Product Summary</th>
                                            <th class="product-quantity">Overall Price</th>
                                            <th class="product-remove">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            while($row = mysqli_fetch_array($wishlist_res, MYSQLI_ASSOC)){
                                        ?>
                                        <tr>
                                            <td class="product-thumbnail"><a href="#"><img src="<?php echo SITE_PRODUCT_IMAGE.$row['image']; ?>" alt="<?php echo $row['name']; ?>" /></a></td>
                                            <td class="product-name"><a href="#"><?php echo $row['name']; ?></a>
                                                <ul  class="pro__prize">
                                                    <li class="old__prize">$ <?php echo $row['mrp']; ?></li>
                                                    <li>$ <?php echo $row['price']; ?></li>
                                                </ul>
                                            </td>
                                            <td class="product-price"><span class="amount"><?php echo $row['short_desc']; ?></span><br><?php echo $row['description']; ?></td>
                                            <td class="product-subtotal"><span style="color: grey">$ <?php echo $row['mrp'] ?></span><br>$ <?php echo $row['price'] ?></td>
                                            <td class="product-remove"><a href="wishlist.php?id=<?php echo $row['id']; ?>" ><i class="icon-trash icons"></i></a></td>
                                        </tr>
                                     <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="buttons-cart--inner">
                                        <div class="buttons-cart">
                                            <a href="index.php">Continue Shopping</a>
                                        </div>
                                        <div class="buttons-cart checkout--btn">
                                            <a href="#">update</a>
                                            <a href="checkout.php">checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form> 
                    </div>
                    <?php } }?>
                </div>
            </div>
        </div>
        <!-- cart-main-area end -->
       
<?php
include('footer.php');
?>  