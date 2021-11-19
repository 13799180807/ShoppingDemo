<?php
require_once '../config/config.php';
function getConn(){
    /**
     * 获取数据库连接
     */
    $serverName=serverName;
    $serverUser=serverUser;
    $serverPwd=serverPwd;
    $dbName=serverdbName;
    $dbCode=dbCode;

    $conn = new mysqli($serverName, $serverUser, $serverPwd);

    try{
        if($conn->connect_errno){
            throw new mysqli_sql_exception();
        }
        else
        {
            $conn->select_db($dbName);
            $conn->query("set names {$dbCode}");
            return $conn;

        }
    }catch(mysqli_sql_exception $e){
        die("Connection failed: " . $conn->connect_error);
        return $conn;
    }

}
