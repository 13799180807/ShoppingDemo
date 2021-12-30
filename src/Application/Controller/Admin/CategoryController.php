<?php


namespace Application\Controller\Admin;


use Application\Helper\DetectRequest;
use Application\Helper\FeedBack;
use Application\Service\GoodsCategoryServiceImpl;

class CategoryController
{

    /**
     * 管理员管理商品分类查看查询，信息显示
     */
    public function actionClassification()
    {
        /** 获取前端请求的数据 */
        $request = array(
            'name'=>"goodsName",
            'status'=>"goodsStatus",
            'label'=>"goodsLabel",
            'category'=>"goodsCategory",
            'num'=>"num",
            'page'=>"page",
        );

        /** 对前端请求进行判断检测 */
        $resRequest = DetectRequest::detectRequest($request);
        if ( $resRequest[0]) {

            /** 获得前端请求的数据 */
            $requestData=$resRequest[1];

            /** 对数据进行检测是否符合我要的规范 */
            $detectData=array(
              0=>array('goodsName',$requestData['name'],"str",0,10),
              1=>array('goodsStatus',$requestData['status'],"numInt",0,5),
              2=>array('goodsLabel',$requestData['label'],"numInt",0,5),
              3=>array('goodsCategory',$requestData['category'],"numInt",0,10),
              4=>array('num',$requestData['num'],"numInt",5,50),
              5=>array('page',$requestData['page'],"numInt",0,1000),
            );

            $resDetectData=DetectRequest::detectRun($detectData);
            if (count($resDetectData) == 0) {

                /** 前端传的值符合要求 */
               if ($requestData['label']==1) {
                   $hot=1;
                   $recommendation=0;
               } elseif ($requestData['label']==2) {
                   $hot=0;
                   $recommendation=1;
               } else {
                   $hot=0;
                   $recommendation=0;
               }
                /** 数据查询 */
                $res=(new GoodsCategoryServiceImpl())->listGoodsCategory("admin",$requestData['page'],$requestData['num'],$requestData['status'],
                    $requestData['category'],$requestData['name'],$hot,$recommendation);
                echo FeedBack::result('200','请求成功',$res);
                return;

            } else {
                echo FeedBack::result('404','参数请求错误',$resDetectData);
                return;
            }
        }
        echo FeedBack::fail($resRequest[1]);


    }




}