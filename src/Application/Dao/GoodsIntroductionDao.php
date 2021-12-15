<?php
namespace Application\Dao;
interface GoodsIntroductionDao
{
    /**
     * 根据商品id进行查询
     * @param $conn
     * @param int $goodsId
     * @return mixed
     */
    public static function getGoodsId($conn,int $goodsId);


    /**
     * 根据商品的id进行删除详细说明
     * @param $conn
     * @param int $goodsId
     * @return mixed
     */
    public static function deleteByGoodsId($conn,int $goodsId);




}