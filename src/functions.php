<?php


if (!function_exists('safeReplace'))
{
    /**
     * 安全过滤函数防止xss攻击代码
     * @param string $str
     * @return string
     */
    function safeReplace(string $str) : string
    {
        $str = str_replace('%20','',$str);
        $str = str_replace('%27','',$str);
        $str = str_replace('%2527','',$str);
        $str = str_replace('*','',$str);
        $str = str_replace('"','&quot;',$str);
        $str = str_replace("'",'',$str);
        $str = str_replace('"','',$str);
        $str = str_replace(';','',$str);
        $str = str_replace('<','&lt;',$str);
        $str = str_replace('>','&gt;',$str);
        $str = str_replace("{",'',$str);
        $str = str_replace('}','',$str);
        $str = str_replace('\\','',$str);
        return $str;
    }

}

if (!function_exists('escapeString'))
{
    /**
     * 转义字符串 防止sql注入
     * @param string $str
     * @return string
     */
    function escapeString(string $str) : string
    {
        $pattern = "/(select[\s])|(insert[\s])|(update[\s])|(delete[\s])|(from[\s])|(where[\s])|(drop[\s])/i";
        if (is_array($str))
        {
            foreach ($str as $key=> $value)
            {
                $str[$key] = addslashes(trim($value));
                if(preg_match($pattern,$str[$key]))
                {
                    $str[$key] = '';
                }
            }
        } else {
            $str=addslashes(trim($str));
            if(preg_match($pattern,$str))
            {
                $str = '';
            }
        }
        return $str;
    }

}

if(!function_exists('underscoreToHump'))
{
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

if(!function_exists('humpToUnderLine'))
{
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




