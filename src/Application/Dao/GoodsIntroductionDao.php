<?php
namespace Application\Dao;
interface GoodsIntroductionDao
{
    /**
     * 根据商品id进行商品详细说明查询
     * @param int $goodsId
     * @return array
     */
    public function getGoodsId(int $goodsId) :array;

    /**
     * 根据商品的id进行删除详细说明
     * @param int $goodsId
     * @return bool
     */
    public function removeByGoodsId(int $goodsId) :bool;





}