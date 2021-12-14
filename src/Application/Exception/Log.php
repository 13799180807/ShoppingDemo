<?php

namespace src\Application\Exception;
class Log
{
    public string $logName;

    public string $logPath;

    /**
     * 写入日志
     * @param string $msg
     */
    public function run(string $msg="")
    {
        $this->setLog();
        $this->addLog($msg);
    }

    /**
     * 将异常写入
     * @param string $msg
     * @return bool
     */
    public function addLog(string $msg=""): bool
    {
        date_default_timezone_set("Asia/Shanghai");
        $time = date('Y-m-d H:i:s', time());

        $fp = fopen($this->logPath, 'a');
        if ($fp)
        {
            $wr = fwrite($fp, $time . "\n" . $msg . "\n");
            if ($wr)
            {
                $close = fclose($fp);
                if ($close)
                {
                    return true;
                }
            }
        }
        return false;
    }

    /** 设置参数 */
    public function setLog()
    {
        $this->logName="exception.log";
        $this->logPath=APP_PATH.'logs/'.$this->logName;

    }






}