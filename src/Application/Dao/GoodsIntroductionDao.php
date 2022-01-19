<?php

namespace Application\Dao;
interface GoodsIntroductionDao
{
    /**
     * 根据商品id进行商品详细说明查询
     * @param int $goodsId
     * @return array
     */
    public function getGoodsId(int $goodsId): array;

    /**
     * 根据商品的id进行删除详细说明
     * @param int $goodsId
     * @return bool
     */
    public function removeByGoodsId(int $goodsId): bool;

    /**
     * 根据商品id进行插入商品详细介绍
     * @param int $goodsId
     * @param string $introduction
     * @return int
     */
    public function saveByGoodsId(int $goodsId, string $introduction = ""): int;

    /**
     * 商品详细表中根据goodsId进行修改修改商品详细说明
     * @param int $goodsId
     * @param string $introduction
     * @return bool
     */
    public function updateByGoodsId(int $goodsId, string $introduction = ""): bool;




}