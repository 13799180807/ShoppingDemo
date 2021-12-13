<?php


namespace core;


use src\Application\Controller\GoodsCategoryController;
use src\Application\Controller\GoodsController;
use src\Application\Helper\FilterHelper;

class Web
{
    /**
     * 这里执行控制器上的东西
     * 顺便执行判断该控制器上方法存在不存在不存在则将去除
     * @param $key
     */
    public function run($key){

        header("Content-type:Application/json;charset=utf-8");

        /** 统一过滤 get post 请求的参数是否携带sql语句 */
        (new FilterHelper())->filterAny();

        /** 转发控制器 */
        if ($key=="GoodsHome")
        {
            (new GoodsController())->homePageInformation();
        }
        elseif ($key=="GoodsProduct")
        {
            (new GoodsController())->productPageInformation();
        }
        elseif ($key=="GoodsFuzzy")
        {
            (new GoodsController())->fuzzyQuery();

        }
        elseif ($key=="GoodsCategoryPage")
        {
           (new GoodsCategoryController())->categoryPageInformation();
        }
        else{
            echo FeedBack::result(404,"出错啦，页面不存在！！！","");

        }

    }

}