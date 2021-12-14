<?php
namespace src\Application\Library;


use mysqli;
use mysqli_sql_exception;

Class Connection{
    /**
     * 数据库连接
     * @return mysqli
     */
    public static function conn(): mysqli
    {
        $conf=database();
        $conn=new mysqli($conf['link'],$conf['user'],$conf['password']);

        try{
            if($conn->connect_errno){
                throw new mysqli_sql_exception();
            }
            else
            {
                $conn->select_db($conf['dbName']);
                $conn->query("set names {$conf['dbCode']}");
                return $conn;
            }
        }catch(mysqli_sql_exception $e){
            die("Connection failed: " . $conn->connect_error);
            return $conn;
        }
    }

    /**
     * @param $stmt
     * @return mixed
     */
    public static function releaseRes($stmt){

        $result=$stmt->get_result();
        $rows=$result->fetch_all(2);
        $stmt->free_result();
        $stmt->close();
        return $rows;
    }



}
