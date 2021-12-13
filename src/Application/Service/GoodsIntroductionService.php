<?php
namespace src\Application\Service;
interface GoodsIntroductionService
{
    /**
     * 根据商品id查询对应的具体描述
     * @param int $goodsId
     * @return mixed
     */
    public static function getGoodsId(int $goodsId);




}