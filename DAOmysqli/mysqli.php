<?php
require_once './../util/mysqli_connection.php';
require_once './../config/log.php';






/**
 * @param $tableName
 * @param $fileds
 * @return int|mixed
 * 根据表名查询全部信息
 */
function getAllList($tableName,$fileds){
    /**
     * 查询全部数据
     * 表名，查询的字段名
     */
    $sql="SELECT {$fileds} FROM {$tableName}";
    $conn=getConn();
    $result=$conn->query($sql);
    $row=mysqli_num_rows($result);  //受影响行数
    $log="执行了：  {$sql};  受影响行数为：{$row} ";
    conlog::AddLog($log,"ConLog");
    if($row>0){
        $rows=$result->fetch_all();
        mysqli_free_result($result);
        mysqli_close($conn);
        return $rows;

    }else{
        mysqli_free_result($result);
        mysqli_close($conn);
        return -1;
    }
}



/**
 * @param $tableName
 * @param $fileds
 * @param $condition
 * @return int|mixed
 */
function getAllOne($tableName,$fileds,$condition){
    /**
     * 查询一条信息根据查询条件
     * 表名，查询的字段，查询的条件
     * 返回结果集 为空就返回-1
     */
    $sql="SELECT {$fileds} FROM {$tableName} WHERE {$condition}";
    $conn=getConn();
    $result=$conn->query($sql);
    $row=mysqli_num_rows($result);  //受影响行数
    $log="执行了：  {$sql};  受影响行数为：{$row} ";
    conlog::AddLog($log,"ConLog");
    if($row>0){
        $rows=$result->fetch_all();  //读取
        mysqli_free_result($result);
        mysqli_close($conn);
        return $rows;
    }
    else{
        mysqli_free_result($result);
        mysqli_close($conn);
        return -1;
    }
}

/**
 * @param $tableName
 * @param $condition
 * @return bool
 * 判断数据存在不存在
 */
function getIssetOne($tableName,$condition){
    /**
     * 判断数据存在不存在
     * 参数：表名，查询条件
     * 查询到返回true 为查询到返回false
     */
    $sql="SELECT * FROM {$tableName} WHERE {$condition}";
    $conn=getConn();
    $result=$conn->query($sql);
    $row=mysqli_num_rows($result);
    $log="执行了：  {$sql};  受影响行数为：{$row} 作用：判断数据库存在不存在该数据（大于0存在）";
    conlog::AddLog($log,"ConLog");
    if ($row>0){
        $judge=true;
    }
    else{
        $judge=false;
    }
    mysqli_free_result($result);
    mysqli_close($conn);
    return $judge;
}



//以下的内容还没完全修改好


