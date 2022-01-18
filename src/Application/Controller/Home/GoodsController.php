<?php

namespace Application\Controller\Home;

use Application\Helper\FeedBack;
use Application\Helper\Request;
use Application\Service\GoodsCategoryServiceImpl;
use Application\Service\GoodsServiceImpl;

class GoodsController
{

    /** 首页界面显示用的 */
    public function actionIndex()
    {
        if (isset($_POST['method']) && $_POST['method'] == "list") {

            $data = (new GoodsServiceImpl())->listIndex();
            echo FeedBack::result(200, "请求成功", $data);

        } else {
            echo FeedBack::fail("请求不正确，请正确传参");
        }
    }

    /** 单个商品详情页面用的  */
    public function actionShow()
    {
        $id = Request::param("id", "i");

        /** 对前端请求进行判断检测 */
        $data = Request::detect(array(
            0 => array('id', $id, "intSize", 1, 100000),
        ));
        if ($data['status']) {

            $data = (new GoodsServiceImpl())->listGoodsIdShow("user", $id);
            echo FeedBack::result(200, "请求成功", $data);
            return;
        }
        /** 数据不符合规范 */
        echo FeedBack::fail("参数请求不规范",$data['err']);
    }


    /** 模糊查询 */
    public function actionFuzzy()
    {
        $fuzzy = Request::param("fuzzy", "s");

        $data = Request::detect(array(
            0 => array('fuzzy', $fuzzy, "length", 0, 16),
        ));
        if ($data['status']) {
            $res = (new GoodsCategoryServiceImpl())->listCategoryGoods("user", 1, 1000, 1, 0, $fuzzy);
            echo FeedBack::result(200, "请求成功", $res['goodsList']);
            return;
        }
        /** 数据不符合规范 */
        echo FeedBack::fail("参数请求不规范",$data['err']);

    }


}