<?php
namespace src\Application\Dao;
interface GoodsIntroductionDao
{
    /**
     * 根据商品id进行查询
     * @param $conn
     * @param int $goodsId
     * @return mixed
     */
    public static function getGoodsId($conn,int $goodsId);


}