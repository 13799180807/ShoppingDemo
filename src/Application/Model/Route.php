<?php


class Route
{
    /**
     * @param $rows
     * @param $key
     * @return int|mixed
     * 匹配路由
     */
    public static function matching($rows,$key)
    {

        foreach (array_keys($rows) as $val) {
            if ($val == $key) {
                return $rows[$val];
            }
        }
        return -1;
    }
//    public static function Uri(){
//
//    }
}