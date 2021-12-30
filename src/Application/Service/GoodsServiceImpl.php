<?php
namespace Application\Service;

use Application\Dao\GoodsCategoryDaoImpl;
use Application\Dao\GoodsDaoImpl;
use Application\Dao\GoodsIntroductionDaoImpl;
use Application\Dao\GoodsPictureDaoImpl;
use Application\Domain\Goods;
use Application\Domain\GoodsIntroduction;
use Application\Domain\GoodsPicture;
use Application\Helper\Filter;

class GoodsServiceImpl implements GoodsService
{
    /**
     * 商城主页显示信息用的
     * @return array[]
     */
    public function listIndex(): array
    {
        $resHot=(new GoodsDaoImpl())->listField(5,1,"goods_hot","1");
        $resRecommendation=(new GoodsDaoImpl())->listField(5,1,"goods_recommendation","1");
        $resNewest=(new GoodsDaoImpl())->listField(7,1,"goods_hot","1");

        $hot=(new Goods())->GoodsModel($resHot);
        $recommend=(new Goods())->GoodsModel($resRecommendation);
        $newest=(new Goods())->GoodsModel($resNewest);

         return array(
            "hot"=>$hot,
            "recommend"=>$recommend,
            "newest"=>$newest
        );

    }

    /**
     * 单个商品详情页面
     * @param string $userType
     * @param int $id
     * @return array
     */
    public function listGoodsIdShow(string $userType,int $id): array
    {
        /** 判断用户还是管理员 */
        if ($userType=='admin') {
            /** 管理员执行的 */
            $resGoods=(new GoodsDaoImpl())->getById('admin',$id);
            if (count($resGoods) >0 ) {
                /** 商品存在 */
                $resImg=(new GoodsPictureDaoImpl())->getGoodsId($id);
                $resText=(new GoodsIntroductionDaoImpl())->getGoodsId($id);
            } else {
                /** 没有这个商品 */
                $resImg=array();
                $resText=array();
            }
        } else {
            /** 用户查询的 */
            $resGoods=(new GoodsDaoImpl())->getById('user',$id,1);
            if (count($resGoods) >0 ) {
                $resImg=(new GoodsPictureDaoImpl())->getGoodsId($id);
                $resText=(new GoodsIntroductionDaoImpl())->getGoodsId($id);
            }  else {
                /** 没有这个商品 */
                $resImg=array();
                $resText=array();
            }

        }

        /** 数据进行组装输出*/
        $goods=(new Goods())->GoodsModel($resGoods);
        $img=(new GoodsPicture())->pictureModel($resImg);
        $text=(new GoodsIntroduction())->introductionModel($resText);
        $categoryList=(new GoodsCategoryDaoImpl())->listCategory();
        return array(
            "goods"=>$goods,
            "categoryList"=>$categoryList,
            "goodsIntroduce"=>$text,
            "goodsPicture"=>$img
        );

    }

//    /**
//     * 根据名字进行模糊查询
//     * @param string $goodsName
//     * @return array
//     */
//    public function getByGoodsName(string $goodsName): array
//    {
//        $res=(new GoodsDaoImpl())->getByGoodsName($goodsName,1);
//        return (new Goods())->GoodsModel($res);
//    }


    public function updateGoodsById(int $goodsId, string $name, int $categoryId, float $prick, int $stock, int $status = 1,
                                    int $hot = 2, int $recommendation = 2, string $describe = "", string $img = ""): bool
    {
        // TODO: Implement updateGoodsById() method.
        /**  检验数据类型*/
        /** 判断这个商品id存在不存在 */
        /** 检查商品名是否已经存在 */
        /** 权限比对 */
        /** 执行修改商品信息操作 */
        /** 回调函数 */
        /** ...... */
    }
}