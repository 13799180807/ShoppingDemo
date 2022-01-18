<?php
require 'curl.php';
require 'config.php';
$account = "";
$pwd = "";
$yzm = "";

if (isset($_COOKIE['token'])) {
    $loginStatus = userStatus();
    if ($loginStatus[0]) {
        echo "<script>alert('当前已经登入了！！！');location.href='index.php'</script>";
        exit;
    } else {
        echo "<script>alert('当前登入过期了！！！');location.href='login.php'</script>";
        exit;
    }
}

if (isset($_POST['login'])) {
    $account = $_POST['account'];
    $yzm = $_POST['yzm'];
    if (isset($_POST['agree'])) {
        $res = curl_post("http://localhost:8080/home/user/login", array(
            'account' => $account,
            'pwd' => $_POST['pwd']
        ));
        $loginRes = json_decode($res, true);

        if ($loginRes['code'] == 200) {
            $data = $loginRes['data'];
            if (count($data) > 0) {
                /** 登入成功 */
                setcookie("token", $data['token'], time() + 3600);
                setcookie("user", $data['account'], time() + 3600);
                echo "<script>alert('登入成功！！！');location.href='index.php'</script>";
                exit;
            }
            echo "<script>alert('{$data['msg']}');</script>";

        } else {
            /** 登入失败 */
            echo "<script>alert('{$loginRes['msg']}');</script>";
        }

    } else {
        echo "<script>alert('请同意该协议！！！');</script>";
    }


}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>购物商城登录</title>
    <!-- Favicons -->
    <link href="assets/images/favicon.ico" rel="shortcut icon">
    <link href="assets/css/vendor/vendor.min.css" rel="stylesheet">
    <link href="assets/css/plugins/plugins.min.css" rel="stylesheet">
    <link href="assets/css/style.min.css" rel="stylesheet">
</head>

<body>

<!-- Header Section Start -->
<div class="header section">


    <!-- Header Bottom Start -->
    <div class="header-bottom">
        <div class="header-sticky">
            <div class="container">
                <div class="row align-items-center position-relative">

                    <!-- Header Logo Start -->
                    <div class="col-md-6 col-lg-3 col-xl-2 col-6">
                        <div class="header-logo">
                            <a href="index.php"><img alt="Site Logo" src="assets/images/logo/logo.png"/></a>
                        </div>
                    </div>
                    <!-- Header Logo End -->

                    <!-- Header Menu Start -->
                    <div class="col-lg-6 d-none d-lg-block">
                        <div class="main-menu">
                            <ul>
                                <li><a href="index.php">首页</a></li>
                                <li><a href="shop.php">更多商品</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Header Menu End -->

                    <!-- Header Action Start -->
                    <div class="col-md-6 col-lg-3 col-xl-4 col-6 justify-content-end">
                        <div class="header-actions">
                            <a class="header-action-btn header-action-btn-search d-none d-lg-block"
                               href="javascript:void(0)"><i
                                        class="pe-7s-search"></i></a>
                            <div class="dropdown-user d-none d-lg-block">
                                <a class="header-action-btn" href="javascript:void(0)"><i class="pe-7s-user"></i></a>
                                <ul class="dropdown-menu-user">
                                    <li><a class="dropdown-item">未登入</a></li>
                                    <li><a class="dropdown-item" href="#">注册</a></li>
                                </ul>
                            </div>

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
            <form action="lookup.php" class="offcanvas-search-form" method="post">
                <input class="offcanvas-search-input" name="lookupName" placeholder="Search Product..." type="text">
            </form>
            <!-- Offcanvas Search Form End -->
        </div>
    </div>
    <!-- Offcanvas Search End -->
</div>
<!-- Header Section End -->


<!-- Login Section Start -->
<div class="section section-margin">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-8 m-auto">
                <div class="login-wrapper">

                    <!-- Login Title & Content Start -->
                    <div class="section-content text-center mb-5">
                        <h2 class="title mb-2">登入</h2>
                        <p class="desc-content">请使用下面的帐户详细信息登录.</p>
                    </div>
                    <!-- Login Title & Content End -->


                    <!-- Form Action Start -->
                    <form action="login.php" method="POST" enctype="multipart/form-data">

                        <!-- Input account Start -->
                        <div class="single-input-item mb-3">
                            <input name="account" onblur="reg()" placeholder="请输入你的账号" id="account"
                                   value="<?php echo $account; ?>"
                                   type="text">
                        </div>
                        <!-- Input account End -->

                        <!-- Input Password Start -->
                        <div class="single-input-item mb-3">
                            <input name="pwd" onblur="reg()" placeholder="请输入你的密码" id="pwd" value="<?php echo $pwd; ?>"
                                   type="password">
                        </div>
                        <!-- Input Password End -->

                        <!-- Input Password Start -->
                        <div class="single-input-item mb-3">
                            <input placeholder="请输入验证码" name="yzm" value="<?php echo $yzm; ?>" style="width: 260px"
                                   type="text">
                            <img onClick="this.src='http://localhost:801/ShoppingDemo/src/Application/Views/Home/assets/ChaerCode.php?nocache='+Math.random()"
                                 src="http://localhost:801/ShoppingDemo/src/Application/Views/Home/assets/ChaerCode.php"
                                 style="margin-left: 10px; height: 40px; width: 180px;padding: 1px;">
                        </div>
                        <!-- Input Password End -->

                        <!-- Checkbox/Forget Password Start -->
                        <div class="single-input-item mb-3">
                            <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                <div class="remember-meta mb-3">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" name="agree" value="1" id="rememberMe"
                                               type="checkbox">
                                        <label class="custom-control-label" for="rememberMe">同意本协议</label>
                                    </div>
                                </div>
                                <a class="forget-pwd mb-3" href="#">忘记密码?</a>
                            </div>
                        </div>
                        <!-- Checkbox/Forget Password End -->

                        <!-- Login Button Start -->
                        <div class="single-input-item mb-3">

                            <button type="submit" id="login" disabled="true" name="login"
                                    class="btn btn btn-dark btn-hover-primary rounded-0">登入
                            </button>
                            <label id="tips" style="color:#ff0000"></label>
                        </div>
                        <!-- Login Button End -->

                        <!-- Lost Password & Creat New Account Start -->
                        <div class="lost-password">
                            <a href="register.html">创建账号?前往</a>
                        </div>
                        <!-- Lost Password & Creat New Account End -->
                        <script>
                            function reg() {
                                var resReg = true;
                                var resMsg = "";

                                var account = document.getElementById("account").value;
                                var pwd = document.getElementById("pwd").value;


                                if (account !== "" && (account.length) > 5 && (account.length) <= 16) {
                                    /** 符合规范 **/
                                } else {
                                    resReg = false;
                                    resMsg = resMsg + "账号请在1-16字符之间！！！  ";
                                }
                                if (pwd !== "" && (pwd.length) > 5 && (pwd.length) <= 16) {
                                    /** 符合规范 **/
                                } else {
                                    resReg = false;
                                    resMsg = resMsg + "密码请在1-16字符之间！！！  ";
                                }


                                if (resReg) {
                                    document.getElementById("tips").innerHTML = "<font color='green'> </font>";
                                    document.getElementById("login").disabled = false;
                                } else {
                                    document.getElementById("login").disabled = true;
                                    document.getElementById("tips").innerHTML = "<font color='red'>" + resMsg + "</font>";
                                }

                            }
                        </script>

                    </form>
                    <!-- Form Action End -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login Section End -->

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
                            <a href="#" title="Facebook"><i class="fa fa-facebook-f"></i></a>
                            <a href="#" title="Twitter"><i class="fa fa-twitter"></i></a>
                            <a href="#" title="Linkedin"><i class="fa fa-linkedin"></i></a>
                            <a href="#" title="Youtube"><i class="fa fa-youtube"></i></a>
                            <a href="#" title="Vimeo"><i class="fa fa-vimeo"></i></a>
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
                                <form class="mc-form" id="mc-form">
                                    <input class="form-control email-box mb-4" id="mc-email" name="EMAIL"
                                           placeholder="demo@example.com" type="email">
                                    <button class="newsletter-btn" id="mc-submit" type="submit">Subscribe</button>
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
                    <input class="search-input-offcanvas" placeholder="Search product..." type="text">
                    <button class="search-btn"><i class="pe-7s-search"></i></button>
                </form>
            </div>
            <!-- Mobile Menu Search Box End -->

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