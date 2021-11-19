<?php
$homeConfig=array();
$homeConfig["imgPath"]="../IMG/";
    if(isset($_GET['commodity'])){
         //判断登入了没先不写
         //商品图片信息
         $imgrows=imgcurl();
         //商品详细说明
         $textrow=textcurl();

         //商品主要信息
         $detailmaintext=detailcurl();

         if ($detailmaintext =="-1"){
             //初始化数据
             $spId="null";
             $spVarieties="null";
             $spName="null";
             $spPrice="null";
             $spNum="null";
             $spImgpath="#";
             $spHot="null";
             $spSold="null";
             $spText="null";
             $xingxing="0%";
             $img=$homeConfig["imgPath"]."#";
             $star5="0";
         }else{
             //数据赋值
             foreach ($detailmaintext as $row){
                 $spId=$row["sp_uid"];  //id
                 $spVarieties=$row["sp_varieties"]; //分类
                 $spName=$row["sp_name"];     //名字
                 $spPrice=$row["sp_price"];     //价格
                 $spNum=$row["sp_num"];     //库存
                 $spImgpath=$row["sp_imgpath"];     //主图
                 $spHot=$row["sp_hot"];     //访问量  星级
                 $spSold=$row["sp_sold"];     //已卖出
                 $spText=$row["sp_text"];     //描述
                 $xingxing="0%";
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
         }

    }else{
        echo "<script>alert('非法操作！');
           location.href='index.php';</script>";
        exit;
    }

?>
<?php

function detailcurl(){
    $url="http://localhost:801/ShoppingDemo/controller/detailsService.php";
    $postdata=array();
    $postdata['commodity']=$_GET['commodity'];
    $postdata['tabletype']="shop_wares";
    $detailsmian=curl_post($url,$postdata);
    $detailsmian=JsonListisset($detailsmian);

    if ($detailsmian=="-1"){
        return -1;
    }else{
       return $detailsmian;
    }
}
function textcurl(){
    $url="http://localhost:801/ShoppingDemo/controller/waresTextService.php";
    $postdata=array();
    $postdata['commodity']=$_GET['commodity'];
    $textlist=curl_post($url,$postdata);
    $textlist=JsonListisset($textlist);
    if ($textlist=="-1"){
        return -1;
    }else{
        return $textlist;
    }
}
function imgcurl(){
    $url="http://localhost:801/ShoppingDemo/controller/waresImgService.php";
    $postdata=array();
    $postdata['commodity']=$_GET['commodity'];
    $postdata['tabletype']="shop_waresimg";
    $imglist=curl_post($url,$postdata);
    $imglist=JsonListisset($imglist);
    if ($imglist=="-1"){
        return -1;
    }else{
        return $imglist;
    }
}
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
    <title><?php echo$spName ;?>商品详情页面</title>
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
                <div class="col-md-12 col-lg-6 text-lg-start text-center">
                    <div class="header-top-msg-wrapper">
                        <p class="header-top-message">欢迎来到网上玩具商城</p>
                    </div>
                </div>
                <div class="col-12 col-sm-6 text-end d-none d-lg-block">
                    <div class="header-top-settings">
                        <ul class="nav align-items-center justify-content-end">

                        </ul>
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
                                <li><a href="index.php">主页</a></li>
                                <li><a href="shop.php">更多商品</a></li>
                                <li class="has-children position-static">
                                    <a href="#">Shop <i class="fa fa-angle-down"></i></a>
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
                                    <a href="#">Pages <i class="fa fa-angle-down"></i></a>
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
                                    <a href="#">Blog <i class="fa fa-angle-down"></i></a>
                                    <ul class="sub-menu">
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


<!-- Breadcrumb Section Start -->
<div class="section">

    <!-- Breadcrumb Area Start -->
    <div class="breadcrumb-area bg-primary">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li>
                        <a href="index.php"><i class="fa fa-home"></i> </a>
                    </li>
                    <li class="active"><?php echo $spName; ?></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End -->

</div>
<!-- Breadcrumb Section End -->

<!-- Single Product Section Start -->
<div class="section section-margin-top">
    <div class="container">

        <div class="row">
            <div class="col-lg-5 offset-lg-0 col-md-8 offset-md-2">

                <!-- Product Details Image Start -->
                <div class="product-details-img">

                    <!-- Single Product Image Start 主要图片 -->
                    <div class="single-product-img swiper-container product-gallery-top">
                        <div class="swiper-wrapper popup-gallery">
                            <a class="swiper-slide w-100" href="<?php echo $img; ?>">
                                <img class="w-100" src="<?php echo $img; ?>" >
                            </a>
                        </div>
                    </div>
                    <!-- Single Product Image End  -->

                    <!-- Single Product Thumb Start  辅助图片 -->
                    <div class="single-product-thumb swiper-container product-gallery-thumbs">

                        <div class="swiper-wrapper">

                            <div class="swiper-slide">
                                <img src="<?php echo $img; ?>" alt="Product">
                            </div>


                            <?php
                            if ($imgrows=="-1"){
                                $img1=$row["sp_imgpath"]="#";
                            }else{
                                foreach ($imgrows as $row){
                                    $img1=$homeConfig["imgPath"].$row["sp_Path"];
                                    ?>
                            <div class="swiper-slide">
                                <img src="<?php echo $img1; ?>" alt="Product">
                            </div>
                            <?php
                              }
                            }
                            ?>
                        </div>

                    </div>
                    <!-- Single Product Thumb End -->

                </div>
                <!-- Product Details Image End -->

            </div>
            <div class="col-lg-7">

                <!-- Product Summery Start -->
                <div class="product-summery position-relative">

                    <!-- Product Head Start -->
                    <div class="product-head mb-3">
                        <h2 class="product-title"><?php echo $spName ?></h2>
                    </div>
                    <!-- Product Head End -->

                    <!-- Rating Start -->
                    <span class="ratings justify-content-start mb-2">
                                <span class="rating-wrap">
                                    <span class="star" style="width: <?php echo $xingxing; ?>"></span>
                        </span>
                        <span class="rating-num"> 热门程度</span>
                        </span>
                    <!-- Rating End -->

                    <!-- Price Box Start -->
                    <div class="price-box mb-2">
                        <span class="regular-price">￥<?php echo $spPrice; ?></span>
                        <span class="old-price"><del>￥<?php echo $spPrice*1.3; ?> </del></span>
                    </div>
                    <!-- Price Box End -->

                    <!-- SKU Start -->
                    <div class="sku mb-3">
                        <span>商品标签: <?php echo $spVarieties  ;?></span>
                    </div>
                    <!-- SKU End -->

                    <!-- Product Inventory Start -->
                    <div class="product-inventroy mb-3">
                        <span class="inventroy-title"> <strong>库存:</strong></span>
                        <span class="inventory-varient"><?php echo $spNum ;?></span>
                    </div>
                    <!-- Product Inventory End -->

                    <!-- Description Start -->
                    <p class="desc-content mb-5">
                        <strong>产品描述： </strong> <?php echo $spText; ?>
                    </p>
                    <!-- Description End -->

                    <!-- Product Size Start -->
                    <div class="product-size mb-5">
                        <span><strong> </strong></span>
                        <a  class="size-ratio active"> </a>
                        <a  class="size-ratio"> </a>
                        <a  class="size-ratio"> </a>
                        <a  class="size-ratio"> </a>
                    </div>
                    <!-- Product Size End -->
                    <!-- Product Coler Variation Start -->
                    <div class="product-color-variation mb-5">
                        <span> <strong>颜色: </strong></span>
                        <button type="button" class="btn bg-danger"></button>
                        <button type="button" class="btn bg-primary"></button>
                        <button type="button" class="btn bg-dark"></button>
                        <button type="button" class="btn bg-success"></button>
                    </div>
                    <!-- Product Coler Variation End -->


                    <!-- Quantity Start -->
                    <div class="quantity d-flex align-items-center mb-5">
                        <span class="me-2"><strong>数量： </strong></span>
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
                            <a class="btn btn-dark btn-hover-primary" href="cart.html">添加到购物车</a>
                        </div>
                    </div>
                    <!-- Cart Button End -->

                    <!-- Action Button Start -->
                    <div class="actions border-bottom mb-4 pb-4">

                        <a title="Wishlist" class="action wishlist"><i class="pe-7s-like"></i>收藏</a>
                    </div>
                    <!-- Action Button End -->

                    <!-- Social Shear Start -->
                    <div class="social-share">
                        <span><strong>Social: </strong></span>
                        <a class="facebook-color"><i class="fa fa-facebook"></i> Like</a>
                        <a class="twitter-color"><i class="fa fa-twitter"></i> Tweet</a>
                        <a class="pinterest-color"><i class="fa fa-pinterest"></i> Save</a>
                    </div>
                    <!-- Social Shear End -->

                    <!-- Payment Option Start -->
                    <div class="payment-option mt-4 d-flex">
                        <span><strong>支付: </strong></span>
                        <a>
                            <img class="fit-image ms-1" src="assets/images/payment/payment.png" alt="Payment Option Image">
                        </a>
                    </div>
                    <!-- Payment Option End -->

                    <!-- Product Delivery Policy Start -->
                    <ul class="product-delivery-policy border-top pt-4 mt-4 border-bottom pb-4">
                        <li> <i class="fa fa-check-square"></i> <span>安全策略 Detailed security policy</span></li>
                        <li><i class="fa fa-truck"></i><span>交付政策 Delivery policy</span></li>
                        <li><i class="fa fa-refresh"></i><span>退货政策 return policy</span></li>
                    </ul>
                    <!-- Product Delivery Policy End -->

                </div>
                <!-- Product Summery End -->

            </div>
        </div>

        <div class="row section-margin">
            <!-- Single Product Tab Start -->
            <div class="col-lg-12 single-product-tab">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#connect-1" role="tab" aria-selected="true">商品详细描述</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#connect-2" role="tab" aria-selected="false">售后服务</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#connect-3" role="tab" aria-selected="false">运输政策</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="review-tab" data-bs-toggle="tab" href="#connect-4" role="tab" aria-selected="false">Size Chart</a>
                    </li>
                </ul>
                <div class="tab-content mb-text" id="myTabContent">
                    <div class="tab-pane fade show active" id="connect-1" role="tabpanel" aria-labelledby="home-tab">
                        <div class="desc-content p-3">
                            <p class="mb-3">
                               <?php
                                   if ($textrow=="-1"){
                                       $text00="该商品没有具体描述......";
                                   }else{
                                       foreach ($textrow as $row) {
                                           $text00 =$row["spuidtext"];
                                       }
                                   }
                                   ?>
                                <?php   echo $text00; ?>

                            </p>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="connect-2" role="tabpanel" aria-labelledby="profile-tab">
                        <!-- Start Single Content -->
                        <div class="product_tab_content border p-3">
                            <!-- Start Single Review -->
                            <div class="single-review d-flex mb-4">


                                <!-- Review Details Start -->
                                <div class="review_details">

                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin in viverra ex, vitae vestibulum arcu. Duis sollicitudin metus sed lorem commodo, eu dapibus libero interdum. Morbi convallis viverra erat, et aliquet orci congue vel. Integer in odio enim. Pellentesque in dignissim leo. Vivamus varius ex sit amet quam tincidunt iaculis.</p>
                                </div>
                                <!-- Review Details End -->

                            </div>
                            <!-- End Single Review -->

                            <!-- Rating Wrap Start -->
                            <div class="rating_wrap">
                                <h5 class="rating-title mb-2">7*24 在线服务 </h5>
                                <p class="mb-2">您好，遇到问题可以随时找我们，我们真诚的为您服务，祝您购物愉快。</p>
                                <h6 class="rating-sub-title mb-2">店铺总体星级</h6>

                                <!-- Rating Start -->
                                <span class="ratings justify-content-start mb-3">
                                            <span class="rating-wrap">
                                                <span class="star" style="width: 100%"></span>
                                    </span>
                                    <span class="rating-num">(5)</span>
                                    </span>
                                <!-- Rating End -->

                            </div>
                            <!-- Rating Wrap End -->



                        </div>
                        <!-- End Single Content -->
                    </div>
                    <div class="tab-pane fade" id="connect-3" role="tabpanel" aria-labelledby="contact-tab">
                        <!-- Shipping Policy Start -->
                        <div class="shipping-policy mb-n2 p-3">
                            <h4 class="title-3 mb-4">Shipping policy for our store</h4>
                            <p class="desc-content mb-2">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate</p>
                            <ul class="policy-list mb-2">
                                <li>1-2 business days (Typically by end of day)</li>
                                <li><a href="#">30 days money back guaranty</a></li>
                                <li>24/7 live support</li>
                                <li>odio dignissim qui blandit praesent</li>
                                <li>luptatum zzril delenit augue duis dolore</li>
                                <li>te feugait nulla facilisi.</li>
                            </ul>
                            <p class="desc-content mb-2">Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum</p>
                            <p class="desc-content mb-2">claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per</p>
                            <p class="desc-content mb-2">seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>
                        </div>
                        <!-- Shipping Policy End -->
                    </div>
                    <div class="tab-pane fade" id="connect-4" role="tabpanel" aria-labelledby="review-tab">
                        <div class="size-tab table-responsive-lg p-3">
                            <h4 class="title-3 mb-4">Size Chart</h4>
                            <table class="table border mb-0">
                                <tbody>
                                <tr>
                                    <td class="cun-name"><span>UK</span></td>
                                    <td>18</td>
                                    <td>20</td>
                                    <td>22</td>
                                    <td>24</td>
                                    <td>26</td>
                                </tr>
                                <tr>
                                    <td class="cun-name"><span>European</span></td>
                                    <td>46</td>
                                    <td>48</td>
                                    <td>50</td>
                                    <td>52</td>
                                    <td>54</td>
                                </tr>
                                <tr>
                                    <td class="cun-name"><span>usa</span></td>
                                    <td>14</td>
                                    <td>16</td>
                                    <td>18</td>
                                    <td>20</td>
                                    <td>22</td>
                                </tr>
                                <tr>
                                    <td class="cun-name"><span>Australia</span></td>
                                    <td>28</td>
                                    <td>10</td>
                                    <td>12</td>
                                    <td>14</td>
                                    <td>16</td>
                                </tr>
                                <tr>
                                    <td class="cun-name"><span>Canada</span></td>
                                    <td>24</td>
                                    <td>18</td>
                                    <td>14</td>
                                    <td>42</td>
                                    <td>36</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Single Product Tab End -->
        </div>

    </div>
</div>
<!-- Single Product Section End -->


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
                                    <div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->
                                    <div class="mailchimp-success text-success"></div><!-- mailchimp-success end -->
                                    <div class="mailchimp-error text-danger"></div><!-- mailchimp-error end -->
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
                        <p class="mb-0">Copyright &copy; 2021.Company name All rights reserved.<a target="_blank" >XXX版权所有</a></p>
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
                        <p class="desc-content mb-5">I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness.</p>
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