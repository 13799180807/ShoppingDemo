<?php

$homeConfig=array();
$homeConfig["imgPath"]="../IMG/";

//$salesGoods=homepageWares("sp_sold","5");//销量最高  火爆产品
$url="http://localhost:801/ShoppingDemo/controller/waresAllService.php?fltyqu=sp_sold&num=6";
$salesGoods=curl_get($url);
$salesGoods=JsonList($salesGoods);

//$hotGoods=homepageWares("sp_hot",6);  //热度排序  推荐
$url1="http://localhost:801/ShoppingDemo/controller/waresAllService.php?fltyqu=sp_hot&num=6";
$hotGoods=curl_get($url1);
$hotGoods=JsonList($hotGoods);

//$newestGoods=homepageWares("create_time",6);//最新上架
$url2="http://localhost:801/ShoppingDemo/controller/waresAllService.php?fltyqu=create_time&num=6";
$newestGoods=curl_get($url2);
$newestGoods=JsonList($newestGoods);





function JsonListisset($json){
    $json=json_decode($json,true);
    $dataisset=$json["datanum"];
    if($dataisset=="1"){
        $json=$json["data"];
        $json=$json["wareslist"];
        return $json;
    }else{
        return -1;
    }
}
function JsonList($json){
    $json=json_decode($json,true);
    $json=$json["data"];
    $list=$json["wareslist"];
    return $list;
}
function curl_get($url)
{
    $header = array(
        'Accept: application/json',
    );
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_TIMEOUT, 1);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    $data = curl_exec($curl);

    if (curl_error($curl)) {
        print "Error: " . curl_error($curl);
    } else {
        curl_close($curl);
        return $data;
    }
}
function curl_post( $url, $postdata ) {
    $header = array(
        'Accept: application/json',
    );
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, 10);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE );
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE );
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
    $data = curl_exec($curl);
    if (curl_error($curl)) {
        print "Error: " . curl_error($curl);
    } else {
        curl_close($curl);
        return $data;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>周边商城</title>
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link rel="stylesheet" href="assets/css/vendor/vendor.min.css">
    <link rel="stylesheet" href="assets/css/plugins/plugins.min.css">
    <link rel="stylesheet" href="assets/css/style.min.css">
</head>

<body>
    <!-- Header Section Start -->
    <div class="header section">

        <!-- Header Top Start -->
        <div class="header-top bg-primary">
            <div class="container">
                <div class="row align-items-center">

                    <!-- Header Top Message Start -->
                    <div class="col-12">
                        <div class="header-top-msg-wrapper text-center">
                            <p class="header-top-message text-center">
                                产品上新啦 <strong>快去选购</strong><a href="shop.html" class="btn btn-hover-dark btn-secondary">去购物吧</a></p>
                            <div class="header-top-close-btn">
                                <button class="top-close-btn"><i class="pe-7s-close"></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- Header Top Message End -->
                </div>
            </div>
        </div>
        <!-- Header Top End -->

        <!-- Header Bottom Start -->
        <div class="header-bottom">
            <div class="header-sticky">
                <div class="container">
                    <div class="row align-items-center position-relative">

                        <!-- Header Logo Start -->
                        <div class="col-md-6 col-lg-3 col-xl-2 col-6">
                            <div class="header-logo">
                                <a href="index.html"><img src="assets/images/logo/logo.png" alt="Site Logo" /></a>
                            </div>
                        </div>
                        <!-- Header Logo End -->

                        <!-- Header Menu Start -->
                        <div class="col-lg-6 d-none d-lg-block">

                            <div class="main-menu">
                                <ul>
                                    <li><a href="index.php">首页</a></li>
                                    <li><a href="shop.php">更多商品</a></li>
                                    <li class="has-children position-static">
                                        <a href="#">产品<i class="fa fa-angle-down"></i></a>
                                        <ul class="mega-menu row">
                                            <li class="col-3">
                                                <h4 class="mega-menu-title">Shop Layout</h4>
                                                <ul class="mb-n2">
                                                    <li><a href="shop.html">Shop Grid</a></li>
                                                    <li><a href="shop-left-sidebar.html">Left Sidebar</a></li>
                                                    <li><a href="shop-right-sidebar.html">Right Sidebar</a></li>
                                                    <li><a href="shop-list-fullwidth.html">List Fullwidth</a></li>
                                                    <li><a href="shop-list-left-sidebar.html">List Left Sidebar</a></li>
                                                    <li><a href="shop-list-right-sidebar.html">List Right Sidebar</a></li>
                                                </ul>
                                            </li>
                                            <li class="col-3">
                                                <h4 class="mega-menu-title">Product Layout</h4>
                                                <ul class="mb-n2">
                                                    <li><a href="single-product.html">Single Product</a></li>
                                                    <li><a href="single-product-sale.html">Single Product Sale</a></li>
                                                    <li><a href="single-product-group.html">Single Product Group</a></li>
                                                    <li><a href="single-product-normal.html">Single Product Normal</a></li>
                                                    <li><a href="single-product-affiliate.html">Single Product Affiliate</a></li>
                                                    <li><a href="single-product-slider.html">Single Product Slider</a></li>
                                                </ul>
                                            </li>
                                            <li class="col-3">
                                                <h4 class="mega-menu-title">Product Layout</h4>
                                                <ul class="mb-n2">
                                                    <li><a href="single-product-gallery-left.html">Gallery Left</a></li>
                                                    <li><a href="single-product-gallery-right.html">Gallery Right</a></li>
                                                    <li><a href="single-product-tab-style-left.html">Tab Style Left</a></li>
                                                    <li><a href="single-product-tab-style-right.html">Tab Style Right</a></li>
                                                    <li><a href="single-product-sticky-left.html">Sticky Left</a></li>
                                                    <li><a href="single-product-sticky-right.html">Sticky Right</a></li>
                                                </ul>
                                            </li>
                                            <li class="col-3">
                                                <h4 class="mega-menu-title">Other Pages</h4>
                                                <ul class="mb-n2">
                                                    <li><a href="my-account.html">My Account</a></li>
                                                    <li><a href="login.html">Loging | Register</a></li>
                                                    <li><a href="wishlist.html">Wishlist</a></li>
                                                    <li><a href="cart.html">Cart</a></li>
                                                    <li><a href="checkout.html">Checkout</a></li>
                                                    <li><a href="compare.html">Compare</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="has-children">
                                        <a href="#">页面 <i class="fa fa-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="about.html">About Us</a></li>
                                            <li><a href="contact.html">Contact Us</a></li>
                                            <li><a href="error-404.html">Error 404</a></li>
                                            <li><a href="faq.html">FAQ</a></li>
                                            <li><a href="login.html">Login</a></li>
                                            <li><a href="register.html">Register</a></li>
                                        </ul>
                                    </li>
                                    <li class="has-children">
                                        <a href="#">博客<i class="fa fa-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="blog.html">Blog</a></li>
                                            <li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
                                            <li><a href="blog-right-sidebar.html">Blog Right Sidebar</a></li>
                                            <li><a href="blog-details.html">Blog Details</a></li>
                                            <li><a href="blog-details-sidebar.html">Blog Details Sidebar</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="about.html">关于</a></li>
                                    <li><a href="contact.html">联系</a></li>
                                </ul>
                            </div>

                        </div>
                        <!-- Header Menu End -->

                        <!-- Header Action Start -->
                        <div class="col-md-6 col-lg-3 col-xl-4 col-6 justify-content-end">
                            <div class="header-actions">
                                <a href="javascript:void(0)" class="header-action-btn header-action-btn-search d-none d-lg-block"><i class="pe-7s-search"></i></a>
                                <div class="dropdown-user d-none d-lg-block">
                                    <a href="javascript:void(0)" class="header-action-btn"><i class="pe-7s-user"></i></a>
                                    <ul class="dropdown-menu-user">
                                        <li><a class="dropdown-item" href="#">Usd</a></li>
                                        <li><a class="dropdown-item" href="#">Pound</a></li>
                                        <li><a class="dropdown-item" href="#">Taka</a></li>
                                    </ul>
                                </div>
                                <a href="wishlist.html" class="header-action-btn header-action-btn-wishlist">
                                    <i class="pe-7s-like"></i>
                                </a>
                                <a href="javascript:void(0)" class="header-action-btn header-action-btn-cart">
                                    <i class="pe-7s-cart"></i>
                                    <span class="header-action-num">3</span>
                                </a>
                                <!-- Mobile Menu Hambarger Action Button Start -->
                                <a href="javascript:void(0)" class="header-action-btn header-action-btn-menu d-lg-none d-md-block">
                                    <i class="fa fa-bars"></i>
                                </a>
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

    <!-- Hero/Intro Slider Start -->
    <div class="section">
        <div class="hero-slider swiper-container">
            <div class="swiper-wrapper">

                <div class="hero-slide-item swiper-slide">
                    <div class="hero-slide-bg">
                        <img src="assets/images/slider/slider1-1.png" alt="Slider Image" />
                    </div>
                    <div class="container">
                        <div class="hero-slide-content">
                            <h2 class="title m-0">Get -30% off</h2>
                            <p>Latest baby product & toy collections.</p>
                            <a href="shop.html" class="btn btn-primary btn-hover-light">Shop Now</a>
                        </div>
                    </div>
                </div>

                <div class="hero-slide-item swiper-slide">
                    <div class="hero-slide-bg">
                        <img src="assets/images/slider/slider1-2.png" alt="Slider Image" />
                    </div>
                    <div class="container">
                        <div class="hero-slide-content">
                            <h2 class="title m-0"> New Arrivals <br />Get flat 50% off </h2>
                            <a href="shop.html" class="btn btn-primary btn-hover-light">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Swiper Pagination Start -->
            <div class="swiper-pagination d-lg-none"></div>
            <!-- Swiper Pagination End -->

            <!-- Swiper Navigation Start -->
            <div class="home-slider-prev swiper-button-prev main-slider-nav d-lg-flex d-none"><i class="pe-7s-angle-left"></i></div>
            <div class="home-slider-next swiper-button-next main-slider-nav d-lg-flex d-none"><i class="pe-7s-angle-right"></i></div>
            <!-- Swiper Navigation End -->
        </div>
    </div>
    <!-- Hero/Intro Slider End -->

    <!-- Banner Section Start -->
    <div class="section section-margin">
        <div class="container">
            <!-- Banners Start -->
            <div class="row mb-n6">

                <!-- Banner Start -->
                <div class="col-md-6 col-12 mb-6 pe-lg-2 pe-md-3">
                    <a href="shop.html" class="banner" data-aos="fade-up" data-aos-delay="200">
                        <img src="assets/images/banner/1.png" alt="Banner Image" />
                    </a>
                </div>
                <!-- Banner End -->

                <!-- Banner Start -->
                <div class="col-md-6 col-12 mb-6 ps-lg-2 ps-md-3">
                    <a href="shop.html" class="banner" data-aos="fade-up" data-aos-delay="400">
                        <img src="assets/images/banner/2.png" alt="Banner Image" />
                    </a>
                </div>
                <!-- Banner End -->

            </div>
            <!-- Banners End -->
        </div>
    </div>
    <!-- Banner Section End -->

    <!-- Product Section Start -->
    <div class="section section-margin mt-0 position-relative">
        <div class="container">
            <!-- Section Title & Tab Start -->
            <div class="row mb-lg-8 mb-6">
                <!-- Section Title Start -->
                <div class="col-lg col-12">
                    <div class="section-title mb-0 text-center" data-aos="fade-up" data-aos-delay="200">
                        <h2 class="title mb-2">最新系列</h2>
                        <p>将特色产品添加到每周阵容</p>
                    </div>
                </div>
                <!-- Section Title End -->
            </div>
            <!-- Section Title & Tab End -->
            <!-- Products Tab Start -->
            <div class="row">
                <div class="col" data-aos="fade-up" data-aos-delay="600">
                    <div class="product-carousel arrow-outside-container">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <!--开始 -->
                                <?php
                                foreach ( $newestGoods as $row){
                                      if ($row["sp_uid"] ==""){
                                          $row["sp_name"]="虚拟物品";
                                          $row["sp_price"]="？？？";
                                          $img=$row["sp_imgpath"]="#";
                                      }else{
                                          $img=$homeConfig["imgPath"].$row["sp_imgpath"];
                                      }
                                      ?>
                                <div class="swiper-slide">
                                    <div class="product-wrapper">
                                        <div class="product mb-6">
                                            <div class="thumb">
                                                <!--照片-->
                                                <a href="single-product.php?commodity=<?php echo $row["sp_uid"]; ?>" class="image">
                                                  <img class="fit-image" src="<?php echo $img; ?>" alt="Product" />
                                                </a>
                                                <!--照片结束-->
                                                <div class="actions">
                                                    <a  class="action wishlist"><i class="pe-7s-like"></i></a>
                                                    <a  class="action compare"><i class="pe-7s-refresh-2"></i></a>
                                                    <a  class="action quickview" data-bs-toggle="modal" data-bs-target="#quick-view"><i class="pe-7s-search"></i></a>
                                                </div>
                                                <!--添加到购物车-->
                                                <div class="add-cart-btn">
                                                    <button class="btn btn-whited btn-hover-primary text-capitalize add-to-cart">添加到购物车</button>
                                                </div>
                                                <!--添加到购物车结束-->
                                            </div>
                                            <div class="content">
                                                <h5 class="title">
                                                    <a href="single-product.php?commodity=<?php echo $row["sp_uid"]; ?>">
                                                        <?php echo $row["sp_name"] ?>
                                                    </a>
                                                </h5>
                                                <span class="price">
                                                    <span class="new">
                                                        ￥<?php echo $row["sp_price"] ?>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--结束 -->
                                <?php } ?>
                            </div>
                            <div class="swiper-pagination d-block d-md-none"></div>
                            <div class="swiper-button-prev swiper-nav-button d-none d-md-flex"><i class="pe-7s-angle-left"></i></div>
                            <div class="swiper-button-next swiper-nav-button d-none d-md-flex"><i class="pe-7s-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Products Tab End -->
        </div>

        <div class="add-cart-btn" style="margin-left: 45%">
            <a href="#"> <button class="btn btn-whited btn-hover-primary text-capitalize add-to-cart">查看更多分类</button></a>
        </div>
    </div>
    <!-- Product Section End -->

    <!-- Testimonial Section Start -->
    <div class="section testimonial-bg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Section Title Start -->
                    <div class="section-title text-center" data-aos="fade-up" data-aos-delay="200">
                        <h2 class="title text-white">Testimonials</h2>
                        <p class="sub-title text-white">What they say</p>
                    </div>
                    <!-- Section Title End -->

                    <!-- Testimonial Carousel Start -->
                    <div class="testimonial-carousel" data-aos="fade-up" data-aos-delay="400">
                        <div class="swiper-container testimonial-gallery-thumbs">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="assets/images/testimonial/thumb-1.png" alt="Product Image">
                                </div>
                                <div class="swiper-slide">
                                    <img src="assets/images/testimonial/thumb-2.png" alt="Product Image">
                                </div>
                                <div class="swiper-slide">
                                    <img src="assets/images/testimonial/thumb-3.png" alt="Product Image">
                                </div>
                                <div class="swiper-slide">
                                    <img src="assets/images/testimonial/thumb-4.png" alt="Product Image">
                                </div>
                            </div>
                        </div>
                        <div class="swiper-container testimonial-gallery-top">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <!-- Testimonial Content Start -->
                                    <div class="testimonial-content text-center">
                                        <p>Vivamus a lobortis ipsum, vel condimentum magna. Etiam id turpis tortor. Nunc scelerisque, nisi a blandit varius, nunc purus venenatis ligula, sed venenatis orci augue nec sapien. Cum sociis natoque</p>
                                        <span class="ratings justify-content-center mb-3">
												<span class="rating-wrap text-white">
													<span class="star text-warning" style="width: 80%"></span>
                                        </span>
                                        <span class="rating-num text-light">(3)</span>
                                        </span>
                                        <h4 class="testimonial-author mb-0">Anamika lusy</h4>
                                    </div>
                                    <!-- Testimonial Content End -->
                                </div>
                                <div class="swiper-slide">
                                    <!-- Testimonial Content Start -->
                                    <div class="testimonial-content text-center">
                                        <p>Vivamus a lobortis ipsum, vel condimentum magna. Etiam id turpis tortor. Nunc scelerisque, nisi a blandit varius, nunc purus venenatis ligula, sed venenatis orci augue nec sapien. Cum sociis natoque</p>
                                        <span class="ratings justify-content-center mb-3">
												<span class="rating-wrap text-white">
													<span class="star text-warning" style="width: 80%"></span>
                                        </span>
                                        <span class="rating-num text-light">(3)</span>
                                        </span>
                                        <h4 class="testimonial-author mb-0">Tinsy Nilom</h4>
                                    </div>
                                    <!-- Testimonial Content End -->
                                </div>
                                <div class="swiper-slide">
                                    <!-- Testimonial Content Start -->
                                    <div class="testimonial-content text-center">
                                        <p>Vivamus a lobortis ipsum, vel condimentum magna. Etiam id turpis tortor. Nunc scelerisque, nisi a blandit varius, nunc purus venenatis ligula, sed venenatis orci augue nec sapien. Cum sociis natoque</p>
                                        <span class="ratings justify-content-center mb-3">
												<span class="rating-wrap text-white">
													<span class="star text-warning" style="width: 80%"></span>
                                        </span>
                                        <span class="rating-num text-light">(3)</span>
                                        </span>
                                        <h4 class="testimonial-author mb-0">Cristal Aryan</h4>
                                    </div>
                                    <!-- Testimonial Content End -->
                                </div>
                                <div class="swiper-slide">
                                    <!-- Testimonial Content Start -->
                                    <div class="testimonial-content text-center">
                                        <p>Vivamus a lobortis ipsum, vel condimentum magna. Etiam id turpis tortor. Nunc scelerisque, nisi a blandit varius, nunc purus venenatis ligula, sed venenatis orci augue nec sapien. Cum sociis natoque</p>
                                        <span class="ratings justify-content-center mb-3">
												<span class="rating-wrap text-white">
													<span class="star text-warning" style="width: 80%"></span>
                                        </span>
                                        <span class="rating-num text-light">(3)</span>
                                        </span>
                                        <h4 class="testimonial-author mb-0">Jems Jhon</h4>
                                    </div>
                                    <!-- Testimonial Content End -->
                                </div>
                            </div>
                            <!-- Add Arrows -->
                            <div class="swiper-button-next swiper-button-white d-none"></div>
                            <div class="swiper-button-prev swiper-button-white d-none"></div>
                        </div>
                    </div>
                    <!-- Testimonial Carousel End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial Section End -->

    <!-- Product List Banner Section Start -->
    <div class="section section-padding">
        <div class="container">
            <div class="row mb-n6">
                <!-- Banner Start -->
                <div class="col-lg-4 col-md-12 col-12 mb-6">
                    <div class="banner" data-aos="fade-up" data-aos-delay="200">
                        <a href="shop.html"><img src="assets/images/banner/3.png" alt="Banner Image" /></a>
                    </div>
                </div>
                <!-- Banner End -->
                <!-- Product List End -->
                <!---左边的了--->
                <!-- Product List Start -->
                <div class="col-lg-4 col-md-6 col-12 mb-6">

                    <!-- Product List Wrapper Start -->
                    <div class="product-list-wrapper" data-aos="fade-up" data-aos-delay="600">

                        <!-- Product List Title Start -->
                        <div class="product-list-title mb-5">
                            <h4 class="title">推荐产品</h4>
                        </div>
                        <!-- Product List Title End -->
                        <!-- Product List Carousel Start -->
                        <div class="product-list-carousel-2">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <?php
                                        foreach ( $hotGoods as $row){
                                            $img=$homeConfig["imgPath"].$row["sp_imgpath"];
                                            if ($row["sp_uid"] ==""){
                                                $row["sp_name"]="虚拟物品,等待添加";
                                                $row["sp_price"]="？？？";
                                                $img=$row["sp_imgpath"]="#";
                                                $xingxing="0%";
                                            }else{
                                                $img=$homeConfig["imgPath"].$row["sp_imgpath"];
                                                $star5=$row["sp_hot"];
                                                if ($star5>=9){
                                                    $xingxing="100%";
                                                }elseif ($star5>=6){
                                                    $xingxing="80%";
                                                }elseif ($star5>=3){
                                                    $xingxing="60%";
                                                }else{
                                                    $xingxing="40%";
                                                }
                                            }

                                            ?>
                                            <div class="single-product-list mb-4">
                                                <div class="product">
                                                    <div class="thumb">
                                                        <a href="single-product.php?commodity=<?php echo $row["sp_uid"]; ?>" class="image">
                                                            <img class="fit-image first-image" src="<?php echo $img; ?>" alt="Product Image">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product-list-content">
                                                    <h6 class="product-name">
                                                        <a href="single-product.php?commodity=<?php echo $row["sp_uid"]; ?>"><?php echo $row["sp_name"] ?></a>
                                                    </h6>
                                                    <span class="ratings justify-content-start mb-3">
														<span class="rating-wrap">
															<span class="star" style="width: <?php echo $xingxing; ?>"></span>
                                                </span>
                                                <span class="rating-num"> </span>
                                                </span>
                                                    <span class="price">
														<span class="new">$<?php echo $row["sp_price"] ?></span>
                                                </span>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <!-- Swiper Pagination Start -->
                                <div class="swiper-pagination d-none"></div>
                                <!-- Swiper Pagination End -->
                                <!-- Next Previous Button Start -->
                                <div class="swiper-product-list-next swiper-button-next"><i class="pe-7s-angle-right"></i></div>
                                <div class="swiper-product-list-prev swiper-button-prev"><i class="pe-7s-angle-left"></i></div>
                                <!-- Next Previous Button End -->
                            </div>
                        </div>
                        <!-- Product List Carousel End -->

                    </div>
                    <!-- Product List Wrapper End -->
                </div>
                <!-- Product List End -->

                <!-- Product List End -->
                <!---右边的了--->
                <!-- Product List Start -->
                <div class="col-lg-4 col-md-6 col-12 mb-6">

                    <!-- Product List Wrapper Start -->
                    <div class="product-list-wrapper" data-aos="fade-up" data-aos-delay="600">

                        <!-- Product List Title Start -->
                        <div class="product-list-title mb-5">
                            <h4 class="title">销量最高</h4>
                        </div>
                        <!-- Product List Title End -->
                        <!-- Product List Carousel Start -->
                        <div class="product-list-carousel-2">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <?php
                                        foreach ( $salesGoods as $row){
                                        $img=$homeConfig["imgPath"].$row["sp_imgpath"];
                                            if ($row["sp_uid"] ==""){
                                                $row["sp_name"]="虚拟物品,等待添加";
                                                $row["sp_price"]="？？？";
                                                $img=$row["sp_imgpath"]="#";
                                                $xingxing="0%";
                                            }else{
                                                $img=$homeConfig["imgPath"].$row["sp_imgpath"];
                                                $star5=$row["sp_hot"];
                                                if ($star5>=9){
                                                    $xingxing="100%";
                                                }elseif ($star5>=6){
                                                    $xingxing="80%";
                                                }elseif ($star5>=3){
                                                    $xingxing="60%";
                                                }else{
                                                    $xingxing="40%";
                                                }
                                            }


                                        ?>
<!--                                         Single Product List Start-->
                                        <div class="single-product-list mb-4">
                                            <div class="product">
                                                <div class="thumb">
                                                    <a href="single-product.php?commodity=<?php echo $row["sp_uid"]; ?>" class="image">
                                                        <img class="fit-image first-image" src="<?php echo $img; ?>" alt="Product Image">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-list-content">
                                                <h6 class="product-name">
                                                    <a href="single-product.php?commodity=<?php echo $row["sp_uid"]; ?>"><?php echo $row["sp_name"] ?></a>
                                                </h6>
                                                <span class="ratings justify-content-start mb-3">
														<span class="rating-wrap">
															<span class="star" style="width: <?php echo $xingxing; ?>"></span>
                                                </span>
                                                <span class="rating-num"></span>
                                                </span>
                                                <span class="price">
														<span class="new">$<?php echo $row["sp_price"] ?></span>
                                                </span>
                                            </div>
                                        </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <!-- Swiper Pagination Start -->
                                <div class="swiper-pagination d-none"></div>
                                <!-- Swiper Pagination End -->
                                <!-- Next Previous Button Start -->
                                <div class="swiper-product-list-next swiper-button-next"><i class="pe-7s-angle-right"></i></div>
                                <div class="swiper-product-list-prev swiper-button-prev"><i class="pe-7s-angle-left"></i></div>
                                <!-- Next Previous Button End -->
                            </div>
                        </div>
                        <!-- Product List Carousel End -->

                    </div>
                    <!-- Product List Wrapper End -->
                </div>
                <!-- Product List End -->

            </div>
        </div>
    </div>
    <!-- Product List Banner Section End -->

    <!-- Latest Blog Section Start -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <!-- Section Title Start -->
                    <div class="section-title text-center" data-aos="fade-up" data-aos-delay="300">
                        <h2 class="title">Testimonials</h2>
                        <p class="sub-title">What they say</p>
                    </div>
                    <!-- Section Title End -->

                    <!-- Latest Blog Carousel Start -->
                    <div class="latest-blog-carousel arrow-outside-container" data-aos="fade-up" data-aos-delay="600">
                        <div class="swiper-container">

                            <div class="swiper-wrapper">

                                <div class="swiper-slide">
                                    <!-- Single Blog Start -->
                                    <div class="single-blog">
                                        <!-- Blog Thumb Start -->
                                        <div class="blog-thumb">
                                            <a href="blog-details.html">
                                                <img class="fit-image" src="assets/images/blog/blog-medium/1.jpg" alt="Blog Image">
                                            </a>
                                        </div>
                                        <!-- Blog Thumb End -->
                                        <!-- Blog Content Start -->
                                        <div class="blog-content">
                                            <div class="blog-meta">
                                                <p>03/11/2021 | <span>Admin</span></p>
                                            </div>
                                            <h5 class="blog-title">
                                                <a href="blog-details.html">It is a long established fact that a reader will be distracted</a>
                                            </h5>
                                        </div>
                                        <!-- Blog Content End -->
                                    </div>
                                    <!-- Single Blog End -->
                                </div>

                                <div class="swiper-slide">
                                    <!-- Single Blog Start -->
                                    <div class="single-blog">
                                        <!-- Blog Thumb Start -->
                                        <div class="blog-thumb">
                                            <a href="blog-details.html">
                                                <img class="fit-image" src="assets/images/blog/blog-medium/2.jpg" alt="Blog Image">
                                            </a>
                                        </div>
                                        <!-- Blog Thumb End -->
                                        <!-- Blog Content Start -->
                                        <div class="blog-content">
                                            <div class="blog-meta">
                                                <p>03/11/2021 | <span>Admin</span></p>
                                            </div>
                                            <h5 class="blog-title">
                                                <a href="blog-details.html">There are many variations of passages of lorem ipsum</a>
                                            </h5>
                                        </div>
                                        <!-- Blog Content End -->
                                    </div>
                                    <!-- Single Blog End -->
                                </div>

                                <div class="swiper-slide">
                                    <!-- Single Blog Start -->
                                    <div class="single-blog">
                                        <!-- Blog Thumb Start -->
                                        <div class="blog-thumb">
                                            <a href="blog-details.html">
                                                <img class="fit-image" src="assets/images/blog/blog-medium/3.jpg" alt="Blog Image">
                                            </a>
                                        </div>
                                        <!-- Blog Thumb End -->
                                        <!-- Blog Content Start -->
                                        <div class="blog-content">
                                            <div class="blog-meta">
                                                <p>03/11/2021 | <span>Admin</span></p>
                                            </div>
                                            <h5 class="blog-title">
                                                <a href="blog-details.html">The standard chunk of lorem ipsum used since</a>
                                            </h5>
                                        </div>
                                        <!-- Blog Content End -->
                                    </div>
                                    <!-- Single Blog End -->
                                </div>

                            </div>

                            <!-- Swiper Pagination Start -->
                            <div class="swiper-pagination d-block d-md-none"></div>
                            <!-- Swiper Pagination End -->

                            <!-- Next Previous Button Start -->
                            <div class="swiper-blog-button-next swiper-button-next swiper-nav-button d-none d-md-flex"><i class="pe-7s-angle-right"></i></div>
                            <div class="swiper-blog-button-prev swiper-button-prev swiper-nav-button d-none d-md-flex"><i class="pe-7s-angle-left"></i></div>
                            <!-- Next Previous Button End -->
                        </div>
                    </div>
                    <!-- Latest Blog Carousel End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Latest Blog Section End -->

    <!-- Brand Logo Section Start -->
    <div class="section section-margin">
        <div class="container">
            <div class="border-top border-bottom">
                <div class="row">
                    <div class="col-12" data-aos="fade-up" data-aos-delay="200">
                        <!-- Brand Logo Wrapper Start -->
                        <div class="brand-logo-carousel arrow-outside-container">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">

                                    <!-- Single Brand Logo Start -->
                                    <div class="swiper-slide single-brand-logo">
                                        <a href="#"><img src="assets/images/brand-logo/1.png" alt="Brand Logo"></a>
                                    </div>
                                    <!-- Single Brand Logo End -->

                                    <!-- Single Brand Logo Start -->
                                    <div class="swiper-slide single-brand-logo">
                                        <a href="#"><img src="assets/images/brand-logo/2.png" alt="Brand Logo"></a>
                                    </div>
                                    <!-- Single Brand Logo End -->

                                    <!-- Single Brand Logo Start -->
                                    <div class="swiper-slide single-brand-logo">
                                        <a href=""><img src="assets/images/brand-logo/3.png" alt="Brand Logo"></a>
                                    </div>
                                    <!-- Single Brand Logo End -->

                                    <!-- Single Brand Logo Start -->
                                    <div class="swiper-slide single-brand-logo">
                                        <a href="#"><img src="assets/images/brand-logo/4.png" alt="Brand Logo"></a>
                                    </div>
                                    <!-- Single Brand Logo End -->

                                    <!-- Single Brand Logo Start -->
                                    <div class="swiper-slide single-brand-logo">
                                        <a href="#"><img src="assets/images/brand-logo/5.png" alt="Brand Logo"></a>
                                    </div>
                                    <!-- Single Brand Logo End -->

                                    <!-- Single Brand Logo Start -->
                                    <div class="swiper-slide single-brand-logo">
                                        <a href="#"><img src="assets/images/brand-logo/6.png" alt="Brand Logo"></a>
                                    </div>
                                    <!-- Single Brand Logo End -->

                                </div>

                                <!-- Swiper Pagination Start -->
                                <div class="swiper-pagination d-none"></div>
                                <!-- Swiper Pagination End -->

                                <!-- Next Previous Button Start -->
                                <div class="swiper-logo-button-next swiper-button-next swiper-nav-button d-none d-md-flex"><i class="pe-7s-angle-right"></i></div>
                                <div class="swiper-logo-button-prev swiper-button-prev swiper-nav-button d-none d-md-flex"><i class="pe-7s-angle-left"></i></div>
                                <!-- Next Previous Button End -->
                            </div>
                        </div>
                        <!-- Brand Logo Wrapper End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Brand Logo Section End -->

    <!-- Footer Section Start -->
    <footer class="section footer-section">
        <!-- Footer Top Start -->
        <div class="footer-top bg-primary section-padding">
            <div class="container">
                <div class="row mb-n8">
                    <div class="col-12 col-sm-6 col-lg-3 mb-8">
                        <div class="single-footer-widget">
                            <h1 class="widget-title">About Us</h1>
                            <p class="desc-content">We are a team of designers and developers that create high quality wordpress, shopify, Opencart</p>
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
                                <li><i class="pe-7s-home"></i> <span>Your address goes here</span> </li>
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
                                        <input type="email" id="mc-email" class="form-control email-box mb-4" placeholder="demo@example.com" name="EMAIL">
                                        <button id="mc-submit" class="newsletter-btn" type="submit">Subscribe</button>
                                    </form>
                                    <!-- mailchimp-alerts Start -->
                                    <div class="mailchimp-alerts text-centre">
                                        <div class="mailchimp-submitting"></div>
                                        <!-- mailchimp-submitting end -->
                                        <div class="mailchimp-success text-success"></div>
                                        <!-- mailchimp-success end -->
                                        <div class="mailchimp-error text-danger"></div>
                                        <!-- mailchimp-error end -->
                                    </div>
                                    <!-- mailchimp-alerts end -->
                                </div>
                                <!-- Newsletter Form End -->
                                <p class="desc-content mb-0">Join over 1,000 people who get free and fresh content delivered automatically each time we publish</p>
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
                            <p class="mb-0">Copyright &copy; 2021.Company name All rights reserved</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Bottom End -->
    </footer>
    <!-- Footer Section End -->


    <!-- Modal Start  -->
    <div class="modalquickview modal fade" id="quick-view" tabindex="-1" aria-labelledby="quick-view" role="dialog" aria-hidden="true">
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
                                <div class="swiper-product-button-next swiper-button-next"><i class="pe-7s-angle-right"></i></div>
                                <div class="swiper-product-button-prev swiper-button-prev"><i class="pe-7s-angle-left"></i></div>
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
                            <p class="desc-content mb-5">I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the
                                master-builder of human happiness.</p>
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
                                <a href="compare.html" title="Compare" class="action compare"><i class="pe-7s-refresh-2"></i> Compare</a>
                                <a href="wishlist.html" title="Wishlist" class="action wishlist"><i class="pe-7s-like"></i> Wishlist</a>
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
                                    <img class="fit-image ms-1" src="assets/images/payment/payment.png" alt="Payment Option Image">
                                </a>
                            </div>
                            <!-- Payment Option End -->

                            <!-- Product Delivery Policy Start -->
                            <ul class="product-delivery-policy border-top pt-4 mt-4 border-bottom pb-4">
                                <li> <i class="fa fa-check-square"></i> <span>Security Policy (Edit With Customer Reassurance Module)</span></li>
                                <li><i class="fa fa-truck"></i><span>Delivery Policy (Edit With Customer Reassurance Module)</span></li>
                                <li><i class="fa fa-refresh"></i><span>Return Policy (Edit With Customer Reassurance Module)</span></li>
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
                                    <li><a href="my-account.html">My Account</a></li>
                                    <li><a href="login.html">Loging | Register</a></li>
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
                            <button class="dropdown-toggle" data-bs-toggle="dropdown">English <i class="fa fa-angle-down"></i></button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a class="dropdown-item" href="#">English</a></li>
                                <li><a class="dropdown-item" href="#">Japanese</a></li>
                                <li><a class="dropdown-item" href="#">Arabic</a></li>
                                <li><a class="dropdown-item" href="#">Romanian</a></li>
                            </ul>
                        </div>
                        <div class="header-top-curr dropdown">
                            <h4 class="title">Currency:</h4>
                            <button class="dropdown-toggle" data-bs-toggle="dropdown">USD <i class="fa fa-angle-down"></i></button>
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
                        <li><i class="fa fa-clock-o"></i> <span>Monday - Sunday 9.00 - 18.00</span> </li>
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
    <!-- Plugins JS -->
    <!-- Use the minified version files listed below for better performance and remove the files listed above -->

    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/plugins.min.js"></script>

    <!--Main JS-->
    <script src="assets/js/main.js"></script>
</body>

</html>