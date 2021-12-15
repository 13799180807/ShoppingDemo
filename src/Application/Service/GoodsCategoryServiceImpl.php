<?php
namespace Application\Service;
use Application\Dao\GoodsCategoryDaoImpl;
use Application\Dao\GoodsDaoImpl;
use Application\Dao\GoodsIntroductionDaoImpl;
use Application\Dao\GoodsPictureDaoImpl;
use Application\Exception\Log;
use Application\Helper\FilterHelper;
use Application\Library\Connection;
use Application\Model\GoodsCategoryModel;
use Application\Model\GoodsModel;

class GoodsCategoryServiceImpl implements GoodsCategoryService
{

    /**
     * 删除一个分类
     * @param int $categoryId
     * @return bool
     */
    public static function deleteByGoodsCategoryId(int $categoryId): bool
    {
        /** 未进行权限比对 */

        $conn=Connection::conn();
        $data=array(
            'id'=>$categoryId,
        );
        /** 安全过滤 */
        $data=FilterHelper::safeReplace($data);

        /** 执行删除 */
         GoodsCategoryDaoImpl::deleteByGoodsCategoryId($conn,$data['id']);

         /** 获取这个分类在商品表中有几个数值 */
         $resData=GoodsDaoImpl::listGoodsCategoryId($conn,$data['id']);

         if (count($resData)>0)
         {
             foreach ($resData as $row)
             {
                 $goodsId=$row['goods_id'];
                 /** 执行删除图片和详情表信息 */
                 GoodsIntroductionDaoImpl::deleteByGoodsId($conn,$goodsId);
                 GoodsPictureDaoImpl::deleteByGoodsId($conn,$goodsId);
             }
         }
         /** 删除商品表中该分类所有信息*/
          GoodsDaoImpl::deleteByGoodsCategoryId($conn,$data['id']);
          $msg="xxx执行了：删除一个分类";
         (new Log())->run($msg);

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