<?php

namespace Application\Dao;
interface GoodsDao
{
    /**
     * 根据分类id进行删除商品表中的数据删除这个分类
     * @param int $goodsCategoryId
     * @return bool
     */
    public function removeByGoodsCategoryId(int $goodsCategoryId): bool;

    /**
     * 根据id进行查询商品的某个信息
     * @param string $userType
     * @param int $goodsId
     * @param int $goodsStatus
     * @return array
     */
    public function getById(string $userType, int $goodsId, int $goodsStatus = 0): array;

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
     * 根据名字进行模糊查询商品信息
     * @param string $goodsName
     * @param int $status
     * @return array
     */
    public function getByGoodsName(string $goodsName, int $status = 0): array;

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

    /**
     * 检测表中某个字段的值存在不存在这个表中
     * @param string $field
     * @param string $fieldType
     * @param string $fieldKey
     * @return array
     */
    public function getByField(string $field, string $fieldType, string $fieldKey): array;

    /**
     * 根据指定字段删除商品表中的一条数据
     * @param string $field
     * @param string $fieldType
     * @param string $fieldKey
     * @return bool
     */
    public function removeByField(string $field, string $fieldType, string $fieldKey): bool;


}