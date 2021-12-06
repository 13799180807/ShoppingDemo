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
        elseif (uri($_SERVER["REQUEST_URI"])=="/index/register"){
            $json=UserController::userRegister($parame);
            echo $json;
        }elseif (uri($_SERVER["REQUEST_URI"])=="/index/verificationCode"){
            header("Content-Type:image/jpeg");
        //    $clientIP=$_SERVER['REMOTE_ADDR'];
          //  session_start();
            $str=CharCode::randomCode();
          //  $_SESSION[$clientIP]=$str;
            CharCode::verificationCode($str);
        }
        else{
            echo "<h2>404</h2>";
        }
    });


