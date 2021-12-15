<?php
namespace Application\Service;
interface GoodsCategoryService
{

    /**
     * 根据分类id进行删除这个分类
     * @param int $categoryId
     * @return mixed
     */
    public static function deleteByGoodsCategoryId(int $categoryId);

    /**
     * @return mixed
     *获取分类所有信息
     */
    public static function listGoodsCategoryName();

    /**
     * 根据分类获取页码
     * @param int $categoryId
     * @param int $num
     * @param int $status
     * @return mixed
     */
    public static function countGoodsCategoryId(int $categoryId,int $num,int  $status=1);

    /**
     * 分页分类查询获取对应结果
     * @param int $categoryId
     * @param int $page
     * @param int $num
     * @param int $status
     * @return mixed
     */
    public static function listGoodsCategoryPagination(int $categoryId,int  $page,int  $num,int $status=1);

    /**
     * 获取一个分类信息
     * @param int $categoryId
     * @return mixed
     */
    public static function getGoodsCategoryId(int $categoryId);




}