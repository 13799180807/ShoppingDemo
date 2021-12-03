<?php
require 'GoodsIntroduceDaoImpl.php';
interface GoodsIntroduceDao
{
    /**
     * @param $conn
     * @param $goodsId
     * @return mixed
     * 根据商品id进行查询
     */
    public static function getGoodsId($conn, $goodsId);


}