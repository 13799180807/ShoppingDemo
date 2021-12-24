<?php
namespace Application\Dao;
interface GoodsCategoryDao
{
    /**
     * 获取商品表所有分类
     * @param string $fields
     * @return array
     */
    public function listGoodsCategoryName(string $fields) : array;

    /**
     * 统计页码 传入分类,显示数量得到页码
     * @param int $categoryId
     * @param int $num
     * @param int $status
     * @return int
     */
    public function countGoodsCategoryId(int $categoryId, int $num,int $status=1) : int;

    /**
     * 分页查询显示
     * @param string $fields
     * @param int $categoryId
     * @param int $page
     * @param int $num
     * @param int $status
     * @return array
     */
    public function listGoodsCategoryPagination(string $fields,int $categoryId,int $page,int $num,int $status=1) :array;

    /**
     * 获取一个分类信息
     * @param string $fields
     * @param int $categoryId
     * @return array
     */
    public function getGoodsCategoryId(string $fields,int $categoryId) :array;

    /**
     * 根据id删除这个分类
     * @param int $categoryId
     * @return bool
     */
    public function removeByGoodsCategoryId(int $categoryId) :bool;

    /**
     * 管理员分类接口管理
     * @param array $dataList
     * @return array
     */
    public function listAdminIndex(array $dataList) :array;

    /**
     * 管理员界面分类查询统计
     * @param int $num
     * @param array $dataList
     * @return int
     */
    public function countListAdminIndex(int $num,array $dataList) :int;






}