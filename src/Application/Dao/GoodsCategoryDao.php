<?php
namespace Application\Dao;
interface GoodsCategoryDao
{
    /**
     * 获取所有的分类
     * @param $conn
     * @return mixed
     */
    public static function listGoodsCategoryName($conn);

    /**
     * 统计页码
     * @param $conn
     * @param int $categoryId
     * @param int $num
     * @param int $status
     * @return mixed
     */
    public static function countGoodsCategoryId($conn, int $categoryId, int $num,int $status=1);

    /**
     * 分页查询显示
     * @param $conn
     * @param int $categoryId
     * @param int $page
     * @param int $num
     * @param int $status
     * @return mixed
     */
    public static function listGoodsCategoryPagination($conn,int $categoryId,int $page,int $num,int $status=1);

    /**
     * 获取一个分类信息
     * @param $conn
     * @param int $categoryId
     * @return mixed
     */
    public static function getGoodsCategoryId($conn,int $categoryId);

    /**
     * 根据id删除这个分类
     * @param $conn
     * @param int $categoryId
     * @return mixed
     */
    public static function deleteByGoodsCategoryId($conn, int $categoryId);




}