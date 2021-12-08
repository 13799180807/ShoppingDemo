<?php
require 'GoodsIntroductionDaoImpl.php';
interface GoodsIntroductionDao
{
    /**
     * @param $conn
     * @param $goodsId
     * @return mixed
     * 根据商品id进行查询
     */
    public static function getGoodsId($conn, $goodsId);


}