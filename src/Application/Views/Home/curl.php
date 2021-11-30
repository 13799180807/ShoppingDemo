<?php


//新的
function indexCurlPost(){
    $url="http://localhost:8080/index/all";
    $datalist=array();
    $datalist["method"]="list";
    $json=curl_post($url,$datalist);
    $resArr=json_decode($json,true);
    if($resArr["status"]=="200"){
        return $resArr["data"];
    }else{
        return -1;
    }

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
function waresLookup($name){
    $url="http://localhost:8080/index/search/all/";
    $datalist=array();
    $datalist['seach']=$name;
    $json=curl_post($url,$datalist);
    $list=JsonList($json);
    return $list;
}
function waresSortQuery($sortName,$page,$num){
    $url="http://localhost:8080/index/sort/waresall/all/";
    $datalist=array();
    $datalist["sortName"]=$sortName;
    $datalist["page"]=$page;
    $datalist["num"]=$num;
    $json=curl_post($url,$datalist);
    $list=JsonList($json);
    return $list;
}
function pagingUri($num,$sortName){
    $url="http://localhost:8080/index/sort/page/num/";
    $datalist=array();
    $datalist["num"]=$num;
    $datalist["sortName"]=$sortName;
    $json=curl_post($url,$datalist);
    $list=JsonList($json);
    return $list;
}
function sortListUri(){
    $url="http://localhost:8080/index/waressort/sort/";
    $datalist=array();
    $datalist["method"]="all";
    $json=curl_post($url,$datalist);
    $list=JsonList($json);
    return $list;
}
function testUri(){
    $url="http://localhost:8080/index/details/text/sin/";
    $datalist=array();
    $datalist["uid"]=$_GET['commodity'];
    $json=curl_post($url,$datalist);
    $tesrlist=JsonList($json);
    return $tesrlist;
}
function uriSingleImg(){
    $url="http://localhost:8080/index/details/img/sin/";
    $datalist=array();
    $datalist["uid"]=$_GET['commodity'];
    $json=curl_post($url,$datalist);
    $imgall=JsonList($json);
    return $imgall;
}
function uriSingle(){
    $url="http://localhost:8080/index/details/sin/";
    $datalist=array();
    $datalist["uid"]=$_GET['commodity'];
    $json=curl_post($url,$datalist);
    $singleall=JsonList($json);
    return $singleall;
}
function JsonList($json){
    $json=json_decode($json,true);
    if ($json["status"]=="200"){
        if($json["code"]=="1"){
            $list=$json["data"];
            return $list;
        }else{
            return -1;
        }
    }
     return -1;
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
function curl_post( $url, $postdata ) {
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
    curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
    $data = curl_exec($curl);
    if (curl_error($curl)) {
        print "Error: " . curl_error($curl);
    } else {
        curl_close($curl);
        return $data;
    }
}
