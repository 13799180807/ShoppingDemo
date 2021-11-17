<?php
require_once '../util/mysqliUtil.php';
require_once '../model/Wares.php';
include "../config/json.php";



function conf(){
    /**
     * 配置查询文件
     */
    $queryCoodtion=array();
    $queryCoodtion['num']=5;//查询几条消息
    $queryCoodtion['sp_state']="上架";//查询的状态（上架/下架）
    $queryCoodtion['sp_hot']="sp_hot";//根据热度查询(访问量)
    $queryCoodtion['create_time']="create_time";//根据最新查询（创建时间）
    $queryCoodtion['sp_sold']="sp_sold";//根据销量查询显示
    $queryCoodtion['shop_wares']="shop_wares";//商品表   --对应数据库表明
    return $queryCoodtion;
}
function homepageWares($typea,$num){
    /***
     * 参数：排序类型,显示几条
     *主要用途例如：热度排序（访问量），销量最高（已售出）,最新产品（上架时间）
     * 需要的数据为商品UID,商品名字，商品价格，商品图片,商品热度，已卖出
     */
    $sqlconfig=conf();
    $state=$sqlconfig["sp_state"];
    $tablename=$sqlconfig['shop_wares'];

    $fileds='sp_uid,sp_name,sp_price,sp_imgpath,sp_hot,sp_sold';
    $condtion=" sp_state='{$state}'   order by {$typea}  desc limit {$num}";
    $rows=getAllOne($tablename,$fileds,$condtion);
    $json=WaresindexlistJson($rows);
  //  echo $json;
    return $json;
}
function waresAll(){
    /**
     *图片 名字 价格 uid
     */
    $sql='sp_uid,sp_name,sp_imgpath,sp_price';
    $rows=getAllList("shop_wares",$sql);
    $i=0;
    foreach ($rows as $row){

        $c=new Wares();
        $c->sp_uid=$row[0];
        $c->sp_name=$row[1];
        $c->sp_imgpath=$row[2];
        $c->sp_price=$row[3];
      //  $c->sp_varieties[4];

        $userList[$i]=$c;
        $i++;
    }
     //json格式返回
     $a=successJson("请求成功",array("wareslist"=>$userList));
     return $a;
}
function textdemo(){
    //homepageWares("sp_hot",1);  //热度排序
//homepageWares("create_time",5);//最新上架
 //   homepageWares("sp_sold","3");//销量最高


//$json=waresAll();
//
//$tbl=json_decode($json, true);
//$tbl=$tbl["data"];
//$rows=$tbl["wareslist"];
////var_dump($rows);
//$imgPath="../IMG/";
//foreach ( $rows as $row){
//
//    echo $row["sp_uid"].$row["sp_name"].$row["sp_price"].$imgPath.$row["sp_imgpath"]."<br/>";
////    foreach ($row as $value){
////       echo $value."<br/>";
////       // var_dump($value[0]);
////    }
//
//}
}






