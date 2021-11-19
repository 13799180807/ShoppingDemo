<?php
function SuccessJson($msg,$dataList,$code="1"){
    /**
     * 成功返回的
     * code默认等于1，没有数据等于0
     */
     $status=SUCCESS;
     $json = array(
         'status' => $status,
         'msg' => $msg,
         'code'=>$code,
         'data' =>$dataList
      );
     return json_encode($json);
}

function FailJson($msg,$dataList){
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