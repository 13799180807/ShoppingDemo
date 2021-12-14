<?php
namespace src\Application\Service;
use src\Application\Dao\GoodsCategoryDaoImpl;
use src\Application\Dao\GoodsDaoImpl;
use src\Application\Helper\FilterHelper;
use src\Application\Library\Connection;
use src\Application\Model\GoodsCategoryModel;
use src\Application\Model\GoodsModel;

class GoodsCategoryServiceImpl implements GoodsCategoryService
{

    /**
     * 删除一个分类
     * @param int $categoryId
     * @return bool
     */
    public static function deleteGoodsCategoryId(int $categoryId): bool
    {
        $conn=Connection::conn();
        $data=array(
            'id'=>$categoryId,
        );
        /** 安全过滤 */
        $data=FilterHelper::safeReplace($data);

        /** 执行删除 */
         GoodsCategoryDaoImpl::deleteGoodsCategoryId($conn,$data['id']);

         /** 查询该分类下存在的商品id 以数组形式返回,然后根据这些进行删除操作*/
         // GoodsDaoImpl::deleteGoodsCategoryId($conn,$data['id']);

        return true;

    }

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
        $data=array(
            'id'=>$categoryId,
            'num'=>$num,
            'status'=>$status
        );
        /** 安全过滤 */
        $data=FilterHelper::safeReplace($data);
        $conn=Connection::conn();
        $res=GoodsCategoryDaoImpl::countGoodsCategoryId($conn,$data['id'],$data['num'],$data['status']);
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
        $data=array(
          'id'=>$categoryId,
          'page'=>$page,
          'num'=>$num,
          'status'=>$status
        );
        /** 安全过滤 */
        $data=FilterHelper::safeReplace($data);
        $conn=Connection::conn();
        $res=GoodsCategoryDaoImpl::listGoodsCategoryPagination($conn,$data['id'],$data['page'],$data['num'],$data['status']);
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
        $data=array(
          'id'=>$categoryId,
        );
        /** 安全过滤 */
        $data=FilterHelper::safeReplace($data);
        $conn=Connection::conn();
        $res=GoodsCategoryDaoImpl::getGoodsCategoryId($conn,$data['id']);
        $conn->close();
        return $res;
    }

}