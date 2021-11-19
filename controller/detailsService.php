<?php
require_once './../DAOmysqli/listDAO.php';
header("Content-type:application/json;charset=utf-8");
    if(isset($_POST['commodity'])){

        $sp_uid=$_POST['commodity'];
        $tabletype=$_POST['tabletype'];

        if($tabletype=="shop_wares"){
            $json=detailedpageWares("$sp_uid");
           echo $json;
        }elseif ($tabletype=="shop_waresing"){


        }elseif ($tabletype=="shop_warestext"){

        }else{
            $errlist=array();
            $errlist['err']="参数不正确，请认真核实谢谢";
            $json=failJson("请求失败",$errlist);
            echo $json;
        }

    }else{
        $errlist=array();
        $errlist['err']="请输入正确值,不要进行违法操作";
        $json=failJson("请求失败",$errlist);
        echo $json;
    }

