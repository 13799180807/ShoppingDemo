<?php


class Route
{

    public static function define(){
        $routeList=array(
            "/index",
            "/index/product",
            "/index/search",
            "/index/category",

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