<?php

namespace Application\Helper;

class DetectRequest
{
    /**
     * 检测请求是否符合
     * @param array $requestData
     * @return array
     */
    public static function detectRequest(array $requestData): array
    {
        $res = array();
        foreach ($requestData as $key => $val) {

            /** 检测是否存在这个post请求 存在则保存，不存在则退出 */
            if (isset($_POST[$val])) {
                $res[$key] = $_POST[$val];
            } else {
                return array(false, "请求参数不对,请核对以后再进行操作");
            }
        }
        return array(true, $res);
    }

    /**
     * 数组方式进行检测，成功则返回数组大小内容为0，否则就是错误的内容
     * @param array $detectData
     * @return array
     */
    public static function detectRun(array $detectData): array
    {
        $i = 0;
        $resArr = array();
        $err = array();

        /** 进行检测 */
        foreach ($detectData as $arr) {
            $res = self::detect($arr);
            $resArr[$i] = $res;
            $i++;
        }

        /** 检测出来那个错误并返回数组 */
        foreach ($resArr as $row) {
            if (!$row[1]) {
                $err[$row[0]] = $row[3];
            }
        }
        /** 正确进来的值返回的会是空数组大小为0 */
        return $err;
    }


    /**
     * 检测str长度，数字大小
     * @param array $arr
     * @return array
     */
    protected static function detect(array $arr): array
    {
        $method = $arr[2];
        switch ($method) {
            case 'num':
                return self::detectNumSize($arr[0], $arr[1], $arr[3], $arr[4]);
            case 'str':
                return self::detectLength($arr[0], $arr[1], $arr[3], $arr[4]);
            case 'numInt':
                return self::detectNumIntSize($arr[0], $arr[1], $arr[3], $arr[4]);
        }
        return array("", false, "", "错误数据");
    }


    /**
     * 检查数字大小是否规范和是否整形
     * @param $name
     * @param $num
     * @param $min
     * @param $max
     * @return array
     */
    protected static function detectNumIntSize($name, $num, $min, $max): array
    {

        if (preg_match("/^[0-9][0-9]*$/", $num)) {
            if ($num >= $min && $num <= $max) {
                return array($name, true, $num, "数值符合");
            }
        }
        return array($name, false, $num, "输入的数值不符合大小或类型不准确，请输入符合大小并输入正确类型");
    }

    /**
     * 检查数字大小是否规范
     * @param $name
     * @param $num
     * @param $min
     * @param $max
     * @return array
     */
    protected static function detectNumSize($name, $num, $min, $max): array
    {
        if (is_numeric($num) && $num >= $min && $num <= $max) {
            return array($name, true, $num, "数值符合");
        }
        return array($name, false, $num, "输入的数值不符合大小");
    }

    /**
     * 检查长度是否符合
     * @param $name
     * @param $str
     * @param $min
     * @param $max
     * @return array
     */
    protected static function detectLength($name, $str, $min, $max): array
    {
        $length = strlen($str);
        if ($length >= $min && $length <= $max) {
            return array($name, true, $str, "长度符合");
        }
        return array($name, false, $str, "输入的值不符合长度范围规范");
    }

}