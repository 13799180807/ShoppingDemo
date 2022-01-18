<?php


namespace Application\Controller\Admin;

use Application\Helper\FeedBack;
use Application\Helper\Request;
use Application\Service\GoodsCategoryServiceImpl;

class CategoryController
{

    public function actionDemo()
    {

    }


    /**
     * 管理员管理商品分类查看查询，信息显示
     */
    public function actionClassification()
    {
        /** 获得前端的请求数据 */
        $name = Request::param("goodsName", "s");
        $status = Request::param("goodsStatus", "i");
        $label = Request::param("goodsLabel", "i");
        $category = Request::param("goodsCategory", "i");
        $num = Request::param("num", "i");
        $page = Request::param("page", "i");

        /** 数据检查是否是正确的 */
        $data = Request::detect(array(
            0 => array('goodsName', $name, "length", 0, 16),
            1 => array('goodsStatus', $status, "intSize", 0, 5),
            2 => array('goodsLabel', $label, "intSize", 0, 5),
            3 => array('goodsCategory', $category, "intSize", 0, 10),
            4 => array('num', $num, "intSize", 5, 50),
            5 => array('page', $page, "intSize", 0, 1000),

        ));
        if ($data['status']) {
            /**数据符合*/
            /** 前端传的值符合要求 */
            if ($label == 1) {
                $hot = 1;
                $recommendation = 0;
            } elseif ($label == 2) {
                $hot = 0;
                $recommendation = 1;
            } else {
                $hot = 0;
                $recommendation = 0;
            }
            /** 数据查询 */
            $res = (new GoodsCategoryServiceImpl())->listCategoryGoods("admin", $page, $num, $status,
                $category, $name, $hot, $recommendation);
            echo FeedBack::result(200, '请求成功', $res);
            return;

        }
        /** 返回错误信息 */
        echo FeedBack::fail("参数请求不规范",$data['err']);


    }


}