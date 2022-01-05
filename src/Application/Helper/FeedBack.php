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
     * @param $status
     * @param string $msg
     * @param string $dataList
     * @return mixed
     */
    public static function result($status, $msg = "", $dataList = "")
    {
        $json = array(
            'status' => $status,
            'msg' => $msg,
            'data' => $dataList
        );
        return json_encode($json);
    }

    /**
     * 失败返回404
     * @param string $msg
     * @return false|string
     */
    public static function fail(string $msg)
    {
        $json = array(
            'status' => 404,
            'msg' => $msg,
            'data' => array(
                'err' => "请联系管理员进行参数比对"
            )
        );
        return json_encode($json);
    }

}
