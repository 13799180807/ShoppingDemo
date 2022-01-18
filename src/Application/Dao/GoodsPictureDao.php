<?php

namespace Application\Dao;
interface GoodsPictureDao
{

    /**
     * 根据商品id获取该商品的详情普片信息
     * @param int $goodsId
     * @return array
     */
    public function getGoodsId(int $goodsId): array;

    /**
     * 根据goods_id进行删除操作
     * @param int $goodsId
     * @return bool
     */
    public function removeByGoodsId(int $goodsId): bool;

    /**
     * 根据goodsId进行商品图片的添加
     * @param int $goodsId
     * @param string $fileName
     * @return int
     */
    public function saveByGoodsId(int $goodsId,string $fileName) :int;

}