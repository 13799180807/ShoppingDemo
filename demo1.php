<?php
$sererName="localhost:3306";
$sererUser="igg";
$sererPwd="igg123456";
$dbName="iggdemo";

$conn = new mysqli($sererName, $sererUser,$sererPwd);
try{
    if($conn->connect_errno){
        throw new mysqli_sql_exception();
    }
    else
    {
        $conn->select_db($dbName);
        $conn->query("set names utf8");
        echo 'connect ok!  数据库连接成功';
    }
}catch(mysqli_sql_exception $e){
    die("Connection failed: " . $conn->connect_error);
}

?>