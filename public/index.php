<?php
require '../src/settings.php';





    if(CheckRoute::matching(Route::define(),uri($_SERVER["REQUEST_URI"]))){

         include "../src/routes.php";
    }else{
        header("Content-type:Application/json;charset=utf-8");
        echo 404;
    }






