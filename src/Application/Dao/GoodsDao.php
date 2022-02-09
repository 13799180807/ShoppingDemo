<?php

namespace Application\Dao;
interface GoodsDao
{

    /**
     * 根据字段进行删除
     * @param int|null $goodsId
     * @param int|null $categoryId
     * @return bool
     */
    public function removeByField(int $goodsId = null, int $categoryId = null): bool;

    /**
     * 获取一个商品信息
     * @param int $goodsId
     * @return array
     */
    public function getByGoodsId(int $goodsId): array;


    /** 修改前后分界线 */

    /**
     * 根据名字进行模糊查询商品信息
     * @param string $goodsName
     * @param int $status
     * @return array
     */
    public function getByGoodsName(string $goodsName, int $status = 0): array;


    /**
     * 根据不同字段进行查询该字段的信息
     * @param int $num
     * @param int $status
     * @param string $field
     * @param string $value
     * @return array
     */
    public function listField(int $num, int $status, string $field = "", string $value = ""): array;


    /**
     * 获取这个分类下的商品的id
     * @param int $goodsCategoryId
     * @return array
     */
    public function listGoodsCategoryId(int $goodsCategoryId): array;

    /**
     * 更新商品
     * @param int $goodsId
     * @param string $name
     * @param int $categoryId
     * @param float $prick
     * @param int $stock
     * @param int $status
     * @param int $hot
     * @param int $recommendation
     * @param string $describe
     * @param string $img
     * @return bool
     */
    public function updateGoodsById(int $goodsId, string $name, int $categoryId, float $prick, int $stock, int $status = 1,
                                    int $hot = 2, int $recommendation = 2, string $describe = "", string $img = ""): bool;

    /**
     * 管理员添加商品
     * @param string $goodsName
     * @param int $goodsCategoryId
     * @param float $goodsPrice
     * @param int $goodsStock
     * @param int $goodsStatus
     * @param int $goodsHot
     * @param int $goodsRecommendation
     * @param string $goodsDescribe
     * @param string $goodsImg
     * @return int
     */
    public function saveGoods(string $goodsName, int $goodsCategoryId, float $goodsPrice, int $goodsStock = 0, int $goodsStatus = 1,
                              int $goodsHot = 2, int $goodsRecommendation = 2, string $goodsDescribe = "", string $goodsImg = ""): int;


}