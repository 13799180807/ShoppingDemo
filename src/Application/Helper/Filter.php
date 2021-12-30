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
    public static function setEntities(array $data) :array
    {
        $res=array();
        foreach ($data as $key=>$value) {
            $res[$key]=htmlentities($value);
        }
        return $res;
    }






//    /**
//     * 检测数字判断
//     * @param array $arr
//     * @return bool
//     */
//    public function numeric(array $arr) :bool
//    {
//        foreach ($arr as $val)
//        {
//            if (isset($_POST[$val]) && is_numeric($_POST[$val])) {
//
//            }else{
//                return false;
//            }
//        }
//        return true;
//    }

//    /**
//     * 过滤部分post请求防止sql注入
//     * @param array $data
//     * @return bool
//     */
//    public function filterPost(array $data) :bool
//    {
//        foreach ($data as $val)
//        {
//            /** 存在这个post 判断 */
//            if (isset($_POST[$val])) {
//                /** 处理post请求 */
//                $_POST[$val]=escapeString($_POST[$val]);
//            } else{
//                return false;
//            }
//        }
//        return true;
//
//    }


//    /** 统一对post get 请求做处理防止 sql 注入 暂时用不到 */
//    public  function filterAny()
//    {
//        /** 统一过滤post里面的高位词防止sql注入 */
//        foreach ($_POST as $key=> $value)
//        {
//            $_POST[$key]=escapeString($value);
//        }
//
//        /** 统一过滤掉get 里面高危词防止sql注入 */
//        foreach ($_GET as $key=> $value)
//        {
//            $_GET[$key]=escapeString($value);
//        }
//
//    }

//    /**
//     * 安全过滤函数 防止xss攻击代码
//     * @param array $arr
//     * @return array
//     */
//    public static function safeReplace(array $arr) :array
//    {
//        $dataArr=array();
//        foreach ($arr as $key=> $value)
//        {
//            $dataArr[$key]=safeReplace($value);
//        }
//        return $dataArr;
//
//    }



}