<?php


namespace Application\Helper;


class FilterHelper
{


    /**
     * 过滤部分post请求
     * @param array $data
     * @return bool
     */
    public function filterPost(array $data) :bool
    {
        foreach ($data as $val)
        {
            /** 存在这个post 判断 */
            if (isset($_POST[$val])) {
                /** 处理post请求 */
                $_POST[$val]=escapeString($_POST[$val]);
            } else{
                return false;
            }
        }
        return true;

    }


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