<?php
require '../src/Application/Domain/Goods.php';

class GoodsModel
{
    /**
     * @param $name
     * @param $rows
     * @return array[]
     * 主页显示一些用的
     */
    public static function homePageinformationDisplay($rows){

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
            $c->goodsImg=$row[9];
            $dataList[$i]=$c;
            $i++;
        }
        return $dataList;
    }

}