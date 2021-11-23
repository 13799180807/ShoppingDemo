<?php

Class Connection{
    public static function conn(){
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
}
