<?php
require_once 'mysqli.php';
require_once '../model/Wares.php';
require_once '../config/json.php';

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

/**
 * @param $spuid
 * @return false|string
 * 详情页面主要信息显示
 */
function detailedpageWares($spuid){
    $sqlconfig=conf();
    $tablename=$sqlconfig['shop_wares'];
    $condition="sp_uid='{$spuid}'";
    if(getIssetOne($tablename,$condition)){
        $fileds='sp_uid,sp_varieties,sp_name,sp_price,sp_num,sp_imgpath,sp_hot,sp_sold,sp_text'; //查询字段
        $condtion="sp_uid='{$spuid}'";  //条件
        $rows=getAllOne($tablename,$fileds,$condtion);
        $arr=WaresdetailList($rows);
        $json=successJson("请求成功",$arr);
        return $json;
    }else{
        $arr=array(
            0=>array('','','','','','','','',''),
        );
        $arr=WaresdetailList($arr);
        $json=successJson("请求成功,数据不存在",$arr);
        return $json;
    }

}

/**
 * @param $typea
 * @param $num
 * @return false|string
 * 首页列表显示用的
 */
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
    if($rows=="-1"){
        $arr=array(
              0=>array('','','','','',''),
        );
        $arr=WaresindexlistJson($arr);
        $json=successJson("请求成功",$arr);
        return $json;
    }{
        $arr=WaresindexlistJson($rows);
        $json=successJson("请求成功",$arr);
        return $json;
    }
}
