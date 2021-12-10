<?php


if(!function_exists('underscoreToHump')){
    /**
     * 下划线转驼峰命名
     * step1.原字符串转小写,原字符串中的分隔符用空格替换,在字符串开头加上分隔符
     * step2.将字符串中每个单词的首字母转换为大写,再去空格,去字符串首部附加的分隔符.
     * @param $str
     * @param string $val
     * @return string
     */
    function underscoreToHump($str, $val='_'): string
    {
        $str = $val. str_replace($val, " ", strtolower($str));
        return ltrim(str_replace(" ", "", ucwords($str)), $val );
    }
}
if(!function_exists('humpToUnderLine')){
    /**
     * 驼峰转下划线
     * step:小写和大写紧挨一起的地方,加上分隔符,然后全部转小写
     * @param $str
     * @param string $val
     * @return string
     */
    function humpToUnderLine($str, $val='_'): string
    {
        return strtolower(preg_replace('/([a-z])([A-Z])/', "$1" . $val . "$2", $str));
    }
}




