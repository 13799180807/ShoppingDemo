<?php
namespace Application\Service;
use Application\Dao\GoodsCategoryDaoImpl;
use Application\Dao\GoodsDaoImpl;
use Application\Dao\GoodsIntroductionDaoImpl;
use Application\Dao\GoodsPictureDaoImpl;
use Application\Domain\Goods;
use Application\Domain\GoodsCategory;
use Application\Exception\Log;
use Application\Helper\Filter;

class GoodsCategoryServiceImpl implements GoodsCategoryService
{

    /**
     * 分类查询显示用的
     * @param string $userType
     * @param int $page
     * @param int $num
     * @param int $status
     * @param int $categoryId
     * @param string $name
     * @param int $hot
     * @param int $recommendation
     * @return array
     */
    public function listGoodsCategory(string $userType,int $page,int $num,int $status,int $categoryId=0,string $name="",int $hot=0,int $recommendation=0): array
    {

        /** 区分用户 */
        if ($userType=='admin') {
            /**获得数量*/
            $totalPage=(new GoodsCategoryDaoImpl())->countCategoryByGoodsCondition($name,$status,$categoryId,$hot,$recommendation);
            /** 查询对应分页信息 */
            $goodsList=(new GoodsCategoryDaoImpl())->listGoodsCategory('admin',$name,$status,$categoryId,$hot,$recommendation,$page,$num);

        } else {
            /** 获得数量 */
            $totalPage=(new GoodsCategoryDaoImpl())->countCategoryByGoodsCondition("",$status,$categoryId);

            /** 查询分页的商品信息 */
            $goodsList=(new GoodsCategoryDaoImpl())->listGoodsCategory('user',$name,$status,$categoryId,0,0,$page,$num);

        }

        /** 统计页码 */
        $totalPage=ceil($totalPage/$num);

        /** 获取所有分类信息 */
        $categoryList=(new GoodsCategoryDaoImpl())->listCategory();

        if ($categoryId==0)
        {
            $categoryName="不限";
        } else{
            $res=(new GoodsCategoryDaoImpl())->getGoodsCategoryId($categoryId);
            if (count($res)>0){
                $categoryName=$res[0]["goods_category_name"];
            } else {
                $categoryName="未分类";
            }

        }

        $categoryList=(new GoodsCategory())->categoryModel($categoryList);
        $goodsList=(new Goods())->GoodsModel($goodsList);
        //回调信息
        $callBack=array(
            "totalPage"=>$totalPage,
            "page"=>$page,
            "num"=>$num,
            "categoryId"=>$categoryId,
            "categoryName"=>$categoryName
        );
        return array(
            "category"=>$categoryList,
            "goodsList"=>$goodsList,
            "callBack"=>$callBack
        );

    }

//
//    /**
//     * 删除一个分类
//     * @param int $categoryId
//     * @return bool
//     */
//    public function removeByGoodsCategoryId(int $categoryId): bool
//    {
//        /** 未进行权限比对 */
//        $data=array(
//            'id'=>$categoryId,
//        );
//        /** 安全过滤 */
//        $data=Filter::safeReplace($data);
//
//        /** 执行删除 */
//        (new GoodsCategoryDaoImpl())->removeByGoodsCategoryId($data['id']);
//
//        /** 获取这个分类在商品表中有几个数值 */
//        $resData=(new GoodsDaoImpl())->listGoodsCategoryId("goods_id",$data['id']);
//
//        if (count($resData) >0)
//        {
//            foreach ($resData as $row){
//                $goodsId=$row['goods_id'];
//                /** 执行删除图片和详情表信息 */
//                (new GoodsIntroductionDaoImpl())->removeByGoodsId($goodsId);
//                (new GoodsPictureDaoImpl())->removeByGoodsId($goodsId);
//            }
//        }
//        /** 删除商品表中该分类所有信息*/
//        (new GoodsDaoImpl())->removeByGoodsCategoryId($data['id']);
//        $msg="xxx执行了删除编号为 ".$data['id'] ." 的分类";
//        (new Log())->run($msg);
//        return true;
//
//    }

//    /**
//     * 获取所有分类
//     * @return array
//     */
//    public function listGoodsCategoryName() : array
//    {
//        $res=(new GoodsCategoryDaoImpl())->listCategory();
//        return (new GoodsCategory())->categoryModel($res);
//    }


}