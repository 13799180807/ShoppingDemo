<?php
namespace Application\Controller\Home;

use Application\Helper\DetectRequest;
use Application\Helper\FeedBack;
use Application\Service\GoodsCategoryServiceImpl;

class CategoryController
{
    /** 分类页面 */
    public function actionClassification()
    {

        /** 数据判断获取请求 */
        $request = array(
            'categoryId'=>"id",
            'page'=>"page",
            'num'=>"num",
        );
        /** 对前端请求进行判断检测 */
        $resRequest = DetectRequest::detectRequest($request);
        if ($resRequest[0]) {

            /** 获得前端请求的数据 */
            $requestData=$resRequest[1];
            $detectData=array(
                0=>array('id',$requestData['categoryId'],"numInt",0,100),
                1=>array('page',$requestData['page'],"numInt",1,9999),
                2=>array('num',$requestData['num'],"numInt",1,99),
            );

            $resDetectData=DetectRequest::detectRun($detectData);
            /** 判断数据符合规范没有 */
            if (count($resDetectData) == 0) {
                /** 获取数据 */
                $data=(new GoodsCategoryServiceImpl())->listGoodsCategory('user',$requestData['page'],$requestData['num'],1,$requestData['categoryId']);
                echo FeedBack::result(200,"请求成功",$data);
                return;
            }
            /** 数据不符合规范 */
            echo FeedBack::result('404','参数请求错误',$resDetectData);
            return;
        }
        /** 失败 */
        echo FeedBack::fail($resRequest[1]);

    }








}