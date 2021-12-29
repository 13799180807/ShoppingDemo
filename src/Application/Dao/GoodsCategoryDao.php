<?php
namespace Application\Dao;
interface GoodsCategoryDao
{
    /**
     * 获取商品表所有分类
     * @return array
     */
    public function listCategory() : array;

    /**
     * 根据商品表中的条件进行统计一共满足条件有多少个数量返回int
     * @param string $goods_name
     * @param int $goods_status
     * @param int $category_id
     * @param int $goods_hot
     * @param int $goods_recommendation
     * @return int
     */
    public function countCategoryByGoodsCondition(string $goods_name="",int $goods_status=0,
                                                  int $category_id=0,int $goods_hot=0 ,
                                                  int $goods_recommendation=0) :int;
    /**
     * 根据条件进行查询分页输出
     * @param string $userType
     * @param string $goods_name
     * @param int $goods_status
     * @param int $goods_category_id
     * @param int $goods_hot
     * @param int $goods_recommendation
     * @param int $page
     * @param int $num
     * @return array
     */
    public function listGoodsCategory(string $userType, string $goods_name, int $goods_status, int $goods_category_id,
                                      int $goods_hot, int $goods_recommendation, int $page, int $num) :array;

    /**
     * 获取一个分类信息
     * @param int $categoryId
     * @return array
     */
    public function getGoodsCategoryId(int $categoryId) :array;

    /**
     * 根据id删除这个分类
     * @param int $categoryId
     * @return bool
     */
    public function removeByGoodsCategoryId(int $categoryId) :bool;













}