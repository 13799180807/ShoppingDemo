<?php
require 'curl.php';
require 'config.php';

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
if (isset($_POST['updateName'])) {
    /** 进行了修改名字操作 */
    $newName = $_POST['name'];
    $newPhone = $_POST['phone'];
    $updateRes = curl_post("http://localhost:8080/home/user/UpdInformation", array(
        'token' => $_COOKIE['token'],
        'account' => $_COOKIE['user'],
        'name' => $newName,
        'phone' => $newPhone
    ));
    $updateRes = json_decode($updateRes, true);
    if ($updateRes['code'] == 200) {
        echo "<script>alert('修改信息成功！！！');</script>";
    } else {
        $msg = $updateRes['msg'];
        echo "<script>alert('{$msg}');</script>";
    }

}
if (isset($_POST['updatePwd'])) {
    /** 进行了修改密码的操作 */
    $pwd = $_POST['pwd'];
    $newPwd = $_POST['newPwd'];
    $updatePwdRes = curl_post("http://localhost:8080/home/user/UpdPwd", array(
        'token' => $_COOKIE['token'],
        'account' => $_COOKIE['user'],
        'pwd' => $pwd,
        'newPwd' => $newPwd
    ));
    $updatePwdRes = json_decode($updatePwdRes, true);
    if ($updatePwdRes['code'] == 200) {
        echo "<script>alert('密码修改成功！！！');</script>";

    } else {
        $msg = $updatePwdRes['msg'];
        echo "<script>alert('{$msg}');</script>";
    }

}
if (isset($_POST['addScores'])) {
    /** 账户积分充值 */
    $addScores = curl_post("http://localhost:8080/home/user/SaveScore", array(
        'token' => $_COOKIE['token'],
        'account' => $_COOKIE['user'],
        'score' => $_POST['score']
    ));
    $addScores = json_decode($addScores, true);
    $msg = $addScores['msg'];
    echo "<script>alert('{$msg}');</script>";
}

$userAccount = $_COOKIE['user'];
$token = $_COOKIE['token'];
$res = curl_post("http://localhost:8080/home/user/getInformation", array(
    'token' => $_COOKIE['token'],
    'account' => $userAccount
));
$resArr = json_decode($res, true);
if ($resArr['code'] == 200) {
    $userData = $resArr['data'];
    if (count($userData['information']) == 0) {
        /** 首次登入请填充信息 */
        echo "<script>alert('账号信息未补全请补全信息后在体验！！！');location.href='firstLogin.php'</script>";
        exit;
    }

} else {
    $msg = $resArr['msg'];
    echo "<script>alert('{$msg}！！！');location.href='exitLogin.php'</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>用户个人中心</title>
    <link href="assets/css/vendor/vendor.min.css" rel="stylesheet">
    <link href="assets/css/plugins/plugins.min.css" rel="stylesheet">
    <link href="assets/css/style.min.css" rel="stylesheet">
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
                        <p class="header-top-message">欢迎：<?php echo $userData['information'][0]['userName']; ?>
                            来到购物商城</p>
                    </div>
                </div>
                <div class="col-12 col-sm-6 text-end d-none d-lg-block">
                    <div class="header-top-settings">
                        <ul class="nav align-items-center justify-content-end">
                            <li class="curreny-wrap">
                                个人中心
                                <i class="fa fa-angle-down"></i>
                                <ul class="dropdown-list curreny-list">
                                    <li><a href="#">余额：<?php echo $userData['information'][0]['userScore']; ?>分</a></li>
                                    <li><a href="#">未结算订单：5个</a></li>
                                </ul>
                            </li>
                            <li class="language"><a href="exitLogin.php">退出</a></i>

                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Header Top Message End -->

            </div>
        </div>
    </div>
    <!-- Header Top End -->
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
                    <li class="active"> 我的个人中心</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End -->

</div>
<!-- Breadcrumb Section End -->

<!-- My Account Section Start -->
<div class="section section-margin">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">

                <!-- My Account Page Start -->
                <div class="myaccount-page-wrapper">
                    <div class="row">

                        <!-- My Account Tab Menu Start -->
                        <div class="col-lg-3 col-md-4">
                            <div class="myaccount-tab-menu nav" role="tablist">
                                <a class="active" data-bs-toggle="tab" href="#dashboad"><i class="fa fa-dashboard"></i>
                                    基本信息</a>
                                <a data-bs-toggle="tab" href="#orders"><i class="fa fa-cart-arrow-down"></i> 订单</a>
                                <a data-bs-toggle="tab" href="#download"><i class="fa fa-cloud-download"></i>
                                    充值记录</a>
                                <a data-bs-toggle="tab" href="#payment-method"><i class="fa fa-credit-card"></i>
                                    个人账户</a>
                                <a data-bs-toggle="tab" href="#address-edit"><i class="fa fa-map-marker"></i>
                                    收获地址</a>
                                <a data-bs-toggle="tab" href="#account-info"><i class="fa fa-user"></i> 修改信息</a>
                                <a data-bs-toggle="tab" href="#account-updPwd"><i class="fa fa-user"></i> 修改密码</a>
                                <a href="exitLogin.php"><i class="fa fa-sign-out"></i> 退出登入</a>
                            </div>
                        </div>
                        <!-- My Account Tab Menu End -->

                        <!-- My Account Tab Content Start -->
                        <div class="col-lg-9 col-md-8">
                            <div class="tab-content" id="myaccountContent">

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3 class="title">欢迎：<?php echo $userData['information'][0]['userName']; ?></h3>
                                        <div class="welcome">
                                            <p>账户剩余积分：
                                                <strong><?php echo $userData['information'][0]['userScore']; ?></strong>
                                            </p>
                                        </div>
                                        <div class="welcome">
                                            <p>您的电话：
                                                <strong><?php echo $userData['information'][0]['userPhone']; ?></strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="orders" name="orders" role="tabpanel">
                                    <div class="myaccount-content">

                                        <h3 class="title">Orders</h3>
                                        <div class="myaccount-table table-responsive text-center">
                                            <table class="table table-bordered">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>Order</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Total</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Aug 22, 2018</td>
                                                    <td>Pending</td>
                                                    <td>$3000</td>
                                                    <td><a class="btn btn btn-dark btn-hover-primary btn-sm rounded-0"
                                                           href="cart.html">View</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>July 22, 2018</td>
                                                    <td>Approved</td>
                                                    <td>$200</td>
                                                    <td><a class="btn btn btn-dark btn-hover-primary btn-sm rounded-0"
                                                           href="cart.html">View</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>June 12, 2019</td>
                                                    <td>On Hold</td>
                                                    <td>$990</td>
                                                    <td><a class="btn btn btn-dark btn-hover-primary btn-sm rounded-0"
                                                           href=" #">View</a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="download" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3 class="title">充值记录 </h3>
                                        <div class="myaccount-table table-responsive text-center">
                                            <table class="table table-bordered">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>充值分</th>
                                                    <th>结果</th>
                                                    <th>充值时间</th>
                                                    <th>订单说明</th>
                                                    <th>操作</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>11.00</td>
                                                    <td>成功</td>
                                                    <td>2020-11-02-11：30:29</td>
                                                    <td>成功充值</td>
                                                    <td><a class="btn btn btn-dark btn-hover-primary rounded-0"
                                                           href="#">删除</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>11.00</td>
                                                    <td>成功</td>
                                                    <td>2022-01-29 11:37:04</td>
                                                    <td>成功充值</td>
                                                    <td><a class="btn btn btn-dark btn-hover-primary rounded-0"
                                                           href="#">删除</a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="payment-method" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3 class="title">账户积分充值</h3>
                                        <form class="saved-message" target="formSubmit" method="post"
                                              action="my-account.php">
                                            <label>
                                                积分:
                                                <input type="text" id="score" name="score" onblur="reg0()">
                                            </label>
                                            <label id="tips0" style="color:#ff0000"></label>
                                            <input type="submit" id="addScores" disabled="true" value="充值"
                                                   name="addScores"
                                                   class="btn btn btn-dark btn-hover-primary rounded-0">
                                            <script>
                                                function reg0() {
                                                    var resReg = true;
                                                    var resMsg = "";
                                                    var score = document.getElementById("score").value;
                                                    var numReg = /^[0-9]*$/;

                                                    if (score === "" || score < 10 || score > 1000) {
                                                        resReg = false;
                                                        resMsg = resMsg + "当次充值请在10-1000之间！！！  ";
                                                    }

                                                    if (!numReg.test(score)) {
                                                        resReg = false;
                                                        resMsg = resMsg + "充值请为整数！！！  ";
                                                    }

                                                    if (resReg) {
                                                        document.getElementById("tips0").innerHTML = "<font color='green'> </font>";
                                                        document.getElementById("addScores").disabled = false;
                                                    } else {
                                                        document.getElementById("addScores").disabled = true;
                                                        document.getElementById("tips0").innerHTML = "<font color='red'>" + resMsg + "</font>";
                                                    }

                                                }
                                            </script>

                                        </form>
                                        <p>说明：充值有一定延迟，请耐心等待1分等于1人民币； </p>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="address-edit" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3 class="title">Billing Address</h3>
                                        <address>
                                            <p><strong>Alex Aya</strong></p>
                                            <p>1234 Market ##, Suite 900 <br>
                                                Lorem Ipsum, ## 12345</p>
                                            <p>Mobile: (123) 123-456789</p>
                                        </address>
                                        <a class="btn btn btn-dark btn-hover-primary rounded-0" href="#"><i
                                                    class="fa fa-edit me-2"></i>Edit Address</a>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="account-info" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3 class="title">修改账户信息</h3>
                                        <div class="account-details-form">
                                            <iframe name="formSubmit" style="display:none;">
                                                <!-- 隐藏起来将表单刷新指向这里 -->
                                            </iframe>
                                            <form action="my-account.php" target="formSubmit" method="post">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item mb-3">
                                                            <label class="required mb-1" for="first-name">您的新名字</label>
                                                            <input id="name" name="name" onblur="reg()"
                                                                   value="<?php echo $userData['information'][0]['userName']; ?>"
                                                                   type="text"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item mb-3">
                                                            <label class="required mb-1" for="last-name">您的新电话</label>
                                                            <input id="phone" name="phone" onblur="reg()"
                                                                   value="<?php echo $userData['information'][0]['userPhone']; ?>"
                                                                   type="text"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <label id="tips" style="color:#ff0000"></label>
                                                <div class="single-input-item single-item-button">
                                                    <input type="submit" id="updateName" value="修改信息" name="updateName"
                                                           class="btn btn btn-dark btn-hover-primary rounded-0">
                                                </div>
                                            </form>
                                            <script>
                                                function reg() {
                                                    var resReg = true;
                                                    var resMsg = "";
                                                    var name = document.getElementById("name").value;
                                                    var phone = document.getElementById("phone").value;
                                                    var phoneReg = /^[1][3,4,5,7,8,9][0-9]{9}$/;

                                                    if (name === "" || (name.length) <= 1 || (name.length) >= 15) {
                                                        resReg = false;
                                                        resMsg = resMsg + "名字请在2-15字符之间！！！  ";
                                                    }

                                                    if (!phoneReg.test(phone)) {
                                                        resReg = false;
                                                        resMsg = resMsg + "请填写正确的手机号码！！！  ";
                                                    }

                                                    if (resReg) {
                                                        document.getElementById("tips").innerHTML = "<font color='green'> </font>";
                                                        document.getElementById("updateName").disabled = false;
                                                    } else {
                                                        document.getElementById("updateName").disabled = true;
                                                        document.getElementById("tips").innerHTML = "<font color='red'>" + resMsg + "</font>";
                                                    }

                                                }
                                            </script>
                                        </div>
                                    </div>
                                </div> <!-- Single Tab Content End -->
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="account-updPwd" role="tabpanel">
                                    <div class="myaccount-content">
                                        <div class="account-details-form">
                                            <form action="my-account.php" target="formSubmit" method="post">
                                                <fieldset>
                                                    <legend>修改密码</legend>
                                                    <div class="single-input-item mb-3">
                                                        <label class="required mb-1" for="current-pwd">输入旧密码</label>
                                                        <input id="pwd" onblur="reg1()" name="pwd" placeholder="旧密码"
                                                               type="password"/>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item mb-3">
                                                                <label class="required mb-1"
                                                                       for="new-pwd">输入新的密码</label>
                                                                <input id="newPwd" onblur="reg1()" name="newPwd"
                                                                       placeholder="新密码"
                                                                       type="password"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item mb-3">
                                                                <label class="required mb-1"
                                                                       for="confirm-pwd">再次输入新的密码</label>
                                                                <input id="newPwd1" name="newPwd1" onblur="reg1()"
                                                                       placeholder="再次输入新的密码"
                                                                       type="password"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <label id="tips1" style="color:#ff0000"></label>
                                                <div class="single-input-item single-item-button">
                                                    <input type="submit" id="updatePwd" value="修改密码" name="updatePwd"
                                                           disabled="true"
                                                           class="btn btn btn-dark btn-hover-primary rounded-0">
                                                </div>
                                                <script>
                                                    function reg1() {
                                                        var resReg = true;
                                                        var resMsg = "";
                                                        var pwd = document.getElementById("pwd").value;
                                                        var newPwd = document.getElementById("newPwd").value;
                                                        var newPwd1 = document.getElementById("newPwd1").value;

                                                        if (pwd === "" || (pwd.length) <= 5 || (pwd.length) > 16) {
                                                            resReg = false;
                                                            resMsg = resMsg + "请输入正确密码！！！";
                                                        }

                                                        if (newPwd === "" || (newPwd.length) <= 5 || (newPwd.length) > 16) {
                                                            resReg = false;
                                                            resMsg = resMsg + "新密码请在6-16字符之间！！！  ";
                                                        }

                                                        if (newPwd !== newPwd1) {
                                                            resReg = false;
                                                            resMsg = resMsg + "新密码两次输入不相等！！！  ";
                                                        }

                                                        if (resReg) {
                                                            document.getElementById("tips1").innerHTML = "<font color='green'> </font>";
                                                            document.getElementById("updatePwd").disabled = false;
                                                        } else {
                                                            document.getElementById("updatePwd").disabled = true;
                                                            document.getElementById("tips1").innerHTML = "<font color='red'>" + resMsg + "</font>";
                                                        }

                                                    }
                                                </script>
                                            </form>
                                        </div>
                                    </div>
                                </div> <!-- Single Tab Content End -->
                            </div>
                        </div>
                        <!-- My Account Tab Content End -->

                    </div>
                </div>
                <!-- My Account Page End -->

            </div>
        </div>

    </div>
</div>
<!-- My Account Section End -->

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
                            <li><a href="">Terms & Conditions</a></li>
                            <li><a href="">Payment Methode</a></li>
                            <li><a href="">Product Warranty</a></li>
                            <li><a href="">Return Process</a></li>
                            <li><a href="">Payment Security</a></li>
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
                        <p class="mb-0">Copyright &copy; 2021.Company name All rights reserved.
                        </p>
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
                            <a href="#">Shop <i aria-hidden="true" class="fa fa-angle-down"></i></a>
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
                            <a href="#">Product <i aria-hidden="true" class="fa fa-angle-down"></i></a>
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
                            <a href="#">Pages <i aria-hidden="true" class="fa fa-angle-down"></i></a>
                            <ul class="dropdown">
                                <li><a href="about.html">About Us</a></li>
                                <li><a href="contact.html">Contact</a></li>
                                <li><a href="faq.html">Faq</a></li>
                                <li><a href="error-404.html">Error 404</a></li>
                                <li><a href="my-account.php">My Account</a></li>
                                <li><a href="login.html">Loging | Register</a></li>
                            </ul>
                        </li>
                        <li class="has-children">
                            <a href="#">Blog <i aria-hidden="true" class="fa fa-angle-down"></i></a>
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
                    <a href="#" title="Facebook"><i class="fa fa-facebook-f"></i></a>
                    <a href="#" title="Twitter"><i class="fa fa-twitter"></i></a>
                    <a href="#" title="Linkedin"><i class="fa fa-linkedin"></i></a>
                    <a href="#" title="Youtube"><i class="fa fa-youtube"></i></a>
                    <a href="#" title="Vimeo"><i class="fa fa-vimeo"></i></a>
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