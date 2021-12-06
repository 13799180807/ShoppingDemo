<?php
require '../src/Application/Domain/GoodsCategory.php';

class GoodsCategoryModel
{

    /**
     * @param $rows
     * @return array
     * 分类显示
     */
    public static function categoryInformation($rows) :array
    {
        $dataList=array();
        $i=0;
        if(count($rows)=="0")
        {
            $rows=array(
                0=>array('',''),
            );
        }
        foreach ($rows as $row)
        {
            $c=new GoodsCategory($row[0],$row[1]);
            $dataList[$i]=$c;
            $i++;
        }
        return $dataList;
    }

}