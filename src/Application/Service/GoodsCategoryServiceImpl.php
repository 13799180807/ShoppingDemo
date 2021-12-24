<?php
namespace Application\Service;
use Application\Dao\GoodsCategoryDaoImpl;
use Application\Dao\GoodsDaoImpl;
use Application\Dao\GoodsIntroductionDaoImpl;
use Application\Dao\GoodsPictureDaoImpl;
use Application\Domain\Goods;
use Application\Domain\GoodsCategory;
use Application\Exception\Log;
use Application\Helper\FilterHelper;

class GoodsCategoryServiceImpl implements GoodsCategoryService
{
    /**
     * 获取当个信息分类信息
     * @param int $categoryId
     * @return array
     *
     */
    public function getGoodsCategoryId(int $categoryId) : array
    {
        $data=array(
            'id'=>$categoryId,
        );
        /** 安全过滤 */
        $data=FilterHelper::safeReplace($data);
        $res=(new GoodsCategoryDaoImpl())->getGoodsCategoryId("*",$data['id']);
        return (new GoodsCategory())->categoryModel($res);
    }

    /**
     * 根据分类名数量得出页码
     * @param int $categoryId
     * @param int $num
     * @return int
     */
    public function countGoodsCategoryId(int $categoryId,int $num) : int
    {
        $data=array(
            'id'=>$categoryId,
            'num'=>$num,
        );
        /** 安全过滤 */
        $data=FilterHelper::safeReplace($data);
        return (new GoodsCategoryDaoImpl())->countGoodsCategoryId($data['id'],$data['num']);
    }

    /**
     * 获取所有分类
     * @return array
     */
    public function listGoodsCategoryName() : array
    {
        $res=(new GoodsCategoryDaoImpl())->listGoodsCategoryName("*");
        return (new GoodsCategory())->categoryModel($res);

    }

    /**
     * 分类主页查询用的
     * @param int $categoryId
     * @param int $page
     * @param int $num
     * @return array
     */
    public function listGoodsCategoryIndex(int $categoryId, int $page, int $num): array
    {
        $data=array(
            'id'=>$categoryId,
            'page'=>$page,
            'num'=>$num,
        );
        /** 安全过滤 */
        $data=FilterHelper::safeReplace($data);

        $fields=array(
            'goodsId','goodsName','goodsCategoryId','goodsPrice','goodsImg',
        );
        $fields=splicing($fields);

        /** 显示所有分类，页码，分页数据 */
        $categoryList=(new GoodsCategoryDaoImpl())->listGoodsCategoryName("*");
        $totalPage=(new GoodsCategoryDaoImpl())->countGoodsCategoryId($data['id'],$data['num']);
        $goodsList=(new GoodsCategoryDaoImpl())->listGoodsCategoryPagination($fields,$data['id'],$data['page'],$data['num']);
        if ($data['id']==0)
        {
            $categoryName="查询全部";
        } else{
            $res=(new GoodsCategoryDaoImpl())->getGoodsCategoryId("goods_category_name",1);
            $categoryName=$res[0]["goods_category_name"];
        }

        $categoryList=(new GoodsCategory())->categoryModel($categoryList);
        $goodsList=(new Goods())->GoodsModel($goodsList);
        //回调信息
        $callBack=array(
            "totalPage"=>$totalPage,
            "page"=>$data['page'],
            "num"=>$data['num'],
            "categoryId"=>$data['id'],
            "categoryName"=>$categoryName
        );
        return array(
            "category"=>$categoryList,
            "goodsList"=>$goodsList,
            "callBack"=>$callBack
        );

    }

    /**
     * 删除一个分类
     * @param int $categoryId
     * @return bool
     */
    public function removeByGoodsCategoryId(int $categoryId): bool
    {
        /** 未进行权限比对 */
        $data=array(
            'id'=>$categoryId,
        );
        /** 安全过滤 */
        $data=FilterHelper::safeReplace($data);

        /** 执行删除 */
        (new GoodsCategoryDaoImpl())->removeByGoodsCategoryId($data['id']);

        /** 获取这个分类在商品表中有几个数值 */
        $resData=(new GoodsDaoImpl())->listGoodsCategoryId("goods_id",$data['id']);

        if (count($resData) >0)
        {
            foreach ($resData as $row){
                $goodsId=$row['goods_id'];
                /** 执行删除图片和详情表信息 */
                (new GoodsIntroductionDaoImpl())->removeByGoodsId($goodsId);
                (new GoodsPictureDaoImpl())->removeByGoodsId($goodsId);
            }
        }
        /** 删除商品表中该分类所有信息*/
        (new GoodsDaoImpl())->removeByGoodsCategoryId($data['id']);
        $msg="xxx执行了删除编号为 ".$data['id'] ." 的分类";
        (new Log())->run($msg);
        return true;

    }

    /**
     * 管理员界面分类查询
     * @param array $dataArr
     * @return array
     */
    public function listAdminIndex(array $dataArr): array
    {
        /** 安全过滤 */
        $data=FilterHelper::safeReplace($dataArr);

        /** 取出数据并判断 */
        if ($data['name']=="") {
            $name="%";
        } else {
            $name="%".$data['name']."%";
        }

        if ($data['status']==2) {
            $status="%";
        } else {
            $status=$data['status'];
        }

        /** 1热门，2推荐，3全部 */
        if ($data['label']==1) {
            $hot="1";
            $recommendation="%";
        } elseif ($data['label']==2) {
            $hot="%";
            $recommendation="1";
        } else {
            $hot="%";
            $recommendation="%";
        }

        /** 分类 */
        if ($data['category']==0) {
            $category="%";
            $categoryOne=array(
                0=>array(
                    'goodsCategoryId'=>0,
                    'goodsCategoryName'=>'不限'
                )
            );
        } else {
            $category=$data['category'];
            /** 当前查询分类 */
            $res=(new GoodsCategoryDaoImpl())->getGoodsCategoryId("*",$data['category']);
            $categoryOne=(new GoodsCategory())->categoryModel($res);
        }

        $num=$data['num'];
        $start=($data['page']-1)*$num;

        /** 查询结果  */
        $res=(new GoodsCategoryDaoImpl())->listAdminIndex(array($name,$status,$category,$hot,$recommendation,$start,$num));
        $goodsList=(new Goods())->GoodsModel($res);
        /** 统计数量  */
        $count=(new GoodsCategoryDaoImpl())->countListAdminIndex($num,array($name,$status,$category,$hot,$recommendation));

        /** 所有分类 */
        $categoryList=$this->listGoodsCategoryName();


        return array(
            "goodsList"=>$goodsList,
            "category"=>$categoryList,
            "categoryOne"=>$categoryOne,
            "totalPage"=>$count, //根据查询返回的总页面
        );
    }
}