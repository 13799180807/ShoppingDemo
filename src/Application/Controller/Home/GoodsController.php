<?php
namespace Application\Controller\Home;
use Application\Helper\DetectRequest;
use Application\Helper\FeedBack;
use Application\Helper\Filter;
use Application\Service\GoodsCategoryServiceImpl;
use Application\Service\GoodsServiceImpl;

class GoodsController
{

    /** 首页界面显示用的 */
    public function actionIndex()
    {

        if ( isset($_POST['method']) && $_POST['method']=="list"){

            $data=(new GoodsServiceImpl())->listIndex();
            echo FeedBack::result(200,"请求成功",$data);

        }else{
            echo FeedBack::fail("请求不正确，请正确传参");
        }
    }

    /** 单个商品详情页面用的  */
    public function actionShow()
    {
        /** 对前端请求进行判断检测 */
        $resRequest = DetectRequest::detectRequest(array('id'=>"id"));
        if ($resRequest[0]) {
            /** 获得前端请求的数据 */
            $requestData=$resRequest[1];
            $detectData=array(
                0=>array('id',$requestData['id'],"numInt",1,100000),
            );

            $resDetectData=DetectRequest::detectRun($detectData);
            if (count($resDetectData) == 0) {

                $data=(new GoodsServiceImpl())->listGoodsIdShow("user",$requestData['id']);
                echo FeedBack::result(200,"请求成功",$data);
                return;
            }
            /** 数据不符合规范 */
            echo FeedBack::result('404','参数请求错误',$resDetectData);
            return;
        }
        echo FeedBack::fail($resRequest[1]);

    }

    /** 模糊查询 */
    public function actionFuzzy()
    {
        $resRequest = DetectRequest::detectRequest(array('fuzzy'=>"fuzzy"));
        if ($resRequest[0]) {
            $requestData=$resRequest[1];
            $detectData=array(
                0=>array('fuzzy',$requestData['fuzzy'],"str",0,10),
            );
            $resDetectData=DetectRequest::detectRun($detectData);
            if (count($resDetectData) == 0) {
                $res=(new GoodsCategoryServiceImpl())->listGoodsCategory("user",1,1000,1, 0,$requestData['fuzzy']);
                echo FeedBack::result(200,"请求成功",$res['goodsList']);
                return;
            }
            /** 数据不符合规范 */
            echo FeedBack::result('404','参数请求错误',$resDetectData);
            return;
        }
        echo FeedBack::fail($resRequest[1]);

    }


}