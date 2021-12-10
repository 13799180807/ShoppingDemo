<?php


namespace src\Application\Helper;


class ResultJson
{


    /**
     * 返回json
     * @param $status
     * @param string $msg
     * @param string $dataList
     * @return mixed
     */
    public static function result($status,$msg="",$dataList="")
    {
        $json=array(
            'status'=>$status,
            'msg'=>$msg,
            'data'=>$dataList
        );
        return json_encode($json);
    }

}
