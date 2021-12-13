<?php


namespace src\Application\Helper;


class FilterHelper
{
    /** 统一对post get 请求做处理防止 sql 注入 */
    public  function filterAny()
    {
        /** 统一过滤post里面的高位词防止sql注入 */
        foreach ($_POST as $key=> $value)
        {
            $_POST[$key]=escapeString($value);
        }

        /** 统一过滤掉get 里面高危词防止sql注入 */
        foreach ($_GET as $key=> $value)
        {
            $_GET[$key]=escapeString($value);
        }

    }

    /**
     * 安全过滤函数 防止xss攻击代码
     * @param array $arr
     * @return array
     */
    public static function safeReplace(array $arr) :array
    {
        $dataArr=array();
        foreach ($arr as $key=> $value)
        {
            $dataArr[$key]=safeReplace($value);
        }
        return $dataArr;

    }



}