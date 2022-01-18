<?php


namespace Application\Controller\Admin;

use Application\Helper\FeedBack;
use Application\Helper\Request;
use Application\Service\GoodsCategoryServiceImpl;
use Application\Service\GoodsPictureServiceImpl;
use Application\Service\GoodsServiceImpl;
use Application\Upload\Upload;

class GoodsController
{
    /**
     * 获取商品的所有分类类别
     */
    public function actionClassify()
    {
        $res = (new GoodsCategoryServiceImpl())->listCategory();
        echo FeedBack::result(200, '数据获取成功', $res);
    }

    /**
     * 管理员查看单个商品详细
     */
    public function actionDetail()
    {
        /** 检测请求的数据是否存在 */
        $goodsId = Request::param("id", "i");

        /** 检测数据是否符合规范 */
        $data = Request::detect(array(
            0 => array('id', $goodsId, 'intSize', 1, 100000),
        ));

        if ($data['status']) {
            /** 数据合法执行查询 */
            $data = (new GoodsServiceImpl())->listGoodsIdShow('admin', $goodsId);
            echo FeedBack::result(200, '数据获取成功', $data);
            return;
        }
        echo FeedBack::fail("参数请求不规范", $data['err']);

    }

    /**
     * 管理员添加商品
     */
    public function actionAddGoods()
    {
        /** 获取前端提交的数据 */
        $goodsName = Request::param("name", "s");
        $goodsCategoryId = Request::param("category", "i");
        $goodsPrice = Request::param("price", "f");
        $goodsStock = Request::param("stock", "i");
        $goodsStatus = Request::param("status", "i");
        $goodsDescribe = Request::param("describe", "s");
        $goodsIntroduction = Request::param("introduction", "s");
        $goodsHot = Request::param("hot", "i");
        $recommendation = Request::param("recommendation", "i");

        /** 检验数据是否符合规范 */
        $data = Request::detect(array(
            0 => array('name', $goodsName, 'length', 1, 16),
            1 => array('category', $goodsCategoryId, 'intSize', 1, 10),
            2 => array('price', $goodsPrice, 'numSize', 1, 100000),
            3 => array('stock', $goodsStock, 'intSize', 1, 100000),
            4 => array('status', $goodsStatus, 'intSize', 0, 10),
            5 => array('describe', $goodsDescribe, 'length', 0, 100),
            6 => array('introduction', $goodsIntroduction, 'length', 0, 10000),
            7 => array('hot', $goodsHot, 'intSize', 0, 5),
            8 => array('recommendation', $recommendation, 'intSize', 0, 5),
        ));
        if ($data['status']) {

            /** 判断有没有图片上传 上传的数据是否合法 */
            $upload = new Upload('mainImg');
            $resFile = $upload->save('upload', [
                'ext' => 'jpg,jpeg,png,gif', #限制格式
                'size' => 1024 * 10 * 10 * 10 * 5  #B  5M以内
            ]);
            if ($resFile['status']) {
                $fileMsg = $resFile['msg'];
                $fileData = $resFile['data'];
                $imgName = $fileData['saveName'];
            } else {
                $fileMsg = $resFile['msg'];
                $imgName = "";
            }

            $res = (new GoodsServiceImpl())->saveGoods($goodsName, $goodsCategoryId, $goodsPrice, $goodsStock,
                $goodsStatus, $goodsHot, $recommendation, $goodsDescribe, $imgName, $goodsIntroduction);

            $callBack = array(
                'images' => $fileMsg,
            );
            echo FeedBack::result(200, $res['msg'], $callBack);
            return;
        }
        /** 类型不符合 */
        echo FeedBack::fail("参数请求不规范", $data['err']);

    }


    /** 管理员添加图片 */
    public function actionSaveImg()
    {
        /** 获取前端请求数据 */
        $goodsId = Request::param("goodsId", "i");
        $filesNum = Request::param("filesNum", "i");

        /** 判断数据是否符合类型 */
        $data = Request::detect(array(
            0 => array('goodsId', $goodsId, 'intSize', 1, 100000),
            1 => array('filesNum', $filesNum, 'intSize', 0, 50)
        ));

        if ($data['status']) {
            /** 执行更新操作 */
            if ($filesNum == count($_FILES)) {

                $fileArr = array();
                for ($a = 1; $a <= $filesNum; $a++) {
                    $fileName = "imgFile" . $a;
                    $upload = new Upload($fileName);
                    $resFile = $upload->save('upload', [
                        'ext' => 'jpg,jpeg,png,gif', #限制格式
                        'size' => 1024 * 10 * 10 * 10 * 10  #B  5M以内
                    ]);
                    if ($resFile['status']) {
                        $fileData = $resFile['data'];
                        $imgName = $fileData['saveName'];
                        $fileArr[] = $imgName;
                    }
                }
                if (count($fileArr) == 0) {

                    echo FeedBack::result(400, '检测照片为空添加失败');
                    return;
                }

                $res = (new GoodsPictureServiceImpl())->saveByGoodsId($goodsId, $fileArr);
                if ($res['status']) {
                    echo FeedBack::result(200, $res['msg']);
                    return;
                }
                echo FeedBack::result(404, $res['msg']);
                return;
            }
            echo FeedBack::result(404, '上传照片与数量不符合');
            return;
        }
        /** 类型不符合 */
        echo FeedBack::fail("参数请求不规范", $data['err']);

    }


    /** 更新商品信息 */
    public function actionUpdatedGoods()
    {
        /** 检测请求 */
        $data = Request::only(
            array("goodsId", "name", "category", "price", "stock", "status", "describe", "introduction", "hot", "recommendation"),
            array("i", "s", "i", "f", "i", "i", "s", "s", "i", "i")
        );
        /** 数据检测 */
        $detectData = Request::detect(array(
            0 => array('id', $data['goodsId'], 'intSize', 1, 100000),
            1 => array('name', $data['name'], 'length', 1, 16),
            2 => array('category', $data['category'], 'intSize', 1, 10),
            3 => array('price', $data['price'], 'numSize', 1, 100000),
            4 => array('stock', $data['stock'], 'intSize', 1, 100000),
            5 => array('status', $data['status'], 'intSize', 0, 10),
            6 => array('describe', $data['describe'], 'length', 0, 50),
            7 => array('introduction', $data['introduction'], 'length', 0, 1000),
            8 => array('hot', $data['hot'], 'intSize', 0, 5),
            9 => array('recommendation', $data['recommendation'], 'intSize', 0, 5)
        ));

        if ($detectData['status']) {
            /** 执行更新操作 */

            /** 图片检测 */
            $upload = new Upload('mainImg');
            $resFile = $upload->token("123456789")->save('upload', [
                'ext' => 'jpg,jpeg,png,gif', #限制格式
                'size' => 1024 * 10 * 10 * 10 * 5  #B  5M以内
            ]);

            /** 判断照片有没跟新成功 */
            if ($resFile['status']) {
                $fileData = $resFile['data'];
                $imgName = $fileData['saveName'];
            } else {
                $imgName = "";
            }
            $fileMsg = $resFile['msg'];

            $res = (new GoodsServiceImpl())->updateGoodsById($data['goodsId'], $data['name'], $data['category'], $data['price'], $data['stock'], $data['status'],
                $data['hot'], $data['recommendation'], $data['describe'], $imgName, $data['introduction']);
            echo FeedBack::result(200, $res['msg'], array(
                'mainImg' => $fileMsg
            ));
            return;
        }
        /** 类型不符合 */
        echo FeedBack::fail("参数请求不规范", $data['err']);
    }


}