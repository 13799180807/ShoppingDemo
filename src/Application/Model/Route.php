<?php


class Route
{

    public static function define(){
        $routeList=array(
            "/index",
            "/index/details",
            "/index/details/img",
            "/index/details/text"
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