<?php


namespace Application\Helper;


class Filter
{
    /**
     * 为了防止XSS攻击
     * 把字符转换为 HTML 实体
     * 使用htmlentites()函数过滤再存入数据库
     * @param array $data
     * @return array
     */
    public static function setEntities(array $data): array
    {
        $res = array();
        foreach ($data as $key => $value) {
            $res[$key] = htmlentities($value);
        }
        return $res;
    }

}