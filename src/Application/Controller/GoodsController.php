<?php


class GoodsController
{
    /**
     * @param $parameter
     * @return false|string
     * 主页页面显示信息
     */
    public static function homePageInformation($parameter){

        if (isset($parameter["method"]) && $parameter["method"]!="" && $parameter["method"]=="list"){
            //热门  推荐产品  最新商品
            $hot=GoodsServiceImpl::listByfield("goods_hot","1","1",5);
            $recommend=GoodsServiceImpl::listByfield("goods_recommend","1","1",5);
            $newest=GoodsServiceImpl::listByfield("created_at","1","1",7);

            $hot=GoodsModel::homePageinformationDisplay($hot);
            $recommend=GoodsModel::homePageinformationDisplay($recommend);
            $newest=GoodsModel::homePageinformationDisplay($newest);

            $res=array(
                "hot"=>$hot,
                "recommend"=>$recommend,
                "newest"=>$newest
            );
            $json=successJson("获取成功",$res);
            return $json;

        }else{
            $errlist=array();
            $errlist['err']="请输入正确值";
            $json=failJson("请求失败，参数不正确", $errlist);
            return $json;
        }
    }

    public static function productPageInformation($parameter){

        if(isset($parameter["id"]) && $parameter["id"]!="" && is_numeric($parameter['id'])){
//            $goodsId=$parameter["id"];
//            $a=GoodsServiceImpl::getById(1);
//            var_dump($a);



        }else{
            $errlist=array();
            $errlist['err']="请输入正确值";
            $json=failJson("请求失败，参数不正确", $errlist);
            return $json;
        }


    }


}