<?php

    Route::any(function (){
        header("Content-type:Application/json;charset=utf-8");

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
        }elseif (uri($_SERVER["REQUEST_URI"])=="/index/waressort"){
             $json=SortController::waresSortList($parame);
             echo $json;
        }elseif (uri($_SERVER["REQUEST_URI"])=="/index/sort/page"){
            $json=SortController::waresSortPageList($parame);
            echo $json;
        }elseif (uri($_SERVER["REQUEST_URI"])=="/index/sort/waresall"){
            $json=SortController::sortPageWaresAll($parame);
            echo $json;
        }
        else{
            echo "<h2>404</h2>";
        }
    });


