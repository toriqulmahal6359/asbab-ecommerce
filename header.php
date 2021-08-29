<?php
    include('admin/connection.inc.php');
    include('admin/functions.inc.php');
    include('admin/constant.inc.php');
    include('add_to_cart.inc.php');

    $cat_query = "SELECT * FROM categories WHERE status=1";
    $cat_res = mysqli_query($con, $cat_query);

    $cat_arr = array();
    while($row = mysqli_fetch_array($cat_res, MYSQLI_ASSOC)){
        $cat_arr[] = $row;
    }

    $obj = new add_to_cart();
    $totalProduct = $obj->totalCart();

    if(isset($_SESSION['USER_LOGIN'])){
        $uid = $_SESSION['USER_ID'];
        $wishlist_query = "SELECT product.image, product.name, product.short_desc, product.description, product.mrp, product.price, wishlist.id FROM product, wishlist WHERE  wishlist.user_id='$uid' AND product.id = wishlist.product_id";
        $wishlist_res = mysqli_query($con, $wishlist_query);
        $wishlist_count = mysqli_num_rows($wishlist_res);
    }

    $script_name = $_SERVER['SCRIPT_NAME'];
    $script_arr = explode('/', $script_name);
    $get_uri_script = filter_var_array($script_arr, FILTER_SANITIZE_URL);
    $myPage = $get_uri_script[count($get_uri_script) - 1];

    $meta_title = 'Asbab Ecommerce';
    $meta_desc = 'Asbab Furniture Meta Test';
    $meta_keyword = 'sample, keyword';
    
    if($myPage == 'product.php'){
        $product_id = get_safe_value($con, $_GET['id']);
        $product_meta_query = "SELECT * FROM product WHERE id='$product_id'";
        $product_meta_res = mysqli_query($con, $product_meta_query);
        $product_meta_arr = mysqli_fetch_array($product_meta_res, MYSQLI_ASSOC);

        $meta_title = $product_meta_arr['meta_title'];
        $meta_desc = $product_meta_arr['meta_desc'];
        $meta_keyword = $product_meta_arr['meta_keyword'];
    }

    if($myPage == 'contact.php'){
        $meta_title = 'Contact Us';
    }
    
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $meta_title; ?></title>
    <meta name="description" content="<?php echo $meta_desc; ?>">
    <meta name="keywords" content="<?php echo $meta_keyword; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">


    <!-- All css files are included here. -->
    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Owl Carousel min css -->
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="assets/css/core.css">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="assets/css/shortcode/shortcodes.css">
    <!-- Theme main style -->
    <link rel="stylesheet" href="assets/style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- User style -->
    <link rel="stylesheet" href="assets/css/custom.css">


    <!-- Modernizr JS -->
    <script src="assets/js/vendor/modernizr-3.5.0.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <!-- Body main wrapper start -->
    <div class="wrapper">
        <!-- Start Header Style -->
        <header id="htc__header" class="htc__header__area header--one">
            <!-- Start Mainmenu Area -->
            <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
                <div class="container">
                    <div class="row">
                        <div class="menumenu__container clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
                                <div class="logo">
                                    <a href="index.php"><img src="assets/images/logo/4.png" alt="logo images"></a>
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-8 col-sm-5 col-xs-3">
                                <nav class="main__menu__nav hidden-xs hidden-sm">
                                    <ul class="main__menu">
                                        <?php
                                            foreach($cat_arr as $list){
                                        ?>
                                            <li class="drop"><a href="categories.php?id=<?php echo $list['id']; ?>"><?php echo $list['categories']; ?></a></li>
                                        <?php 
                                            } 
                                        ?>
                                        <li><a href="contact.php">contact</a></li>
                                    </ul>
                                </nav>

                                <div class="mobile-menu clearfix visible-xs visible-sm">
                                    <nav id="mobile_dropdown">
                                        <ul>
                                        <?php
                                            foreach($cat_arr as $list){
                                        ?>
                                            <li><a href="categories.php?id=<?php echo $list['id']; ?>"><?php echo $list['categories']; ?></a></li>
                                        <?php 
                                            } 
                                        ?>
                                            <li><a href="contact.php">contact</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-2 col-sm-4 col-xs-4">
                                <div class="header__right">
                                    <div class="header__search search search__open">
                                        <a href="#"><i class="icon-magnifier icons"></i></a>
                                    </div>
                                    <div class="header__account">
                                        <?php
                                            if(isset($_SESSION['USER_LOGIN'])){
                                                echo '<a href="logout.php">LOGOUT</a>';
                                            }else{
                                                echo '<a href="login_register.php"><i class="icon-user icons"></i></a>';
                                            }
                                        ?>
                                    </div>
                                    <div class="htc__shopping__cart">
                                        <a class="cart__menu" href="#"><i class="icon-handbag icons"></i></a>
                                        <a href="#"><span class="htc__qua"><?php echo $totalProduct; ?></span></a>
                                    </div>
                                    <?php 
                                        if(isset($_SESSION['USER_LOGIN'])){
                                    ?>
                                    <div class="htc__wishlist__heart">
                                        <a class="wishlist__htc" href="wishlist.php"><i class="icon-heart icons"></i></a>
                                        <a href="wishlist.php"><span class="htc__wishlist"><?php echo $wishlist_count; ?></span></a>
                                    </div>
                                    <?php } ?>
                                    <div class="order__htc">
                                        <a href="my_orders.php">My Orders</a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-menu-area"></div>
                </div>
            </div>
            <!-- End Mainmenu Area -->
        </header>
        <div class="body__overlay"></div>
        <!-- Start Offset Wrapper -->
        <div class="offset__wrapper">
            <!-- Start Search Popap -->
            <div class="search__area">
                <div class="container" >
                    <div class="row" >
                        <div class="col-md-12" >
                            <div class="search__inner">
                                <form action="search.php" method="GET">
                                    <input placeholder="Search here... " type="text" name="str">
                                    <button type="submit"></button>
                                </form>
                                <div class="search__close__btn">
                                    <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Search Popap -->