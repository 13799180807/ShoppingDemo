<?php
namespace Application\Controller;
use Application\Helper\FeedBack;
use Application\Helper\FilterHelper;
use Application\Service\GoodsServiceImpl;

class GoodsController
{

    /** 首页界面显示用的 */
    public function actionIndex()
    {
        /** 初级统一过滤*/
        (new FilterHelper())->filterAny();

        if ( count($_POST)==1 && isset($_POST['method']) && $_POST['method']=="list"){

            $data=(new GoodsServiceImpl())->listIndex();
            echo FeedBack::result(200,"请求成功",$data);

        }else{
            echo FeedBack::fail("请求不正确，请正确传参");
        }
    }

    /** 单个商品详情页面用的  */
    public function actionShow()
    {
        if ( count($_POST)==1 && isset($_POST['id']) && $_POST!="" && is_numeric($_POST['id'])){

            $goodsId=$_POST["id"];
            $data=(new GoodsServiceImpl())->listGoodsIdShow($goodsId);
            echo FeedBack::result(200,"请求成功",$data);

        }else{
            echo FeedBack::fail("请求不正确，请正确传参");
        }

    }

    /** 模糊查询 */
    public function actionFuzzy()
    {
        if (count($_POST)==1 && isset($_POST['fuzzy']) && $_POST['fuzzy']!="" )
        {
            $data=(new GoodsServiceImpl())->getGoodsNameFuzzy($_POST['fuzzy']);
            echo FeedBack::result(200,"请求成功",$data);
        }
        else{
            echo FeedBack::fail("请求不正确，请正确传参");
        }

    }


}