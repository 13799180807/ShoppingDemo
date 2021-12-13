<?php


//新的
/**
 * 主页查询用的接口
 * @return array
 */
function indexCurlPost():array
{
    $url="http://localhost:8080/goods/home";
    $datalist=array();
    $datalist["method"]="list";
    $json=curl_post($url,$datalist);
    $resArr=json_decode($json,true);
    if($resArr["status"]=="200"){
        return $resArr["data"];
    }else{
      return array();
    }
}

/**
 * 详情页面
 * @param $id
 * @return array
 */
function productCurlPost($id) :array
{
    $url="http://localhost:8080/goods/product";
    $datalist=array();
    $datalist["id"]=$id;
    $json=curl_post($url,$datalist);
    $resArr=json_decode($json,true);
    if($resArr["status"]=="200"){
        return $resArr["data"];
    }
    return array();
}

/**
 * @param $name
 * @return array
 * 模糊查找
 */
function fuzzyCurlPost($name) :array
{
    $url="http://localhost:8080/goods/fuzzy";
    $dataList=array();
    $dataList['fuzzy']=$name;
    $json=curl_post($url,$dataList);
    $resArr=json_decode($json,true);
    if($resArr["status"]=="200")
    {
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
function categoryCurlPost($id,$page,$num) : array
{
    $url="http://localhost:8080/goodsCategory/page";
    $dataList=array();
    $dataList['id']=$id;
    $dataList['page']=$page;
    $dataList['num']=$num;
    $json=curl_post($url,$dataList);
    $resArr=json_decode($json,true);
    if ($resArr["status"]=="200")
    {
        return $resArr;
    }
    return array();
}

//结束

function registerUri($account,$password){
    $url="http://localhost:8080/index/register/reg";
    $datalist=array();
    $datalist["account"]=$account;
    $datalist["password"]=$password;
    $json=curl_post($url,$datalist);
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
function curl_post($url, $postdate ) {
    $header = array(
        'Accept: Application/json',
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
    curl_setopt($curl, CURLOPT_POSTFIELDS, $postdate);
    $data = curl_exec($curl);
    if (curl_error($curl)) {
        print "Error: " . curl_error($curl);
    } else {
        curl_close($curl);
        return $data;
    }
}
