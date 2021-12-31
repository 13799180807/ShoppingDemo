<?php
namespace Application\Domain;

/**
 * 分类表
 * Class GoodsCategory
 * @package Application\Domain
 */
class GoodsCategory
{
    public int $goodsCategoryId;  //分类id
    public string $goodsCategoryName; //分类名

    /**
     * 显示
     * @param array $rows
     * @return array
     */
    public function categoryModel(array $rows): array
    {
        $dataList=array();
        $i=0;
        foreach ($rows as  $row){
            $c= new GoodsCategory();
            foreach ($row as $key =>$value)
            {
                $key=underscoreToHump($key);
                /** 安全处理 */
                $c->$key=htmlentities($value);
            }
            $dataList[$i]=$c;
            $i++;
        }
        return $dataList;
    }


}