<?php

namespace Application\Library;

use Application\Exception\Log;
use mysqli;
use mysqli_sql_exception;

/**
 * 数据库连接
 * Class Connection
 * @package Application\Library
 */
class Connection
{

    /**
     * 数据库连接
     * @return mysqli
     */
    public function conn(): mysqli
    {
        $conf = json_decode(file_get_contents(APPLICATION . "database.json"), true);
        $conn = new mysqli($conf['link'], $conf['user'], $conf['password']);

        try {
            if ($conn->connect_errno) {
                throw new mysqli_sql_exception();
            } else {
                $conn->select_db($conf['dbName']);
                $conn->query("set names {$conf['dbCode']}");
                return $conn;
            }
        } catch (mysqli_sql_exception $e) {
            $msg = "Connection failed: " . $conn->connect_error;
            (new Log())->run($msg);
            die();
            return $conn;
        }
    }


}
