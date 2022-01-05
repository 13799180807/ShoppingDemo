<?php


namespace Application\Controller\Admin;

use Application\Exception\Log;
use Application\Helper\DetectRequest;
use Application\Helper\FeedBack;
use Application\Library\SqlUtil;
use Application\Service\GoodsCategoryServiceImpl;
use Application\Service\GoodsServiceImpl;

class GoodsController
{

    /**
     * 获取分类归类
     */
    public function actionClassify()
    {
        $res=(new GoodsCategoryServiceImpl())->listCategory();
        echo FeedBack::result('200', '数据获取成功', $res);

    }

    /**
     * 管理员查看单个商品详细
     */
    public function actionDetail()
    {

        /** 检测请求的数据是否存在 */
        $resRequest = DetectRequest::detectRequest(array('goodsId' => "id"));
        if ($resRequest[0]) {
            /** 得到请求的数据 */
            $requestData = $resRequest[1];
            /** 检测数据是否符合规范 */
            $detect = array(
                0 => array('id', $requestData['goodsId'], 'numInt', 1, 100000),
            );

            $resDetect = DetectRequest::detectRun($detect);
            if (count($resDetect) == 0) {
                /** 数据合法执行查询 */
                $data = (new GoodsServiceImpl())->listGoodsIdShow('admin', $requestData['goodsId']);
                echo FeedBack::result('200', '数据获取成功', $data);
                return;
            }
            echo FeedBack::result('404', '请求的参数不规范，请联系管理员。', $resDetect);
            return;
        }
        echo FeedBack::fail($resRequest[1]);
    }

    /**
     * 管理员添加商品
     */
    public function actionAddGoods()
    {
        /** 判断提交的数据是否满足需求 */
        $resRequest = DetectRequest::detectRequest(array(
            'goodsName' => "name",//名字
            'goodsCategoryId' => "category",//分类id
            'goodsPrice' => "price",//价格
            'goodsStock' => "stock", //库存
            'goodsStatus' => "status", //状态
            'goodsDescribe' => "describe",//简要说明
            'goodsIntroduction' => "introduction", //详细说明
            'goodsHot' => "hot",//热度
            'recommendation' => "recommendation",//推荐
        ));
        if ($resRequest[0] ) {
            $requestData = $resRequest[1];
            /** 检验数据是否符合规范 */
            $resDetect = DetectRequest::detectRun(array(
                0 => array('name', $requestData['goodsName'], 'str', 1, 16),
                1 => array('category', $requestData['goodsCategoryId'], 'numInt', 1, 10),
                2 => array('price', $requestData['goodsPrice'], 'num', 1, 100000),
                3 => array('stock', $requestData['goodsStock'], 'numInt', 1, 100000),
                4 => array('status', $requestData['goodsStatus'], 'numInt', 0, 10),
                5 => array('describe', $requestData['goodsDescribe'], 'str', 0, 100),
                6 => array('introduction', $requestData['goodsIntroduction'], 'str', 0, 10000),
                7 => array('hot', $requestData['goodsHot'], 'numInt', 0, 5),
                8 => array('recommendation', $requestData['recommendation'], 'numInt', 0, 5),
            ));
            if (count($resDetect) == 0) {
                /** 符合规范传递数据 */
                $res=(new GoodsServiceImpl())->saveGoods($requestData['goodsName'],$requestData['goodsCategoryId'],$requestData['goodsPrice'],$requestData['goodsStock'],
                    $requestData['goodsStatus'],$requestData['goodsHot'],$requestData['recommendation'],$requestData['goodsDescribe'],"",$requestData['goodsIntroduction']);
                echo FeedBack::result('200', $res['msg']);
                return;
            }
            /** 类型不符合 */
            echo FeedBack::result('404', '请求的参数不规范，请联系管理员。', $resDetect);
            return;
        }
        /** 失败了 */
        echo FeedBack::fail($resRequest[1]);



    }


    /** 更新商品信息 */
    public function actionUpdatedGoods()
    {
        /** 判断提交的数据是否都有我要的 */
        $request = array(
            'goodsId' => "goodsId", //id
            'goodsName' => "name",//名字
            'goodsCategoryId' => "category",//分类id
            'goodsPrice' => "price",//价格
            'goodsStock' => "stock", //库存
            'goodsStatus' => "status", //状态
            'goodsDescribe' => "describe",//简要说明
            'goodsIntroduction' => "introduction", //详细说明
            'goodsHot' => "hot",//热度
            'recommendation' => "recommendation",//推荐
        );
        $resRequest = DetectRequest::detectRequest($request);
        if ($resRequest[0]) {
            $requestData = $resRequest[1];

            /** 检测提交的类型是不是正确的 */
            $detect = array(
                0 => array('id', $requestData['goodsId'], 'numInt', 1, 100000),
                1 => array('name', $requestData['goodsName'], 'str', 1, 16),
                2 => array('category', $requestData['goodsCategoryId'], 'numInt', 1, 10),
                3 => array('price', $requestData['goodsPrice'], 'num', 1, 100000),
                4 => array('stock', $requestData['goodsStock'], 'numInt', 1, 100000),
                5 => array('status', $requestData['goodsStatus'], 'numInt', 0, 10),
                6 => array('describe', $requestData['goodsDescribe'], 'str', 1, 100),
                7 => array('introduction', $requestData['goodsIntroduction'], 'str', 1, 10000),
                8 => array('hot', $requestData['goodsHot'], 'numInt', 0, 5),
                9 => array('recommendation', $requestData['recommendation'], 'numInt', 0, 5),
            );
            $resDetect = DetectRequest::detectRun($detect);
            if (count($resDetect) == 0) {
                /** 执行更新操作 */
                $res = (new GoodsServiceImpl())->updateGoodsById($requestData['goodsId'], $requestData['goodsName'], $requestData['goodsCategoryId'],
                    $requestData['goodsPrice'], $requestData['goodsStock'], $requestData['goodsStatus'], $requestData['goodsHot'], $requestData['recommendation'],
                    $requestData['goodsDescribe'], '1.jpg', $requestData['goodsIntroduction']);
                echo FeedBack::result('200', $res['msg']);
                return;
            }
            /** 类型不符合 */
            echo FeedBack::result('404', '请求的参数不规范，请联系管理员。', $resDetect);
            return;
        }
        /** 失败了 */
        echo FeedBack::fail($resRequest[1]);


//为完成
        /** 检测是否有照片要更新 */
        /** 返回结果 */
        /** 照片提交单独处理 */

//        header("Content-type:Application/json;charset=utf-8");
//        echo FeedBack::result('200','数据获取成功',"12");

//        if(empty($_FILES['mainPhoto']['name']))
//        {
//            /** 检查照片有没有提交 */
//            (new Log())->run("没有提交");
//        }
//        else
//        {
//            (new Log())->run("提交了");
//            $arr=explode('.',$_FILES['mainPhoto']['name']);
//            $newFileName='upload/'.time().'.'.$arr[1];
//            echo $newFileName;
//            move_uploaded_file($_FILES['mainPhoto']['tmp_name'],$newFileName);
//        }


    }

}