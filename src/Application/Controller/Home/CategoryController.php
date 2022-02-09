<?php

namespace Application\Controller\Home;


use Application\Helper\FeedBack;
use Application\Helper\Request;
use Application\Service\GoodsCategoryServiceImpl;

class CategoryController
{
    /** 分类页面 */
    public function actionClassification()
    {
        /** 数据判断获取请求 */
        $categoryId = Request::param("id", "i");
        $page = Request::param("page", "i");
        $num = Request::param("num", "i");

        /** 判断数据符合规范没有 */
        $data = Request::detect(array(
            0 => array('id', $categoryId, "intSize", 0, 100),
            1 => array('page', $page, "intSize", 1, 9999),
            2 => array('num', $num, "intSize", 1, 99)
        ));
        if (!$data['status']) {
            /** 数据不符合规范 */
            echo FeedBack::fail("查看失败，请求数据出错", $data['err']);
            return;
        }

        /** 获取数据 */
        $res = (new GoodsCategoryServiceImpl())->listCategoryGoods('user', $page, $num, 1, $categoryId);
        echo FeedBack::result(200, "请求成功", $res);


    }


}