<?php

        Route::any(function (){
        header("Content-type:Application/json;charset=utf-8");

        $params=parameterList($_REQUEST);
        if(uri($_SERVER["REQUEST_URI"])=="/index")
        {
              echo GoodsController::homePageInformation($params);
        }
        elseif(uri($_SERVER["REQUEST_URI"])=="/index/product")
        {
            echo GoodsController::productPageInformation($params);
        }
        elseif (uri($_SERVER["REQUEST_URI"])=="/index/search")
        {
            echo GoodsController::fuzzyQuery($params);
        }
        elseif (uri($_SERVER["REQUEST_URI"])=="/index/category"){
            echo GoodsCategoryController::categoryPageInformation($params);
        }
        else{
            echo "<h2>404</h2>";
        }
    });


