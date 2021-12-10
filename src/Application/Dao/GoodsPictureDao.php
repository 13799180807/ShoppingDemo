<?php
namespace src\Application\Dao;
interface GoodsPictureDao
{
    /**
     * 根据商品id获取该商品的详情普片信息
     * @param $conn
     * @param int $goodsId
     * @return mixed
     */
    public static function getGoodsId($conn,int $goodsId);

}