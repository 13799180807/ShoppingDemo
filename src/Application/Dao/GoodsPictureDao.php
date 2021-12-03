<?php
require 'GoodsPictureDaoImpl.php';
interface GoodsPictureDao
{
    /**
     * @param $conn
     * @param $goodsId
     * @return mixed
     */
    public static function getGoodsId($conn,$goodsId);

}