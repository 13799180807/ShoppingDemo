<?php

namespace src\Application\Model;
use src\Application\Domain\GoodsCategory;

class GoodsCategoryModel
{

    /**
     * 分类显示
     * @param array $rows
     * @return array
     */
    public static function categoryInformation(array $rows) :array
    {
        $dataList=array();
        $i=0;
        foreach ($rows as $row)
        {
            $c=new GoodsCategory($row[0],$row[1]);
            $dataList[$i]=$c;
            $i++;
        }
        return $dataList;
    }

}