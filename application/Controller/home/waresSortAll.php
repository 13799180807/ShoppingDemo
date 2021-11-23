<?php
header("Content-type:application/json;charset=utf-8");

//商品主页分类显示查询
/**
 * 分类查询显示
 */
//$dao = new waresDaolmpl();
//$json=$dao->waresShowindex("sp_hot","5","上架");
//echo $json;




//if(isset($_GET['fltyqu'])){
//    $query=$_GET["fltyqu"];
//    $querynum=$_GET["num"];
//    if($query=="sp_hot"){
//        $hotGoods=homepageWares("sp_hot", $querynum);  //热度排序  推荐
//        echo $hotGoods;
//    }elseif ($query=="sp_sold"){
//        $salesGoods=homepageWares("sp_sold", $querynum);//销量最高  火爆产品
//        echo $salesGoods;
//    }elseif ($query=="create_time"){
//        $newestGoods=homepageWares("create_time", $querynum);//最新上架
//        echo $newestGoods;
//    }else{
//        $errlist=array();
//        $errlist['err']="参数不正确，请认真核实谢谢";
//        $json=failJson("请求失败",$errlist);
//        echo $json;
//    }
//
//}else{
//    $errlist=array();
//    $errlist['err']="请输入正确值";
//    $json=failJson("请求失败",$errlist);
//    echo $json;
//}
