<?php
require '../src/Application/Domain/Goods.php';
require '../src/Application/Domain/GoodsIntroduce.php';
require '../src/Application/Domain/GoodsPicture.php';

class GoodsModel
{
    /**
     * @param $name
     * @param $rows
     * @return array[]
     * 主页显示一些用的
     */
    public static function homeInformationDisplay($rows) :array
    {
        $dataList=array();
        if(count($rows)=="0"){
            $rows=array(
                0=>array('','','','','','','','','','','',''),
            );
        }
        $i=0;
        foreach ($rows as $row){
            $c=new Goods();
            $c->goodsId=$row[0];
            $c->goodsName=$row[1];
            $c->goodsCategoryId=$row[2];
            $c->goodsPrice=$row[3];
            $c->goodsImg=$row[9];
            $dataList[$i]=$c;
            $i++;
        }
        return $dataList;
    }

    /**
     * @param $rows
     * @return array
     * 商品详情说明信息显示
     */
    public static function GoodsIntroduceInformationDisplay($rows) :array
    {
        if(count($rows)==0){
            $rows=array(
                0=>array('','',''),
            );
        }
        $dataList=array();
        $i=0;
        foreach ($rows as $row){
            $c=new GoodsIntroduce($row[0],$row[1],$row[2]);
            $dataList[$i]=$c;
            $i++;
        }
        return $dataList;
    }

    /**
     * @param $rows
     * @return array
     */
    public static function GoodsPictureInformationDisplay($rows) : array
    {
        if(count($rows)==0){
            $rows=array(
                0=>array('','',''),
            );
        }
        $dataList=array();
        $i=0;
        foreach ($rows as $row){
            $c=new GoodsPicture($row[0],$row[1],$row[2]);
            $dataList[$i]=$c;
            $i++;
        }
        return $dataList;

    }



    /**
     * @param $rows
     * @return array
     * 单个商品的详细信息
     */
    public static function productPageInformationDisplay($rows) :array
    {
        $dataList=array();
        if($rows=="-1"){
            $rows=array(
                0=>array('','','','','','','','','','','',''),
            );
        }
        $i=0;
        foreach ($rows as $row){
            $c=new Goods();
            $c->goodsId=$row[0];
            $c->goodsName=$row[1];
            $c->goodsCategoryId=$row[2];
            $c->goodsPrice=$row[3];
            $c->goodsStock=$row[4];
            $c->goodsHot=$row[6];
            $c->goodsRecommend=$row[7];
            $c->goodsDescribe=$row[8];
            $c->goodsImg=$row[9];
            $c->createdAt=$row[10];
            $dataList[$i]=$c;
            $i++;
        }
        return $dataList;

    }

}