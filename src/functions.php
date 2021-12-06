<?php


/**
 * @param $uri
 * @return int|string
 * 获取$_SERVER["REQUEST_URI"]处理得到我要的结果
 */
function uri($uri){
    if ($uri==""){
        return -1;
    }
    $uri=trim($uri,"/");
    $uriArr=explode('/', $uri);
    $str="";
    $d=1;
    foreach ($uriArr as $value){
        if(count($uriArr)==$d){

        }else{
            $str=$str."/".$value;
        }
        $d=$d+1;
    }
    return $str;
}

/**
 * @param $arr
 * @return array|int
 * 对请求数据的获取得到想要的数组
 */
function parameterList($arr){
    if ($arr==""){
        return -1;
    }
    $arraylist=array();
    foreach (array_keys($arr) as $val){
        $arraylist[$val]=$arr[$val];
    }
    return $arraylist;
}
function successJson($msg,$dataList){
    /**
     * 成功返回的
     */
    $status=SUCCESS;
    $json = array(
        'status' => $status,
        'msg' => $msg,
        'data' =>$dataList
    );
    return json_encode($json);
}
function failJson($msg,$dataList){
    /**
     * 失败返回值
     */
    $status=FAIL;
    $json = array(
        'status' => $status,
        'msg' => $msg,
        'data' =>$dataList
    );
    return json_encode($json);
}