<?php
if (isset($_COOKIE['token'])) {
    setcookie("token", $_COOKIE['token'], time() - 3600);
    setcookie("user", $_COOKIE['user'], time() - 3600);
}
echo "<script>alert('退出登入成功！！！');location.href='index.php'</script>";
exit;
