<?php

namespace Application\Model;
use Application\Domain\Goods;
use Application\Domain\GoodsIntroduction;
use Application\Domain\GoodsPicture;

class GoodsModel
{
    /**
     * 主页显示一些用的
     * @param array $rows
     * @return array
     */
    public static function homeInformationDisplay(array $rows) :array
    {
        $dataList=array();
        $i=0;
        foreach ($rows as $row)
        {
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
     * 商品详情说明信息显示
     * @param array $rows
     * @return array
     */
    public static function GoodsIntroduceInformationDisplay(array $rows) : array
    {
        $dataList=array();
        $i=0;
        foreach ($rows as $row){
            $c=new GoodsIntroduction($row[0],$row[1],$row[2]);
            $dataList[$i]=$c;
            $i++;
        }
        return $dataList;
    }

    /**
     * 商品图片信息显示
     * @param array $rows
     * @return array
     */
    public static function GoodsPictureInformationDisplay(array $rows) : array
    {
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
     * 单个商品的详细信息
     * @param array $rows
     * @return array
     */
    public static function productPageInformationDisplay(array $rows) :array
    {
        $dataList=array();
        $i=0;
        foreach ($rows as $row){
            $c=new Goods();
            $c->goodsId=$row[0];
            $c->goodsName=$row[1];
            $c->goodsCategoryId=$row[2];
            $c->goodsPrice=$row[3];
            $c->goodsStock=$row[4];
            $c->goodsHot=$row[5];
            $c->goodsRecommendation=$row[6];
            $c->goodsDescribe=$row[7];
            $c->goodsImg=$row[8];
            $c->createdAt=$row[9];
            $dataList[$i]=$c;
            $i++;
        }
        return $dataList;
    }

}