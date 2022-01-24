<?php
require 'curl.php';
require 'config.php';

$name = "";
$phone = "";
$payPwd = "";
$add = false;

if (isset($_COOKIE['token'])) {
    $loginStatus = userStatus();
    if (!$loginStatus[0]) {
        echo "<script>alert('当前登入过期了！！！');location.href='login.php'</script>";
        exit;
    }
} else {
    echo "<script>alert('当前未登入！！！');location.href='login.php'</script>";
    exit;
}

$userAccount = $_COOKIE['user'];
$token = $_COOKIE['token'];

if (isset($_POST['save'])) {
    $add = true;
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $payPwd = $_POST['payPwd'];
    /** 检测用户名 */
    if ($name == "") {
        $add = false;
        echo "<script>alert('名字不能为空！！！');</script>";
    } else {
        if (mb_strlen($name) >= 2 && mb_strlen($name) <= 10) {
            $add = true;
        } else {
            $add = false;
            echo "<script>alert('名字请在2-10之间！！！');</script>";
        }
    }
    /** 检验手机号码 */
    if (matchPhone($phone)) {
        $add = true;
    } else {
        $add = false;
        echo "<script>alert('请输入正确手机号！！！');</script>";
    }
    /** 检测密码 */
    $isMatched = preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,16}$/', $payPwd, $matches);
    if ($isMatched == 1) {
        $add = true;
    } else {
        $add = false;
        echo "<script>alert('密码格式不正确，必须包含大小写字母和数字的组合，不能使用特殊字符，长度在 6-16 之间！！！');</script>";
    }


}
if ($add) {
    $res = curl_post("http://localhost:8080/home/user/AddInformation", array(
        'account' => $userAccount,
        'token' => $token,
        'userName' => $name,
        'userPhone' => $phone,
        'payPwd' => $payPwd
    ));
    $resArr = json_decode($res, true);
    if ($resArr['code'] == 200) {
        echo "<script>alert('补充成功，正在前往个人信息中心！！！');location.href='my-account.php'</script>";
        exit;
    } else {
        $msg = $resArr['msg'];
        echo "<script>alert('{$msg}！！！');</script>";
    }


}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>您当前为首次登入请补全信息</title>
    <!-- Favicons -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- Vendor CSS (Icon Font) -->
    <link rel="stylesheet" href="assets/css/vendor/vendor.min.css">
    <link rel="stylesheet" href="assets/css/plugins/plugins.min.css">
    <link rel="stylesheet" href="assets/css/style.min.css">
</head>

<body>
<!-- Breadcrumb Section Start -->
<div class="section">

    <!-- Breadcrumb Area Start -->
    <div class="breadcrumb-area bg-primary">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li class="active"><a href="exitLogin.php">暂时不想补充了；点击退出</a></li>
                </ul>
                <ul>
                    <li class="active">您当前为首次登入请补全信息</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End -->
</div>
<!-- Breadcrumb Section End -->

<!-- Login Section Start -->
<div class="section section-margin">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-8 m-auto">
                <div class="login-wrapper">
                    <!-- Login Title & Content Start -->
                    <div class="section-content text-center mb-5">
                        <h2 class="title mb-2">请补全信息</h2>
                        <p class="desc-content">请认真输入以下信息.</p>
                    </div>
                    <!-- Login Title & Content End -->
                    <!-- Form Action Start -->
                    <form action="firstLogin.php" method="post">

                        <!-- Input Email Start -->
                        <div class="single-input-item mb-3">
                            <input type="text" value="<?php echo $name; ?>" name="name" placeholder="您的名字">
                        </div>
                        <div class="single-input-item mb-3">
                            <input type="text" value="<?php echo $phone; ?>" name="phone" placeholder="您的电话">
                        </div>
                        <!-- Input Password Start -->
                        <div class="single-input-item mb-3">
                            <input type="password" name="payPwd" value="<?php echo $payPwd; ?>"
                                   placeholder="请输入6-16为支付密码">
                        </div>
                        <!-- Input Password End -->
                        <!-- Login Button Start -->
                        <div class="single-input-item mb-3">
                            <button class="btn btn-group-vertical btn-hover-primary rounded-0" name="save">提交信息</button>
                        </div>
                        <!-- Login Button End -->
                    </form>
                    <!-- Form Action End -->

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login Section End -->

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