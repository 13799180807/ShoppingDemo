<?php

class GoodsCategoryServiceImpl implements GoodsCategoryService
{

    /**
     * @return array
     * 获取所有分类
     */
    public static function listGoodsCategoryName() : array
    {
        // TODO: Implement listGoodsCategoryName() method.
        $conn=Connection::conn();
        $res=GoodsCategoryDaoImpl::listGoodsCategoryName($conn);
        $conn->close();
        return $res;
    }

    /**
     * @param $categoryId
     * @param $num
     * @param int $status
     * @return int
     * 根据分类名数量得出页码
     */
    public static function countGoodsCategoryId($categoryId, $num, $status = 1) : int
    {
        // TODO: Implement countGoodsCategoryId() method.
        $conn=Connection::conn();
        $res=GoodsCategoryDaoImpl::countGoodsCategoryId($conn,$categoryId,$num,$status);
        $conn->close();
        return $res;

    }

    /**
     * @param $categoryId
     * @param $page
     * @param $num
     * @param int $status
     * @return array
     * 根据分类内容进行查询显示
     */
    public static function listGoodsCategoryPagination($categoryId, $page, $num, $status = 1) :array
    {
        $conn=Connection::conn();
        $res=GoodsCategoryDaoImpl::listGoodsCategoryPagination($conn,$categoryId,$page,$num);
        $conn->close();
        return $res;

    }

    /**
     * @param $categoryId
     * @return array
     * 获取当个信息
     */
    public static function getGoodsCategoryId($categoryId) :array
    {
        $conn=Connection::conn();
        $res=GoodsCategoryDaoImpl::getGoodsCategoryId($conn,$categoryId);
        $conn->close();
        return $res;
    }
}