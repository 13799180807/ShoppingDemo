<?php

        Route::any(function (){
        header("Content-type:Application/json;charset=utf-8");

        $parame=parameterList($_REQUEST);
        if(uri($_SERVER["REQUEST_URI"])=="/index")
        {
              echo GoodsController::homePageInformation($parame);
        }
        elseif(uri($_SERVER["REQUEST_URI"])=="/index/product")
        {
            echo GoodsController::productPageInformation($parame);
        }
        elseif (uri($_SERVER["REQUEST_URI"])=="/index/search")
        {
            echo GoodsController::fuzzyQuery($parame);
        }
        elseif (uri($_SERVER["REQUEST_URI"])=="/index/category"){
            echo GoodsCategoryController::categoryPageInformation($parame);
        }
        else{
            echo "<h2>404</h2>";
        }
    });


