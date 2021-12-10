<?php


namespace core;


use src\Application\Controller\GoodsCategoryController;
use src\Application\Controller\GoodsController;

class Web
{
    /**
     * 这里执行控制器上的东西
     * @param $key
     */
    public function run($key){

        header("Content-type:Application/json;charset=utf-8");

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
            /** 出错啦 */
            echo '出错啦';

        }

    }

}