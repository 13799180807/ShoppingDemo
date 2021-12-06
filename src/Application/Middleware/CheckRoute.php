<?php


class CheckRoute
{

    /**
     * @param $rows
     * @param $key
     * @return bool
     */
    public static function matching($rows,$key): bool
    {
        foreach (array_keys($rows) as $val) {

            if ($rows[$val] == $key) {
                return true;
            }
        }
        return false;
    }
}