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
        $ServerName=SERVER_NAME;
        $ServerUser=SERVER_USER;
        $ServerPassword=SERVER_PASSWORD;
        $DbName=SERVER_DBNAME;
        $DbCode=DB_CODE;
        $conn=new mysqli($ServerName,$ServerUser,$ServerPassword);

        try{
            if($conn->connect_errno){
                throw new mysqli_sql_exception();
            }
            else
            {
                $conn->select_db($DbName);
                $conn->query("set names {$DbCode}");
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
