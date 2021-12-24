<?php
namespace Application\Service;
interface GoodsCategoryService
{
    /**
     * 获取一个分类信息
     * @param int $categoryId
     * @return mixed
     */
    public function getGoodsCategoryId(int $categoryId) :array;

    /**
     * 根据分类获取页码
     * @param int $categoryId
     * @param int $num
     * @return int
     */
    public function countGoodsCategoryId(int $categoryId,int $num) :int;

    /**
     * 获取分类所有信息
     * @return array
     */
    public function listGoodsCategoryName() :array;


    /**
     * 分页分类查询获取对应结果
     * @param int $categoryId
     * @param int $page
     * @param int $num
     * @return array
     */
    public function listGoodsCategoryIndex(int $categoryId,int  $page,int  $num) :array;

    /**
     * 删除一个分类
     * @param int $categoryId
     * @return bool
     */
    public function removeByGoodsCategoryId(int $categoryId) :bool;


    /**
     * 管理员界面管理商品分类查询
     * @param array $dataArr
     * @return array
     */
    public function listAdminIndex(array $dataArr) :array;











}