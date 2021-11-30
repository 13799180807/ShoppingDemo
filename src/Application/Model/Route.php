<?php


class Route
{

    public static function define(){
        $routeList=array(
            "/index",
            "/index/details",
            "/index/details/img",
            "/index/details/text",
            "/index/waressort",
            "/index/sort/page",
            "/index/sort/waresall",
            "/index/search",
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