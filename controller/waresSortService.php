<?php
require_once './../DAOmysqli/listDAO.php';
header("Content-type:application/json;charset=utf-8");






if(isset($_POST['Sort'])){
    $typeSort=$_POST['Sort'];  //分类类型查看





    //分页查询用的
    //当个是哪个页面
    //页面显示几条数据

    //首先先执行一此要查询的分页数据看数据是否存在





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

}else{
    $errlist=array(
        "wareslist"=>array(
            'err'=>"请输入正确值",
            'tips'=>"请不要进行违法操作",),
    );
    $json=failJson("请求失败",$errlist);
    echo $json;
}
















