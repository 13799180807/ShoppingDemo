<?php
namespace Application\Domain;

/**
 * 商品图片表
 * Class GoodsPicture
 * @package Application\Domain
 */
class GoodsPicture
{
    public int $id; //图片id
    public int $goodsId;  //商品id
    public string $goodsPicturePath; //图片路径

    /**
     * 输出
     * @param array $rows
     * @return array
     */
    public function pictureModel(array $rows): array
    {
        $dataList=array();
        $i=0;
        foreach ($rows as  $row){
            $c= new GoodsPicture();
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