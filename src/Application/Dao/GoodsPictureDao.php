<?php
namespace Application\Dao;
interface GoodsPictureDao
{

    /**
     * 根据商品id获取该商品的详情普片信息
     * @param string $field
     * @param int $goodsId
     * @return array
     */
    public function getGoodsId(string $field,int $goodsId) :array;

    /**
     * 根据goods_id进行删除操作
     * @param int $goodsId
     * @return bool
     */
    public function deleteByGoodsId(int $goodsId) :bool;

}