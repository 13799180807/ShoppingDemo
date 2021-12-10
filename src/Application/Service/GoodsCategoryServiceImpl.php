<?php
namespace src\Application\Service;
use src\Application\Dao\GoodsCategoryDaoImpl;
use src\Application\Library\Connection;
use src\Application\Model\GoodsCategoryModel;
use src\Application\Model\GoodsModel;

class GoodsCategoryServiceImpl implements GoodsCategoryService
{

    /**
     * @return array
     * 获取所有分类
     */
    public static function listGoodsCategoryName() : array
    {
        $conn=Connection::conn();
        $res=GoodsCategoryDaoImpl::listGoodsCategoryName($conn);
        $conn->close();
        if (count($res)>0)
        {
            return GoodsCategoryModel::categoryInformation($res);
        }
        return array();
    }

    /**
     * 根据分类名数量得出页码
     * @param int $categoryId
     * @param int $num
     * @param int $status
     * @return int
     */
    public static function countGoodsCategoryId(int $categoryId,int $num,int $status = 1) : int
    {
        $conn=Connection::conn();
        $res=GoodsCategoryDaoImpl::countGoodsCategoryId($conn,$categoryId,$num,$status);
        $conn->close();
        return $res;

    }

    /**
     * 根据分类内容进行查询显示
     * @param int $categoryId
     * @param int $page
     * @param int $num
     * @param int $status
     * @return array
     */
    public static function listGoodsCategoryPagination(int $categoryId,int $page,int $num,int $status = 1) :array
    {
        $conn=Connection::conn();
        $res=GoodsCategoryDaoImpl::listGoodsCategoryPagination($conn,$categoryId,$page,$num);
        $conn->close();
        if (count($res) >0)
        {
            return GoodsModel::homeInformationDisplay($res);
        }
        return array();

    }

    /**
     * 获取当个信息分类信息
     * @param int $categoryId
     * @return array
     *
     */
    public static function getGoodsCategoryId(int $categoryId) : array
    {
        $conn=Connection::conn();
        $res=GoodsCategoryDaoImpl::getGoodsCategoryId($conn,$categoryId);
        $conn->close();
        return $res;
    }
}