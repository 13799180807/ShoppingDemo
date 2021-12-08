<?php
require 'GoodsIntroductionServiceImpl.php';
interface GoodsIntroductionService
{
    /**
     * @param $goodsId
     * @return mixed
     * 根据商品id查询对应的具体描述
     */
    public static function getGoodsId($goodsId);

}