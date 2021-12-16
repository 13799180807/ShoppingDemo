<?php
namespace Application\Dao;
interface GoodsIntroductionDao
{
    /**
     * 根据商品id进行商品详细说明查询
     * @param string $field
     * @param int $goodsId
     * @return array
     */
    public function getGoodsId(string $field,int $goodsId) :array;

    /**
     * 根据商品的id进行删除详细说明
     * @param int $goodsId
     * @return bool
     */
    public function deleteByGoodsId(int $goodsId) :bool;





}