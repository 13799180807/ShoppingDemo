<?php


class Route
{

    public static function define(){
        $routeList=array(
            "/index",
            "/index/product",
            "/index/waressort",
            "/index/sort/page",
            "/index/sort/waresall",
            "/index/search",
            "/index/register",
            "/index/verificationCode",

        );
        return $routeList;
    }

    /**
     * @param $function
     */
    public static function any($function){
        $function();
    }

}