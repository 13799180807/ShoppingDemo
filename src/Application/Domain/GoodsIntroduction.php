<?php
namespace Application\Domain;

/**
 * 商品详情介绍表
 * Class GoodsIntroduction
 * @package Application\Domain
 */
class GoodsIntroduction
{
    public int $id; //id
    public int $goodsId; //商品id
    public string $goodsIntroduction;//详情说明

    /**
     * 显示
     * @param array $rows
     * @return array
     */
    public function introductionModel(array $rows): array
    {
        $dataList=array();
        $i=0;
        foreach ($rows as  $row){
            $c= new GoodsIntroduction();
            foreach ($row as $key =>$value)
            {
                $key=underscoreToHump($key);
                $c->$key=$value;
            }
            $dataList[$i]=$c;
            $i++;
        }
        return $dataList;
    }


}