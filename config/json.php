<?php
require_once 'config.php';

//function text(){
//    /**
//     * 成功使用方法
//     */
//    $age['Peter']="35";
//    $age['Ben']="37";
//    $age['Joe']="43";
//    $a=successJson("获取成功",$age);
//    echo $a;
//    //解码
////    $age['Peter']="35";
////    $age['Ben']="37";
////    $age['Joe']="43";
////    $a=successJson("获取成功",$age);
////    echo $a."<br/>";
////    var_dump(json_decode($a, true));
////    echo "<br/>";
////    $aa=json_decode($a, true);
////    $aa=$aa["data"];
////    echo $aa["Peter"];
//
//
//
//    //$a=successJson("获取成功","aa");
//    //echo $a;
//    //$a=failJson("网络异常","");
//    //echo $a;
//}
function successJson($msg,$dataList){
    /**
     * 成功json返回值
     */
    $status=success;
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
    $status=fail;
    $json = array(
        'status' => $status,
        'msg' => $msg,
        'data' =>$dataList
    );
    return json_encode($json);

}
