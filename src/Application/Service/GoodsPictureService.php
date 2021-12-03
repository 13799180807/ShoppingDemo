<?php
require 'GoodsPictureServiceImpl.php';
interface GoodsPictureService
{
    /**
     * @param $goodsId
     * @return mixed
     */
    public static function getGoodsId($goodsId);

}
