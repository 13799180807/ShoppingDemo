<?php


namespace Application\Helper;


class Filter
{

    /**
     * 过滤ip一下
     * @param string $ip
     * @return string
     */
    public static function filterIp(string $ip = ""): string
    {
        return filter_var($ip, FILTER_VALIDATE_IP);
    }

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

    /**
     * 写入数据库的防止xss攻击
     * @param array $data
     * @return array
     */
    public static function preventXss(array $data): array
    {
        $res = array();
        foreach ($data as $value) {
            $res[] = htmlentities($value);
        }
        return $res;
    }

}