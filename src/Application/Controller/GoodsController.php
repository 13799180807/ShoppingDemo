<?php
namespace src\Application\Controller;
use src\Application\Helper\ResultJson;
use src\Application\Service\GoodsIntroductionServiceImpl;
use src\Application\Service\GoodsPictureServiceImpl;
use src\Application\Service\GoodsServiceImpl;

class GoodsController
{
    /** 首页界面显示用的 */
    public  function homePageInformation()
    {
        if (isset($_POST['method']) && $_POST['method']=="list"){

            //热门  推荐产品  最新商品
            $hot=GoodsServiceImpl::listField("goods_hot","1","1",5);
            $recommend=GoodsServiceImpl::listField("goods_recommendation","1","1",5);
            $newest=GoodsServiceImpl::listField("created_at","1","1",7);

            $res=array(
                "hot"=>$hot,
                "recommend"=>$recommend,
                "newest"=>$newest
            );

            echo ResultJson::result(200,"请求成功",$res);

        }else{
            $error=array();
            $error['err']="参数错误";
            echo ResultJson::result(400,"请求出错",$error);
        }
    }

    /** 单个商品详情页面用的  */
    public  function productPageInformation()
    {

        if (isset($_POST['id']) && $_POST!="" && is_numeric($_POST['id'])){

            $goodsId=$_POST["id"];

            $goods=GoodsServiceImpl::getById($goodsId);
            $goodsPicture=GoodsPictureServiceImpl::getGoodsId($goodsId);
            $goodsIntroduce=GoodsIntroductionServiceImpl::getGoodsId($goodsId);

            $res=array(
                "goods"=>$goods,
                "goodsIntroduce"=>$goodsIntroduce,
                "goodsPicture"=>$goodsPicture
            );
            echo ResultJson::result(200,"请求成功",$res);

        }else{
            $error=array();
            $error['err']="参数错误";
            echo ResultJson::result(400,"请求出错",$error);
        }

    }

    /** 模糊查询 */
    public  function fuzzyQuery()
    {
        if (isset($_POST['fuzzy']) && $_POST['fuzzy']!="" )
        {
            $res=GoodsServiceImpl::getByGoodsName($_POST['fuzzy']);
            echo ResultJson::result(200,"请求成功",$res);
        }
        else{
            $error=array();
            $error['err']="参数错误";
            echo ResultJson::result(400,"请求出错",$error);
        }

    }


}