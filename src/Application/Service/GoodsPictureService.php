<?php
namespace src\Application\Service;
interface GoodsPictureService
{
    /**
     * 根据id获取商品的图片信息
     * @param int $goodsId
     * @return mixed
     */
    public static function getGoodsId(int $goodsId);

}
