<?php
require_once './../DAOmysqli/listDAO.php';
header("Content-type:application/json;charset=utf-8");
if(isset($_POST['commodity'])){

        $sp_uid=$_POST['commodity'];  //查询的id
        $json=textWaresimpl($sp_uid);
        echo $json;
}else{
    $errlist=array(
        "wareslist"=>array(
            'err'=>"请输入正确值",
            'tips'=>"请不要进行违法操作",),
    );
    $json=failJson("请求失败,请带入正确值进行操作",$errlist);
    echo $json;
}