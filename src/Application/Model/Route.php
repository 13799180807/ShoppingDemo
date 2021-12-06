<?php


class Route
{

    public static function define() :array
    {
        return array(
            "/index",
            "/index/product",
            "/index/search",
            "/index/category",

        );
    }

    /**
     * @param $function
     */
    public static function any($function){
        $function();
    }

}