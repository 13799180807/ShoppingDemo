<?php


namespace Application\Helper;


/**
 * json返回值
 * Class FeedBack
 * @package Application\Helper
 */
class FeedBack
{
    /**
     * 返回json
     * @param int $code
     * @param string $msg
     * @param array $dataList
     * @return false|string
     */
    public static function result(int $code, string $msg = "", array $dataList = array())
    {
        $json = array(
            'code' => $code,
            'msg' => $msg,
            'data' => $dataList
        );
        return json_encode($json);
    }


    /**
     * 失败
     * @param string $msg
     * @param array $error
     * @return false|string
     */
    public static function fail(string $msg, array $error = array())
    {
        $json = array(
            'code' => 400,
            'msg' => $msg,
            'data' => array(
                'error' => $error
            )
        );
        return json_encode($json);
    }

}
