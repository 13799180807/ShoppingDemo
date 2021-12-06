<?php
require 'GoodsCategoryDaoImpl.php';
interface GoodsCategoryDao
{
    /**
     * @param $conn
     * @return mixed
     * 获取所有的分类
     */
    public static function listGoodsCategoryName($conn);

    /**
     * @param $conn
     * @param $categoryId
     * @param $num
     * @param int $status
     * @return mixed
     */
    public static function countGoodsCategoryId($conn,$categoryId,$num,$status=1);

    /**
     * @param $conn
     * @param $categoryId
     * @param $page
     * @param $num
     * @param int $status
     * @return mixed
     */
    public static function listGoodsCategoryPagination($conn,$categoryId,$page,$num,$status=1);

    /**
     * @param $conn
     * @param $categoryId
     * @return mixed
     * 获取一个分类信息
     */
    public static function getGoodsCategoryId($conn,$categoryId);


}