<?php
require 'curl.php';
require 'config.php';

if (isset($_POST['name'])) {

    $res = categoryCurlPost($_POST['name'], $_POST['page_num'], $_POST['select_num']);
    $data = $res["data"];
    if (count($data) > 0) {
        //正确
        $categoryList = $data["category"];
        $callBack = $data["callBack"];
        $goodsList = $data["goodsList"];

    }

} else {
    //初始化数据
    $res = categoryCurlPost(0, 1, 8);
    $data = $res["data"];
    if (count($data) > 0) {
        //正确
        $categoryList = $data["category"];
        $callBack = $data["callBack"];
        $goodsList = $data["goodsList"];

    }
}
$categoryName = $callBack['categoryName'];
$categoryId = $callBack['categoryId'];
$totalPage = $callBack["totalPage"];  //总页面
$page = $callBack["page"];           //当前页面
$num = $callBack["num"];             //页面显示几条数据


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>商品分类查看</title>
    <link rel="shortcut icon" href="<?php echo ASSETS; ?>images/favicon.ico">
    <link rel="stylesheet" href="<?php echo ASSETS; ?>css/vendor/vendor.min.css">
    <link rel="stylesheet" href="<?php echo ASSETS; ?>css/plugins/plugins.min.css">
    <link rel="stylesheet" href="<?php echo ASSETS; ?>css/style.min.css">
</head>

<body>


<!-- Header Section Start -->
<div class="header section">


    <!-- Offcanvas Search Start -->
    <div class="offcanvas-search">
        <div class="offcanvas-search-inner">

            <!-- Button Close Start -->
            <div class="offcanvas-btn-close">
                <i class="pe-7s-close"></i>
            </div>
            <!-- Button Close End -->

            <!-- Offcanvas Search Form Start -->
            <form class="offcanvas-search-form" action="#">
                <input type="text" placeholder="Search Product..." class="offcanvas-search-input">
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
                            <a href="single-product.html"><img src="assets/images/products/small-product/1.jpg"
                                                               alt="Cart Product"></a>
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
                            <a href="single-product.html"><img src="assets/images/products/small-product/2.jpg"
                                                               alt="Cart Product"></a>
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
                            <a href="single-product.html"><img src="assets/images/products/small-product/1.jpg"
                                                               alt="Cart Product"></a>
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
                    <a href="cart.html" class="btn btn-light btn-hover-primary w-100"><i
                                class="fa fa-shopping-cart"></i> View cart</a>
                    <a href="checkout.html" class="btn btn-light btn-hover-primary w-100 mt-4"><i
                                class="fa fa-share"></i> Checkout</a>
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
                                <li><a href="index.php">首页</a></li>
                                <li><a href="lookup.php">搜索</a></li>
                                <li><a href="shop.php">更多商品</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Header Menu End -->

                    <!-- Header Action Start -->
                    <div class="col-md-6 col-lg-3 col-xl-4 col-6 justify-content-end">
                        <div class="header-actions">
                            <a href="javascript:void(0)"
                               class="header-action-btn header-action-btn-search d-none d-lg-block"><i
                                        class="pe-7s-search"></i></a>
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


</div>
<!-- Header Section End -->

<!-- Shop Section Start -->
<div class="section section-margin">

    <div class="container">

        <div class="row">
            <div class="col-12">
                <form action="shop.php" method="post">
                    <!--shop toolbar start-->
                    <div class="shop_toolbar_wrapper flex-column flex-md-row pb-10 mb-n4">

                        <!-- Shop Top Bar Left start -->
                        <div class="shop-top-bar-left mb-4">

                            <div class="shop_toolbar_btn">
                                <button data-role="grid_4" type="button" class="active btn-grid-4" title="Grid"><i
                                            class="fa fa-th"></i></button>
                                <button data-role="grid_list" type="button" class="btn-list" title="List"><i
                                            class="fa fa-list"></i></button>
                            </div>
                            <div class="shop-top-show">
                                <span><?php
                                    echo "当前查询到类别：{$categoryName}；总页面为：{$totalPage}页；当前为第：{$page}页；每页显示：{$num}条数据"
                                    ?></span>
                            </div>
                        </div>
                        <!-- Shop Top Bar Left end -->

                        <!-- Shopt Top Bar Right Start -->
                        <div class="shop-top-bar-right mb-4">
                            <!--表单请求-->

                            <div class="shop-short-by">
                                <select name="name" class="nice-select">
                                    <option value="<?php echo $categoryId; ?>"><?php echo $categoryName; ?></option>
                                    <option value="0">查询全部</option>
                                    <?php
                                    foreach ($categoryList as $row) {
                                        ?>
                                        <option value="<?php echo $row['goodsCategoryId']; ?>"><?php echo $row['goodsCategoryName']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <input class="btn btn-whited btn-hover-primary text-capitalize add-to-cart" type="submit"
                                   value="点击查询">

                            <!--表单请求结束-->
                        </div>
                        <!-- Shopt Top Bar Right End -->

                    </div>
                    <!--shop toolbar end-->

                    <!-- Shop Wrapper Start -->
                    <div class="row shop_wrapper grid_4">

                        <!--开始-->
                        <?php
                        $a = false;
                        foreach ($goodsList as $row) {
                            if ($row["goodsId"] == "") {
                                $a = true;
                                break;
                            }
                        }
                        if ($a) {
                            echo "<span style='margin-left: 45%;font-size: 23px'>空空如也......</span>";
                        } else {
                            foreach ($goodsList as $row) {

                                ?>
                                <!-- Single Product Start -->
                                <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 product">
                                    <div class="product-inner">
                                        <div class="thumb">
                                            <a href="single-product.php?commodity=<?php echo $row["goodsId"]; ?>"
                                               class="image">
                                                <img class="first-image"
                                                     src="<?php echo IMG_PATH . $row['goodsImg']; ?>" alt="Product"/>
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h5 class="title"><a
                                                        href="single-product.php?commodity=<?php echo $row["goodsId"]; ?>"><?php echo $row['goodsName']; ?></a>
                                            </h5>
                                            <span class="price">
                                            <span class="new">￥<?php echo $row['goodsPrice']; ?></span>
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

                    <!--shop toolbar start-->
                    <div class="shop_toolbar_wrapper mt-10 mb-n4">
                        <!-- Shop Top Bar Left start -->
                        <div class="shop-bottom-bar-left mb-4">
                            <div class="shop-short-by">
                                <select name="select_num" class="nice-select rounded-0"
                                        aria-label=".form-select-sm example">
                                    <option value="<?php echo $num; ?>" selected> 每页显示<?php echo $num; ?>条</option>
                                    <option value="4">每页显示4条</option>
                                    <option value="8">每页显示8条</option>
                                    <option value="12">每页显示12条</option>
                                </select>
                            </div>
                        </div>
                        <!-- Shop Top Bar Left end -->

                        <!-- Shopt Top Bar Right Start -->
                        <div class="shop-top-bar-right mb-4">

                            <select name="page_num" class="nice-select rounded-0" aria-label=".form-select-sm example">
                                <option value="<?php echo $page; ?>" selected>当前为第 <?php echo $page; ?> 页</option>
                                <?php
                                for ($ye = 1; $ye <= $totalPage; $ye++) {
                                    ?>
                                    <option value="<?php echo $ye; ?>"><?php echo $ye; ?>页</option>
                                    <?php
                                }
                                ?>
                            </select>
                            <input class="btn btn-whited btn-hover-primary text-capitalize add-to-cart" type="submit"
                                   value="点击前往">

                        </div>
                        <!-- Shopt Top Bar Right End -->
                    </div>
                    <!--shop toolbar end-->
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Shop Section End -->

<!-- Footer Section Start -->
<footer class="section footer-section">
    <!-- Footer Top Start -->
    <div class="footer-top bg-primary section-padding">
        <div class="container">
            <div class="row mb-n8">
                <div class="col-12 col-sm-6 col-lg-3 mb-8">
                    <div class="single-footer-widget">
                        <h1 class="widget-title">About Us</h1>
                        <p class="desc-content">We are a team of designers and developers that create high quality
                            wordpress, shopify, Opencart</p>
                        <!-- Soclial Link Start -->
                        <div class="widget-social justify-content-start mb-n2">
                            <a title="Facebook" href="#"><i class="fa fa-facebook-f"></i></a>
                            <a title="Twitter" href="#"><i class="fa fa-twitter"></i></a>
                            <a title="Linkedin" href="#"><i class="fa fa-linkedin"></i></a>
                            <a title="Youtube" href="#"><i class="fa fa-youtube"></i></a>
                            <a title="Vimeo" href="#"><i class="fa fa-vimeo"></i></a>
                        </div>
                        <!-- Social Link End -->
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3 mb-8">
                    <div class="single-footer-widget">
                        <h2 class="widget-title">Contact Us</h2>
                        <ul class="contact-links">
                            <li><i class="pe-7s-home"></i> <span>Your address goes here</span></li>
                            <li><i class="pe-7s-mail"></i><a href="mailto:info@example.com"> info@example.com</a></li>
                            <li><i class="pe-7s-call"></i><a href="tel:+012-3456-789"> +012 3456 789</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3 mb-8">
                    <div class="single-footer-widget aos-init aos-animate">
                        <h2 class="widget-title">Information</h2>
                        <ul class="widget-list">
                            <li><a href="contact.html">Terms & Conditions</a></li>
                            <li><a href="contact.html">Payment Methode</a></li>
                            <li><a href="contact.html">Product Warranty</a></li>
                            <li><a href="contact.html">Return Process</a></li>
                            <li><a href="contact.html">Payment Security</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3 mb-8">
                    <div class="single-footer-widget">
                        <h2 class="widget-title">Signup for newsletter</h2>
                        <div class="widget-body">
                            <!-- Newsletter Form Start -->
                            <div class="newsletter-form-wrap pt-1">
                                <form id="mc-form" class="mc-form">
                                    <input type="email" id="mc-email" class="form-control email-box mb-4"
                                           placeholder="demo@example.com" name="EMAIL">
                                    <button id="mc-submit" class="newsletter-btn" type="submit">Subscribe</button>
                                </form>
                                <!-- mailchimp-alerts Start -->
                                <div class="mailchimp-alerts text-centre">
                                    <div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->
                                    <div class="mailchimp-success text-success"></div><!-- mailchimp-success end -->
                                    <div class="mailchimp-error text-danger"></div><!-- mailchimp-error end -->
                                </div>
                                <!-- mailchimp-alerts end -->
                            </div>
                            <!-- Newsletter Form End -->
                            <p class="desc-content mb-0">Join over 1,000 people who get free and fresh content delivered
                                automatically each time we publish</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Top End -->

    <!-- Footer Bottom Start -->
    <div class="footer-bottom bg-secondary pt-4 pb-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 text-center">
                    <div class="copyright-content">
                        <p class="mb-0">Copyright &copy; 2021.Company name All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Bottom End -->
</footer>
<!-- Footer Section End -->


<!-- Modal Start  -->
<div class="modalquickview modal fade" id="quick-view" tabindex="-1" aria-labelledby="quick-view" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button class="btn close" data-bs-dismiss="modal">×</button>
            <div class="row">
                <div class="col-md-6 col-12">

                    <!-- Product Details Image Start -->
                    <div class="modal-product-carousel">

                        <!-- Single Product Image Start -->
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <a class="swiper-slide" href="#">
                                    <img class="w-100" src="assets/images/products/large-product/1.jpg" alt="Product">
                                </a>
                                <a class="swiper-slide" href="#">
                                    <img class="w-100" src="assets/images/products/large-product/2.jpg" alt="Product">
                                </a>
                                <a class="swiper-slide" href="#">
                                    <img class="w-100" src="assets/images/products/large-product/3.jpg" alt="Product">
                                </a>
                                <a class="swiper-slide" href="#">
                                    <img class="w-100" src="assets/images/products/large-product/4.jpg" alt="Product">
                                </a>
                                <a class="swiper-slide" href="#">
                                    <img class="w-100" src="assets/images/products/large-product/5.jpg" alt="Product">
                                </a>
                            </div>

                            <!-- Swiper Pagination Start -->
                            <!-- <div class="swiper-pagination d-md-none"></div> -->
                            <!-- Swiper Pagination End -->

                            <!-- Next Previous Button Start -->
                            <div class="swiper-product-button-next swiper-button-next"><i class="pe-7s-angle-right"></i>
                            </div>
                            <div class="swiper-product-button-prev swiper-button-prev"><i class="pe-7s-angle-left"></i>
                            </div>
                            <!-- Next Previous Button End -->
                        </div>
                        <!-- Single Product Image End -->

                    </div>
                    <!-- Product Details Image End -->

                </div>
                <div class="col-md-6 col-12 overflow-hidden position-relative">

                    <!-- Product Summery Start -->
                    <div class="product-summery position-relative">

                        <!-- Product Head Start -->
                        <div class="product-head mb-3">
                            <h2 class="product-title">Sample product title</h2>
                        </div>
                        <!-- Product Head End -->

                        <!-- Rating Start -->
                        <span class="ratings justify-content-start mb-2">
                            <span class="rating-wrap">
                                <span class="star" style="width: 100%"></span>
                            </span>
                            <span class="rating-num">(4)</span>
                            </span>
                        <!-- Rating End -->

                        <!-- Price Box Start -->
                        <div class="price-box mb-2">
                            <span class="regular-price">$80.00</span>
                            <span class="old-price"><del>$90.00</del></span>
                        </div>
                        <!-- Price Box End -->

                        <!-- Description Start -->
                        <p class="desc-content mb-5">I must explain to you how all this mistaken idea of denouncing
                            pleasure and praising pain was born and I will give you a complete account of the system,
                            and expound the actual teachings of the great explorer of the truth, the master-builder of
                            human happiness.</p>
                        <!-- Description End -->

                        <!-- Quantity Start -->
                        <div class="quantity d-flex align-items-center mb-5">
                            <span class="me-2"><strong>Qty: </strong></span>
                            <div class="cart-plus-minus">
                                <input class="cart-plus-minus-box" value="1" type="text">
                                <div class="dec qtybutton"></div>
                                <div class="inc qtybutton"></div>
                            </div>
                        </div>
                        <!-- Quantity End -->

                        <!-- Cart Button Start -->
                        <div class="cart-btn mb-4">
                            <div class="add-to_cart">
                                <a class="btn btn-dark btn-hover-primary" href="cart.html">Add to cart</a>
                            </div>
                        </div>
                        <!-- Cart Button End -->

                        <!-- Action Button Start -->
                        <div class="actions border-bottom mb-4 pb-4">
                            <a href="compare.html" title="Compare" class="action compare"><i
                                        class="pe-7s-refresh-2"></i> Compare</a>
                            <a href="wishlist.html" title="Wishlist" class="action wishlist"><i class="pe-7s-like"></i>
                                Wishlist</a>
                        </div>
                        <!-- Action Button End -->

                        <!-- Social Shear Start -->
                        <div class="social-share">
                            <span><strong>Social: </strong></span>
                            <a href="#" class="facebook-color"><i class="fa fa-facebook"></i> Like</a>
                            <a href="#" class="twitter-color"><i class="fa fa-twitter"></i> Tweet</a>
                            <a href="#" class="pinterest-color"><i class="fa fa-pinterest"></i> Save</a>
                        </div>
                        <!-- Social Shear End -->

                        <!-- Payment Option Start -->
                        <div class="payment-option mt-4 d-flex">
                            <span><strong>Payment: </strong></span>
                            <a href="#">
                                <img class="fit-image ms-1" src="assets/images/payment/payment.png"
                                     alt="Payment Option Image">
                            </a>
                        </div>
                        <!-- Payment Option End -->

                        <!-- Product Delivery Policy Start -->
                        <ul class="product-delivery-policy border-top pt-4 mt-4 border-bottom pb-4">
                            <li><i class="fa fa-check-square"></i> <span>Security Policy (Edit With Customer Reassurance Module)</span>
                            </li>
                            <li>
                                <i class="fa fa-truck"></i><span>Delivery Policy (Edit With Customer Reassurance Module)</span>
                            </li>
                            <li>
                                <i class="fa fa-refresh"></i><span>Return Policy (Edit With Customer Reassurance Module)</span>
                            </li>
                        </ul>
                        <!-- Product Delivery Policy End -->

                    </div>
                    <!-- Product Summery End -->

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal End  -->

<a href="#" class="scroll-top show" id="scroll-top">
    <i class="arrow-top pe-7s-angle-up-circle"></i>
    <i class="arrow-bottom pe-7s-angle-up-circle"></i>
</a>

<!-- Mobile Menu Start -->
<div class="mobile-menu-wrapper">
    <div class="offcanvas-overlay"></div>

    <!-- Mobile Menu Inner Start -->
    <div class="mobile-menu-inner">

        <!-- Button Close Start -->
        <div class="offcanvas-btn-close">
            <i class="pe-7s-close"></i>
        </div>
        <!-- Button Close End -->

        <!-- Mobile Menu Inner Wrapper Start -->
        <div class="mobile-menu-inner-wrapper">
            <!-- Mobile Menu Search Box Start -->
            <div class="search-box-offcanvas">
                <form>
                    <input class="search-input-offcanvas" type="text" placeholder="Search product...">
                    <button class="search-btn"><i class="pe-7s-search"></i></button>
                </form>
            </div>
            <!-- Mobile Menu Search Box End -->

            <!-- Mobile Menu Start -->
            <div class="mobile-navigation">
                <nav>
                    <ul class="mobile-menu">
                        <li class="has-children">
                            <a href="#">Home <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown">
                                <li><a href="index.html">Home One</a></li>
                                <li><a href="index-2.html">Home Two</a></li>
                                <li><a href="index-3.html">Home Three</a></li>
                            </ul>
                        </li>
                        <li class="has-children">
                            <a href="#">Shop <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                            <ul class="dropdown">
                                <li><a href="shop.html">Shop Grid</a></li>
                                <li><a href="shop-left-sidebar.html">Shop Left Sidebar</a></li>
                                <li><a href="shop-right-sidebar.html">Shop Right Sidebar</a></li>
                                <li><a href="shop-list-fullwidth.html">Shop List Fullwidth</a></li>
                                <li><a href="shop-list-left-sidebar.html">Shop List Left Sidebar</a></li>
                                <li><a href="shop-list-right-sidebar.html">Shop List Right Sidebar</a></li>
                                <li><a href="wishlist.html">Wishlist</a></li>
                                <li><a href="cart.html">Shopping Cart</a></li>
                                <li><a href="checkout.html">Checkout</a></li>
                                <li><a href="compare.html">Compare</a></li>
                            </ul>
                        </li>
                        <li class="has-children">
                            <a href="#">Product <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                            <ul class="dropdown">
                                <li><a href="single-product.html">Single Product</a></li>
                                <li><a href="single-product-sale.html">Single Product Sale</a></li>
                                <li><a href="single-product-group.html">Single Product Group</a></li>
                                <li><a href="single-product-normal.html">Single Product Normal</a></li>
                                <li><a href="single-product-affiliate.html">Single Product Affiliate</a></li>
                                <li><a href="single-product-slider.html">Single Product Slider</a></li>
                                <li><a href="single-product-gallery-left.html">Gallery Left</a></li>
                                <li><a href="single-product-gallery-right.html">Gallery Right</a></li>
                                <li><a href="single-product-tab-style-left.html">Tab Style Left</a></li>
                                <li><a href="single-product-tab-style-right.html">Tab Style Right</a></li>
                                <li><a href="single-product-sticky-left.html">Sticky Left</a></li>
                                <li><a href="single-product-sticky-right.html">Sticky Right</a></li>
                            </ul>
                        </li>
                        <li class="has-children">
                            <a href="#">Pages <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                            <ul class="dropdown">
                                <li><a href="about.html">About Us</a></li>
                                <li><a href="contact.html">Contact</a></li>
                                <li><a href="faq.html">Faq</a></li>
                                <li><a href="error-404.html">Error 404</a></li>
                                <li><a href="my-account.php">My Account</a></li>
                                <li><a href="login.php">Loging | Register</a></li>
                            </ul>
                        </li>
                        <li class="has-children">
                            <a href="#">Blog <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                            <ul class="dropdown">
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
                                <li><a href="blog-right-sidebar.html">Blog Right Sidebar</a></li>
                                <li><a href="blog-details.html">Blog Details</a></li>
                                <li><a href="blog-details-sidebar.html">Blog Details Sidebar</a></li>
                            </ul>
                        </li>
                        <li><a href="about.html">About</a></li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <!-- Mobile Menu End -->

            <!-- Language, Currency & Link Start -->
            <div class="offcanvas-lag-curr mb-6">
                <div class="header-top-lan-curr-link">
                    <div class="header-top-lan dropdown">
                        <h4 class="title">Language:</h4>
                        <button class="dropdown-toggle" data-bs-toggle="dropdown">English <i
                                    class="fa fa-angle-down"></i></button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a class="dropdown-item" href="#">English</a></li>
                            <li><a class="dropdown-item" href="#">Japanese</a></li>
                            <li><a class="dropdown-item" href="#">Arabic</a></li>
                            <li><a class="dropdown-item" href="#">Romanian</a></li>
                        </ul>
                    </div>
                    <div class="header-top-curr dropdown">
                        <h4 class="title">Currency:</h4>
                        <button class="dropdown-toggle" data-bs-toggle="dropdown">USD <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a class="dropdown-item" href="#">USD</a></li>
                            <li><a class="dropdown-item" href="#">Pound</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Language, Currency & Link End -->

            <!-- Contact Links/Social Links Start -->
            <div class="mt-auto bottom-0">

                <!-- Contact Links Start -->
                <ul class="contact-links">
                    <li><i class="fa fa-phone"></i><a href="#"> +012 3456 789</a></li>
                    <li><i class="fa fa-envelope-o"></i><a href="#"> info@example.com</a></li>
                    <li><i class="fa fa-clock-o"></i> <span>Monday - Sunday 9.00 - 18.00</span></li>
                </ul>
                <!-- Contact Links End -->

                <!-- Social Widget Start -->
                <div class="widget-social">
                    <a title="Facebook" href="#"><i class="fa fa-facebook-f"></i></a>
                    <a title="Twitter" href="#"><i class="fa fa-twitter"></i></a>
                    <a title="Linkedin" href="#"><i class="fa fa-linkedin"></i></a>
                    <a title="Youtube" href="#"><i class="fa fa-youtube"></i></a>
                    <a title="Vimeo" href="#"><i class="fa fa-vimeo"></i></a>
                </div>
                <!-- Social Widget Ende -->
            </div>
            <!-- Contact Links/Social Links End -->
        </div>
        <!-- Mobile Menu Inner Wrapper End -->

    </div>
    <!-- Mobile Menu Inner End -->
</div>
<!-- Mobile Menu End -->

<!-- Scripts -->
<!-- Global Vendor, plugins JS -->

<!-- Vendor JS -->

<!--
<script src="assets/js/vendor/popper.min.js"></script>
<script src="assets/js/vendor/bootstrap.min.js"></script>
<script src="assets/js/vendor/jquery-3.5.1.min.js"></script>
<script src="assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
<script src="assets/js/vendor/modernizr-3.11.2.min.js"></script>
-->


<!-- Plugins JS -->

<!--
<script src="assets/js/plugins/aos.min.js"></script>
<script src="assets/js/plugins/jquery.ajaxchimp.min.js"></script>
<script src="assets/js/plugins/jquery-ui.min.js"></script>
<script src="assets/js/plugins/nice-select.min.js"></script>
<script src="assets/js/plugins/swiper-bundle.min.js"></script>
<script src="assets/js/plugins/countdown.min.js"></script>
<script src="assets/js/plugins/lightgallery-all.min.js"></script>
-->


<!-- Use the minified version files listed below for better performance and remove the files listed above -->


<script src="assets/js/vendor.min.js"></script>
<script src="assets/js/plugins.min.js"></script>

<!--Main JS-->
<script src="assets/js/main.js"></script>
</body>

</html>