<?php
require 'GoodsCategoryServiceImpl.php';
interface GoodsCategoryService
{
    /**
     * @return mixed
     *获取分类所有信息
     */
    public static function listGoodsCategoryName();

    /**
     * @param $categoryId
     * @param $num
     * @param int $status
     * @return mixed
     * 根据分类获取页码
     */
    public static function countGoodsCategoryId($categoryId,$num,$status=1);

    /**
     * @param $categoryId
     * @param $page
     * @param $num
     * @param int $status
     * @return mixed
     * 分局分类查询获取对应结果
     */
    public static function listGoodsCategoryPagination($categoryId,$page,$num,$status=1);

    /**
     * @param $categoryId
     * @return mixed
     * 获取一个分类信息
     */
    public static function getGoodsCategoryId($categoryId);




}