<?php


/**
 * 检测字母和数字并在区间内
 * @param $str
 * @return bool
 */
function matchPwd($str): bool
{
    $isMatched = preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,16}$/', $str);
    if ($isMatched == 1) {
        return true;
    }
    return false;
}

/**
 * 匹配手机号
 * @param $str
 * @return bool
 */
function matchPhone($str): bool
{
    $isMatched = preg_match('/^(13[0-9]|14[5|7]|15[0|1|2|3|4|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$/', $str, $matches);
    if ($isMatched == 1) {
        return true;
    }
    return false;
}

/**
 * 检测字母和数字并在区间内
 * @param $str
 * @return bool
 */
function matchNumberLetters($str): bool
{
    $isMatched = preg_match('/^[A-Za-z0-9]{1,40}$/', $str);
    if ($isMatched == 1) {
        return true;
    }
    return false;
}


/** 检测状态---测试 */
function userStatus(): array
{
    $statusRes = curl_post("http://localhost:8080/home/user/state", array(
        'token' => $_COOKIE['token']
    ));
    $statusRes = json_decode($statusRes, true);
    if ($statusRes['code'] == 200) {
        return array(true, "当前已经登入了");
    }
    /** 当前登入过期了 */
    setcookie("token", $_COOKIE['token'], time() - 3600);
    setcookie("user", $_COOKIE['user'], time() - 3600);

    return array(false, "当前登入过期了");

}


//新的
/**
 * 主页查询用的接口
 * @return array
 */
function indexCurlPost(): array
{
    $url = "http://localhost:8080/home/goods/index";
    $datalist = array();
    $datalist["method"] = "list";
    $json = curl_post($url, $datalist);
    $resArr = json_decode($json, true);
    if ($resArr["code"] == 200) {
        return $resArr["data"];
    } else {
        return array();
    }
}

/**
 * 详情页面
 * @param $id
 * @return array
 */
function productCurlPost($id): array
{
    $url = "http://localhost:8080/home/goods/show";
    $datalist = array();
    $datalist["id"] = $id;
    $json = curl_post($url, $datalist);
    $resArr = json_decode($json, true);
    if ($resArr["code"] == 200) {
        return $resArr["data"];
    }
    return array();
}

/**
 * @param $name
 * @return array
 * 模糊查找
 */
function fuzzyCurlPost($name): array
{
    $url = "http://localhost:8080/home/goods/fuzzy";
    $dataList = array();
    $dataList['fuzzy'] = $name;
    $json = curl_post($url, $dataList);
    $resArr = json_decode($json, true);
    if ($resArr["code"] == 200) {
        return $resArr["data"];
    }
    return array();
}

/**
 * @param $id
 * @param $page
 * @param $num
 * @return array
 * 分类显示
 */
function categoryCurlPost($id, $page, $num): array
{
    $url = "http://localhost:8080/home/category/Classification";
    $dataList = array();
    $dataList['id'] = $id;
    $dataList['page'] = $page;
    $dataList['num'] = $num;
    $json = curl_post($url, $dataList);
    $resArr = json_decode($json, true);
    if ($resArr["code"] == 200) {
        return $resArr;
    }
    return array();
}

//结束

function registerUri($account, $password)
{
    $url = "http://localhost:8080/home/index/register/reg";
    $datalist = array();
    $datalist["account"] = $account;
    $datalist["password"] = $password;
    $json = curl_post($url, $datalist);
    return $json;
}


function curl_get($url)
{
    $header = array(
        'Accept: Application/json',
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

function curl_post($url, $postdate)
{
    $header = array(
        'Accept: Application/json',
    );
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, 10);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $postdate);
    $data = curl_exec($curl);
    if (curl_error($curl)) {
        print "Error: " . curl_error($curl);
    } else {
        curl_close($curl);
        return $data;
    }
}
