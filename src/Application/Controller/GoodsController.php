<?php


class GoodsController
{
    /**
     * @param $parameter
     * @return false|string
     * 主页页面显示信息
     */
    public static function homePageInformation($parameter)
    {
        if (isset($parameter["method"]) && $parameter["method"]!="" && $parameter["method"]=="list"){
            //热门  推荐产品  最新商品

            $hot=GoodsModel::homeInformationDisplay(GoodsServiceImpl::listField("goods_hot","1","1",5));
            $recommend=GoodsModel::homeInformationDisplay(GoodsServiceImpl::listField("goods_recommend","1","1",5));
            $newest=GoodsModel::homeInformationDisplay(GoodsServiceImpl::listField("created_at","1","1",7));

            $res=array(
                "hot"=>$hot,
                "recommend"=>$recommend,
                "newest"=>$newest
            );

            return successJson("获取成功",$res);

        }else{
            $error=array();
            $error['err']="请输入正确值";
            return failJson("请求失败，参数不正确", $error);
        }
    }

    /**
     * @param $parameter
     * @return false|string
     * 详情页面使用
     */
    public static function productPageInformation($parameter)
    {
        if(isset($parameter["id"]) && $parameter["id"]!="" && is_numeric($parameter['id'])){
              $goodsId=$parameter["id"];

            $goods=GoodsServiceImpl::getById($goodsId);
            $goodsPicture=GoodsPictureServiceImpl::getGoodsId($goodsId);
            $goodsIntroduce=GoodsIntroduceServiceImpl::getGoodsId($goodsId);

            $goods=GoodsModel::productPageInformationDisplay($goods);
            $goodsIntroduce=GoodsModel::GoodsIntroduceInformationDisplay($goodsIntroduce);
            $goodsPicture=GoodsModel::GoodsPictureInformationDisplay($goodsPicture);

            $res=array(
                "goods"=>$goods,
                "goodsIntroduce"=>$goodsIntroduce,
                "goodsPicture"=>$goodsPicture
            );

            return successJson("获取成功",$res);


        }else{
            $error=array();
            $error['err']="请输入正确值";
            return failJson("请求失败，参数不正确", $error);
        }
    }
    /**
     * var_dump(GoodsServiceImpl::getByGoodsName("车1"));
     */
    public static function fuzzyQuery($parameter)
    {
        if(isset($parameter["fuzzy"]) && $parameter["fuzzy"]!="")
        {
            $fuzzy=GoodsServiceImpl::getByGoodsName($parameter["fuzzy"]);
            $res=GoodsModel::homeInformationDisplay($fuzzy);
            return successJson("获取成功",$res);
        }
        else{
            $error=array();
            $error['err']="请输入正确值";
            return failJson("请求失败，参数不正确", $error);
        }

    }


}