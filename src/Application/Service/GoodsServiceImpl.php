<?php
namespace Application\Service;

use Application\Dao\GoodsDaoImpl;
use Application\Dao\GoodsIntroductionDaoImpl;
use Application\Dao\GoodsPictureDaoImpl;
use Application\Domain\Goods;
use Application\Helper\FilterHelper;

class GoodsServiceImpl implements GoodsService
{

    /**
     * 商城主页显示信息用的
     * @return array[]
     */
    public function listIndex(): array
    {
        $fields=array(
            'goodsId','goodsName','goodsCategoryId','goodsPrice','goodsImg',
        );
        $fields=splicing($fields);

        //热门  推荐产品  最新商品
        $resHot=(new GoodsDaoImpl())->listField($fields,"goods_hot","1",1,5);
        $resRecommendation=(new GoodsDaoImpl())->listField($fields,"goods_recommendation","1",1,5);
        $resNewest=(new GoodsDaoImpl())->listField($fields,"created_at","1",1,7);

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
     * @param int $id
     * @return array
     */
    public function listGoodsIdShow(int $id): array
    {
        $data=array(
            'id'=>$id
        );
        /** 安全过滤 */
        $data=FilterHelper::safeReplace($data);
        $fields=array(
            'goodsId','goodsName','goodsCategoryId','goodsPrice','goodsStock',
            'goodsHot','goodsRecommendation','goodsDescribe','goodsImg', 'createdAt',
        );
        $fields=splicing($fields);

        /** 查询对应数据 */
        $resGoods=(new GoodsDaoImpl())->getById($fields,$data['id'],1);
        $resImg=(new GoodsPictureDaoImpl())->getGoodsId("*",$data['id']);
        $resText=(new GoodsIntroductionDaoImpl())->getGoodsId("*",$data['id']);

        /** 判断是否有数据 */
        $goods=(new Goods())->GoodsModel($resGoods);
        $img=(new Goods())->GoodsModel($resImg);
        $text=(new Goods())->GoodsModel($resText);

        return array(
            "goods"=>$goods,
            "goodsIntroduce"=>$text,
            "goodsPicture"=>$img
        );

    }

    /**
     * 根据名字进行模糊查询
     * @param string $goodsName
     * @return array
     */
    public function getGoodsNameFuzzy(string $goodsName): array
    {
        $data=array(
            'goodsName'=>$goodsName,
        );
        $data=FilterHelper::safeReplace($data);
        $fields=array(
            'goodsId','goodsName','goodsCategoryId','goodsPrice','goodsImg',
        );
        $fields=splicing($fields);
        $goodsName="%".$data['goodsName']."%";
        $res=(new GoodsDaoImpl())->getByGoodsName($fields,1,$goodsName);
        return (new Goods())->GoodsModel($res);

    }





}