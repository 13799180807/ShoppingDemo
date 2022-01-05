<?php

namespace Application\Dao;
interface GoodsCategoryDao
{
    /**
     * 获取商品表所有分类
     * @return array
     */
    public function listCategory(): array;

    /**
     * 根据商品表中的条件进行统计一共满足条件有多少个数量返回int
     * @param string $goodsName
     * @param int $goodsStatus
     * @param int $categoryId
     * @param int $goodsHot
     * @param int $goodsRecommendation
     * @return int
     */
    public function countCategoryByGoodsCondition(string $goodsName = "", int $goodsStatus = 0,
                                                  int $categoryId = 0, int $goodsHot = 0,
                                                  int $goodsRecommendation = 0): int;

    /**
     * 根据条件进行查询分页输出
     * @param string $userType
     * @param string $goodsName
     * @param int $goodsStatus
     * @param int $goodsCategoryId
     * @param int $goodsHot
     * @param int $goodsRecommendation
     * @param int $page
     * @param int $num
     * @return array
     */
    public function listCategoryGoods(string $userType, string $goodsName, int $goodsStatus, int $goodsCategoryId,
                                      int $goodsHot, int $goodsRecommendation, int $page, int $num): array;

    /**
     * 获取一个分类信息
     * @param int $categoryId
     * @return array
     */
    public function getGoodsCategoryId(int $categoryId): array;

    /**
     * 根据id删除这个分类
     * @param int $categoryId
     * @return bool
     */
    public function removeByGoodsCategoryId(int $categoryId): bool;


}