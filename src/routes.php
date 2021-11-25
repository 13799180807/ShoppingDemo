<?php

    Route::any(function (){


        $parame=parameterList($_REQUEST);
        if(uri($_SERVER["REQUEST_URI"])=="/index"){
            $json=WaresController::waresSortAll($parame);
            echo $json;
        }elseif(uri($_SERVER["REQUEST_URI"])=="/index/details"){
            $json=WaresController::waresDetailsAll($parame);
            echo $json;
        }elseif(uri($_SERVER["REQUEST_URI"])=="/index/details/img"){
            $json=WaresController::waresImgAll($parame);
            echo $json;
        }elseif(uri($_SERVER["REQUEST_URI"])=="/index/details/text"){
            $json=WaresController::waresTextAll($parame);
            echo $json;
        }
        else{

            echo "<h2>404</h2>我进来了但是迷路了......";
        }



    });


