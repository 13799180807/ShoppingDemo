<?php
require 'config.php';
require 'curl.php';

    if (isset($_POST['lookupName'])){
        $lookupRes=waresLookup($_POST['lookupName']);
        if ($lookupRes=="-1"){
        }else{
        }
    }else{
        $lookupRes="-1";
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>商品搜索</title>
    <!-- Favicons -->
    <link rel="shortcut icon" href="<?php echo ASSETS; ?>images/favicon.ico">
    <!-- Vendor CSS (Icon Font) -->
    <link rel="stylesheet" href="<?php echo ASSETS; ?>css/vendor/vendor.min.css">
    <link rel="stylesheet" href="<?php echo ASSETS; ?>css/plugins/plugins.min.css">
    <link rel="stylesheet" href="<?php echo ASSETS; ?>css/style.min.css">

</head>

<body>

    <!-- Header Section Start -->
    <div class="header section">
        <!-- Header Bottom Start -->
        <div class="header-bottom">
            <div class="header-sticky">
                <div class="container">
                    <div class="row align-items-center position-relative">

                        <!-- Header Menu Start -->
                        <div class="col-lg-6 d-none d-lg-block">
                            <div class="main-menu">
                                <ul>
                                    <li><a href="index.php">主页</a></li>
                                    <li><a href="lookup.php">搜索</a></li>
                                    <li><a href="shop.php">更多分类</a></li>

                                </ul>
                            </div>
                        </div>
                        <!-- Header Menu End -->

                        <!-- Header Action Start -->
                        <div class="col-md-6 col-lg-3 col-xl-4 col-6 justify-content-end">
                            <div class="header-actions">
                                <a href="javascript:void(0)" class="header-action-btn header-action-btn-search d-none d-lg-block"><i class="pe-7s-search"></i></a>

                                <!-- Mobile Menu Hambarger Action Button End -->
                            </div>
                        </div>
                        <!-- Header Action End -->

                    </div>
                </div>
            </div>
        </div>
        <!-- Header Bottom End -->
        <!-- Offcanvas Search Start -->
        <div class="offcanvas-search">
            <div class="offcanvas-search-inner">

                <!-- Button Close Start -->
                <div class="offcanvas-btn-close">
                    <i class="pe-7s-close"></i>
                </div>
                <!-- Button Close End -->

                <!-- Offcanvas Search Form Start -->
                <form class="offcanvas-search-form" action="lookup.php" method="post">
                    <input type="text" name="lookupName" placeholder="Search Product..." class="offcanvas-search-input">
                </form>
                <!-- Offcanvas Search Form End -->

            </div>
        </div>
        <!-- Offcanvas Search End -->

        <!-- Cart Offcanvas Start -->
        <div class="cart-offcanvas-wrapper">
            <div class="offcanvas-overlay"></div>

            <!-- Cart Offcanvas Inner Start -->
            <div class="cart-offcanvas-inner">

                <!-- Button Close Start -->
                <div class="offcanvas-btn-close">
                    <i class="pe-7s-close"></i>
                </div>
                <!-- Button Close End -->

                <!-- Offcanvas Cart Content Start -->
                <div class="offcanvas-cart-content">

                    <!-- Cart Product/Price Start -->
                    <div class="cart-product-wrapper mb-4 pb-4 border-bottom">

                        <!-- Single Cart Product Start -->
                        <div class="single-cart-product">
                            <div class="cart-product-thumb">
                                <a href="single-product.html"><img src="assets/images/products/small-product/1.jpg" alt="Cart Product"></a>
                            </div>
                            <div class="cart-product-content">
                                <h3 class="title"><a href="single-product.html">New badge product</a></h3>
                                <div class="product-quty-price">
                                    <span class="cart-quantity">3 <strong> × </strong></span>
                                    <span class="price">
									<span class="new">$70.00</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- Single Cart Product End -->

                        <!-- Product Remove Start -->
                        <div class="cart-product-remove">
                            <a href="#"><i class="pe-7s-close"></i></a>
                        </div>
                        <!-- Product Remove End -->

                    </div>
                    <!-- Cart Product/Price End -->

                    <!-- Cart Product/Price Start -->
                    <div class="cart-product-wrapper mb-4 pb-4 border-bottom">

                        <!-- Single Cart Product Start -->
                        <div class="single-cart-product">
                            <div class="cart-product-thumb">
                                <a href="single-product.html"><img src="assets/images/products/small-product/2.jpg" alt="Cart Product"></a>
                            </div>
                            <div class="cart-product-content">
                                <h3 class="title"><a href="single-product.html">Soldout new product</a></h3>
                                <div class="product-quty-price">
                                    <span class="cart-quantity">4 <strong> × </strong></span>
                                    <span class="price">
									<span class="new">$80.00</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- Single Cart Product End -->

                        <!-- Product Remove Start -->
                        <div class="cart-product-remove">
                            <a href="#"><i class="pe-7s-close"></i></a>
                        </div>
                        <!-- Product Remove End -->

                    </div>
                    <!-- Cart Product/Price End -->

                    <!-- Cart Product/Price Start -->
                    <div class="cart-product-wrapper mb-4 pb-4 border-bottom">

                        <!-- Single Cart Product Start -->
                        <div class="single-cart-product">
                            <div class="cart-product-thumb">
                                <a href="single-product.html"><img src="assets/images/products/small-product/1.jpg" alt="Cart Product"></a>
                            </div>
                            <div class="cart-product-content">
                                <h3 class="title"><a href="single-product.html">New badge product</a></h3>
                                <div class="product-quty-price">
                                    <span class="cart-quantity">2 <strong> × </strong></span>
                                    <span class="price">
									<span class="new">$50.00</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- Single Cart Product End -->

                        <!-- Product Remove Start -->
                        <div class="cart-product-remove">
                            <a href="#"><i class="pe-7s-close"></i></a>
                        </div>
                        <!-- Product Remove End -->

                    </div>
                    <!-- Cart Product/Price End -->

                    <!-- Cart Product Total Start -->
                    <div class="cart-product-total mb-4 pb-4 border-bottom">
                        <span class="value">Total</span>
                        <span class="price">220$</span>
                    </div>
                    <!-- Cart Product Total End -->

                    <!-- Cart Product Button Start -->
                    <div class="cart-product-btn mt-4">
                        <a href="cart.html" class="btn btn-light btn-hover-primary w-100"><i class="fa fa-shopping-cart"></i> View cart</a>
                        <a href="checkout.html" class="btn btn-light btn-hover-primary w-100 mt-4"><i class="fa fa-share"></i> Checkout</a>
                    </div>
                    <!-- Cart Product Button End -->

                </div>
                <!-- Offcanvas Cart Content End -->

            </div>
            <!-- Cart Offcanvas Inner End -->
        </div>
        <!-- Cart Offcanvas End -->

    </div>
    <!-- Header Section End -->


    <!-- Shop Section Start -->
    <div class="section section-margin">
        <div class="container">
            <div class="row">
                <div class="col-12">
                        <!-- Shop Wrapper Start -->
                        <div class="row shop_wrapper grid_4">
                            <!--开始-->
                            <?php

                            if($lookupRes=="-1"){
                                echo "<span style='margin-left: 20%;font-size: 23px'>空空如也......</span>";
                            }else{
                                foreach ($lookupRes as $row){

                                    ?>
                                    <!-- Single Product Start -->
                                    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 product">
                                        <div class="product-inner">
                                            <div class="thumb">
                                                <a href="single-product.php?commodity=<?php echo $row["sp_uid"]; ?>" class="image">
                                                    <img class="first-image" src="<?php echo IMG_PATH.$row['sp_imgpath'] ; ?>" alt="Product" />
                                                </a>
                                            </div>
                                            <div class="content">
                                                <h5 class="title"><a href="single-product.php?commodity=<?php echo $row["sp_uid"]; ?>"><?php echo $row['sp_name'] ;?></a></h5>
                                                <span class="price">
                                            <span class="new">￥<?php echo $row['sp_price'] ;?></span>
                                    <span class="old">  </span>
                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Product End -->
                                    <?php
                                }
                            }
                            ?>
                            <!--结束-->
                        </div>
                        <!-- Shop Wrapper End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Section End -->


    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/plugins.min.js"></script>
    <!--Main JS-->
    <script src="assets/js/main.js"></script>
</body>

</html>