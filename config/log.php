<?php
//conlog::AddLog("ceshi1","ConLog");
class conlog{
    public  static function AddLog($log='',$filePrefix='',$fileSuffix='.log',$time='day'){
        date_default_timezone_set("Asia/Shanghai");
        $time1=date('Y-m-d H:i:s',time());
        if($time=='year'){
            $period=date('Y',time());

        }elseif($time=='month'){
            $period=date('Ym',time());

        }elseif($time=='hour'){
            $period=date('YmdH',time());

        }elseif($time=='minute'){
            $period=date('YmdHi',time());

        }elseif($time=='second'){
            $period=date('YmdHis',time());

        }else{
            $period=date('Ymd',time());

        }

        $filename=$filePrefix.$period.$fileSuffix;

        $fp=fopen($filename,'a');
        if($fp){
            $wr=fwrite($fp,$time1."\n".$log."\n");
            if($wr){
                $close=fclose($fp);
                if($close){
                    return 1;
                }else{
                    return -1;
                }
            }else{
                return -2;
            }
        }else{
            return -3;
        }

    }
}
