<?php


namespace Application\Helper;


class Request
{

    /**
     * 获得多个请求方式
     * @param array $nameArr
     * @param array $typeArr
     * @return array
     */
    public static function only(array $nameArr, array $typeArr): array
    {
        $num = count($nameArr);
        $value = array();
        for ($a = 0; $a < $num; $a++) {
            $value[$nameArr[$a]] = self::param($nameArr[$a], $typeArr[$a]);
        }
        return $value;
    }

    /**
     * 获得单个请求参数
     * @param string $name
     * @param string $type
     * @return string
     */
    public static function param(string $name, string $type = ""): string
    {
        /** 判断这个请求存在不存在 */
        if (isset($_POST[$name])) {
            /** 请求存在 */
            $value = $_POST[$name];
        } else {
            /** 请求不存在 */
            $value = "";
        }

        /** 判断是否需要强制转换类型 */
        switch ($type) {
            case 's':
                #强制转换字符串类型
                $value = (string)$value;
                break;
            case 'i':
                #强制转换为整型类型
                $value = (int)$value;
                break;
            case 'b':
                #强制转换为布尔类型
                $value = (bool)$value;
                break;
            case 'a':
                #强制转换为数组类型
                $value = (array)$value;
                break;
            case'f':
                #强制转换为浮点类型
                $value = (float)$value;
                break;
        }
        return $value;
    }

    /**
     * 统一检测数据是否规范
     * @param array $data
     * @return array
     */
    public static function detect(array $data): array
    {
        $resArr = array();
        $errArr = array();

        /** 遍历数据检测 */
        foreach ($data as $row) {
            $resArr[] = self::detectData($row);
        }

        /** 判断数据有没有符合规范，有的话记录到数据中去 */
        foreach ($resArr as $row) {
            if (!$row[1]) {
                /** 不符合规范 */
                $errArr[] = "参数 " . $row[0] . " " . $row[3];
            }
        }
        if (count($errArr) > 0) {
            return array(
                'status' => false,
                'err' => $errArr
            );
        }
        return array(
            'status' => true,
            'err' => array()
        );
    }

    /**
     * 进行检查
     * @param array $arr
     * @return array
     */
    protected static function detectData(array $arr): array
    {

        switch ($arr[2]) {
            case 'numSize':
                return self::numberSize($arr[0], $arr[1], $arr[3], $arr[4]);
            case 'length':
                return self::length($arr[0], $arr[1], $arr[3], $arr[4]);
            case 'intSize':
                return self::intSize($arr[0], $arr[1], $arr[3], $arr[4]);
        }
        return array($arr[0], false, "", "错误数据,请正确操作;");
    }

    /**
     * 检测数字大小是否在区间内
     * @param $name
     * @param $num
     * @param $min
     * @param $max
     * @return array
     */
    protected static function numberSize($name, $num, $min, $max): array
    {
        if (is_numeric($num) && $num >= $min && $num <= $max) {
            return array($name, true, $num, "数值符合");
        }
        return array($name, false, $num, "输入的数值不符合大小,请规范输入;");
    }

    /**
     * 检测其长度是否符合要求
     * @param $name
     * @param $str
     * @param $min
     * @param $max
     * @return array
     */
    protected static function length($name, $str, $min, $max): array
    {
        /** 获取长度 */
        $length = mb_strlen($str);
        if ($length >= $min && $length <= $max) {
            return array($name, true, $str, "长度符合");
        }
        return array($name, false, $str, "长度不符合，请规范输入;");
    }

    /**
     * 判断数字是否是整型并且判断其数字是否在区间内
     * @param $name
     * @param $num
     * @param $min
     * @param $max
     * @return array
     */
    protected static function intSize($name, $num, $min, $max): array
    {
        if (preg_match("/^[0-9][0-9]*$/", $num)) {
            if ($num >= $min && $num <= $max) {
                return array($name, true, $num, "数值符合");
            }
            return array($name, false, $num, "输入的数值不符合大小,请规范输入;");
        }
        return array($name, false, $num, "输入的类型不准确，请正确输入;");
    }


}