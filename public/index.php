<?php
    require '../src/settings.php';


    if(CheckRoute::matching(Route::define(),uri($_SERVER["REQUEST_URI"]))){
         include "../src/routes.php";
    }else{
     //   header("Content-type:Application/json;charset=utf-8");
           echo "<div style='color:grey ;font-family: 微软雅黑; margin-left: 45%;margin-top: 5%;' >
                         <span style='color: #d4f8ff; font-size: 100px;' >404</span>
                         </br>我进来了但是迷路了......
                 </div>";
    }






