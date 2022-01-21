<?php


if (!function_exists('deleteFile')) {
    /**
     * 删除文件
     * @param string $path
     */
    function deleteFile(string $path)
    {
        /** 检车文件是否存在 */
        if (file_exists($path)) {
            /** 文件存在 执行删除 */
            unlink($path);
        }
    }
}

if (!function_exists('payPwd')) {
    /**
     * 1加密 2验证密码是否正确  正确返回1 密码错误返回-1
     * @param int $type
     * @param string $pwd
     * @param string|null $codePwd
     * @return string
     */
    function payPwd(int $type, string $pwd, string $codePwd = null): string
    {
        if ($type == 1) {
            /** 加密操作 */
            $pwd_peppered = hash_hmac("sha256", $pwd, "20211108");
            return password_hash($pwd_peppered, PASSWORD_ARGON2ID);
        }
        $pwd=$pwd_peppered = hash_hmac("sha256", $pwd, "20211108");
        /** 验证密码是否正确 */
        if (password_verify($pwd, $codePwd)) {
            return "1";
        }
        return "-1";
    }
}

if (!function_exists('encryption')) {
    /**
     * 密码加密处理
     * @param string $account
     * @param string $pwd
     * @return string
     */
    function encryption(string $account, string $pwd): string
    {
        /**获取账号密码长度 */
        $aLen = mb_strlen($account);
        $pLen = mb_strlen($pwd);

        /** 截取账号密码组成key字符串 */
        $key = iconv_substr($pwd, 1, ceil($pLen / 2)) . iconv_substr($account, 0, ceil($aLen / 2));

        /** MD5加密 截取长度 */
        $key = iconv_substr(MD5($key), 25, 6);
        $account = iconv_substr(MD5($account), 15, 10);
        $pwd = iconv_substr(MD5($pwd), ceil($pLen / 2), 16);

        /** 拼接密码 */
        return $key . $pwd . $account;

    }
}

if (!function_exists('Splicing')) {
    /**
     * 查询字段拼接
     * @param array $fields
     * @return string
     */
    function splicing(array $fields): string
    {
        $str = "";
        foreach ($fields as $value) {
            if ($value == "*") {
                return "*";
            } else {
                $value = humpToUnderLine($value);
                $str = $str . $value . ",";
            }
        }
        return trim($str, ",");
    }

}

if (!function_exists('safeReplace')) {
    /**
     * 安全过滤函数防止xss攻击代码
     * @param string $str
     * @return string
     */
    function safeReplace(string $str): string
    {
        $str = str_replace('%20', '', $str);
        $str = str_replace('%27', '', $str);
        $str = str_replace('%2527', '', $str);
        $str = str_replace('*', '', $str);
        $str = str_replace('"', '&quot;', $str);
        $str = str_replace("'", '', $str);
        $str = str_replace('"', '', $str);
        $str = str_replace(';', '', $str);
        $str = str_replace('<', '&lt;', $str);
        $str = str_replace('>', '&gt;', $str);
        $str = str_replace("{", '', $str);
        $str = str_replace('}', '', $str);
        $str = str_replace('\\', '', $str);
        return $str;
    }

}

if (!function_exists('escapeString')) {
    /**
     * 转义字符串 防止sql注入
     * @param string $str
     * @return string
     */
    function escapeString(string $str): string
    {
        $pattern = "/(select[\s])|(insert[\s])|(update[\s])|(delete[\s])|(from[\s])|(where[\s])|(drop[\s])/i";

        /** 检测变量是否是数组 */
        if (is_array($str)) {

            foreach ($str as $key => $value) {
                /** 使用反斜线引用字符串 去除首位字符串 */
                $str[$key] = addslashes(trim($value));

                /** 执行匹配正则表达式 */
                if (preg_match($pattern, $str[$key])) {
                    $str[$key] = '';
                }
            }
        } else {
            /** 使用反斜线引用字符串  去除首位字符串*/
            $str = addslashes(trim($str));

            /** 执行匹配正则表达式 */
            if (preg_match($pattern, $str)) {
                $str = '';
            }
        }
        return $str;
    }

}

if (!function_exists('underscoreToHump')) {
    /**
     * 下划线转驼峰命名
     * step1.原字符串转小写,原字符串中的分隔符用空格替换,在字符串开头加上分隔符
     * step2.将字符串中每个单词的首字母转换为大写,再去空格,去字符串首部附加的分隔符.
     * @param $str
     * @param string $val
     * @return string
     */
    function underscoreToHump($str, $val = '_'): string
    {
        $str = $val . str_replace($val, " ", strtolower($str));
        return ltrim(str_replace(" ", "", ucwords($str)), $val);
    }
}

if (!function_exists('humpToUnderLine')) {
    /**
     * 驼峰转下划线
     * step:小写和大写紧挨一起的地方,加上分隔符,然后全部转小写
     * @param $str
     * @param string $val
     * @return string
     */
    function humpToUnderLine($str, $val = '_'): string
    {
        return strtolower(preg_replace('/([a-z])([A-Z])/', "$1" . $val . "$2", $str));
    }
}




