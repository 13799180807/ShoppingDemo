<?php


namespace Application\Helper;


/**
 * 正则表达式判断
 * Class regularExpression
 * @package Application\Helper
 */
class RegularExpression
{
    public int $strMin = 0;
    public int $strMax = 0;
    public int $numMin = 0;
    public int $numMax = 0;
    public array $res = array();

    /**
     * 判断str,num,account
     * @param array $data
     * @return array
     */
    public function run(array $data): array
    {
        $method = $data[2];
        switch ($method) {
            case 'num':
                $this->numMin = $data[3];
                $this->numMax = $data[4];
                $this->res = self::numSize($data[0], $data[1]);
                break;
            case 'str':
                $this->strMin = $data[3];
                $this->strMax = $data[4];
                $this->res = self::strLength($data[0], $data[1]);
                break;
            case 'account':
                $this->res = self::verificationAccount($data[0], $data[1], $data[3]);
                break;
            default:
                $this->res = array($data[0], false, $data[2], "参数传输错误");
        }
        return $this->res;
    }

    /**
     * 判断数字是不是符合大小
     * @param string $name
     * @param int $num
     * @return array
     */
    public function numSize(string $name, int $num): array
    {
        if ($num >= $this->numMin && $num <= $this->numMax) {
            return array($name, true, $num, '大小符合');
        }
        return array($name, false, $num, "大小不符合");

    }

    /**
     * 字符串长度判断
     * @param string $name
     * @param string $str
     * @return array
     */
    public function strLength(string $name, string $str): array
    {
//        $length = strlen($str);
        $length = mb_strlen($str);
        if ($length >= $this->strMin && $length <= $this->strMax) {
            return array($name, true, $str, '长度符合');
        }
        return array($name, false, $str, '长度不符合');

    }

    /**
     * 验证账号密码是否符合条件
     * @param $name
     * @param $str
     * @param $msg
     * @return array
     */
    public function verificationAccount($name, $str, $msg = "必须为6-15位的数字和字母的组合"): array
    {
        if (!preg_match('/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,15}$/', $str)) {
            return array($name, $str, false, $msg);
        } else {
            return array($name, $str, true, "符合要求");
        }
    }


}