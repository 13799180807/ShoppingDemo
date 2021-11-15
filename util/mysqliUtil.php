<?php
require_once 'mysqli_connection.php';
/**
 * 分页查询多语句查询
 * sql写入
 */
getPageNum("demo","3");

function getPageNum($tableName,$num){
    /**
     * 获取到我们要查询的表名进行计算
     */
    $conn=getConn();
 //   $sql="SELECT COUNT(*) FROM {$tableName}";
 //   $result=$conn->query($sql);


//    $rows=$result->fetch_all();
//    var_dump($rows);
//    mysqli_free_result($result);
//    mysqli_close($conn);
    $sql="SELECT COUNT(*) FROM {$tableName}";
    $result=$conn->query($sql);
    $row=mysqli_num_rows($result);
     var_dump($row);

}
function getPaging($page,$num){
/**
 * 传入需要显示的页面，跟数量
 *
 */

}
function text(){
    /**
     * 更新测试
     */
    $list["type_state"]="审核中";
    getUpdateAll("shop_state",$list,"id=1");

    /**
     * 查询测试
     */
    $rows=getAllOne("shop_state","*","id<50");
    var_dump($rows);

    /**
     * 获取表全部数据
     */
    $rows=getAllList("shop_state","*");
    var_dump($rows);

    /**
     * 添加测试
     */
    $user["user"]="a1sd";
    $user["password"]="pws";
    $res=getInsertOne("shop_user",$user);
    if ($res){
        echo "添加成功";
    }else{
        echo "添加失败";
    }

    /**
     * 查询单个测试
     */
    $res= getIssetOne("shop_user","user='admin1'");
    if ($res){
        echo "有结果";
    }else{
        echo "没有结果";
    }

}
function getquerysql($sql){
    /**
     * 传入一个sql语句进行查询操作
     */
    $conn=getConn();
    $result=$conn->query($sql);
    $rows=$result->fetch_all();
    mysqli_free_result($result);
    mysqli_close($conn);
    return $rows;
}
function getdeletesql($sql){
    /**
     * 删除传入一个sql语句进行删除
     */
    $conn=getConn();
    mysqli_query($conn,$sql);
    mysqli_close($conn);
}
function getupdatesql($sql){
    /**
     * 传入sql进行更新的语句
     */
    $conn=getConn();
    mysqli_query($conn,$sql);
    mysqli_close($conn);
}
function getaddsql($sql){
    /**
     * 传入sql语句进行新增
     */
    $conn=getConn();
    $result=mysqli_query($conn,$sql);
    if ($result){
        $judge=true;
    }else{
        $judge=false;
    }
    mysqli_close($conn);
    return  $judge;
}
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
function getAllOne($tableName,$fileds,$condition){
    /**
     * 查询一条信息根据查询条件
     * 表名，查询的字段，查询的条件
     * 返回结果集
     */
    $sql="SELECT {$fileds} FROM {$tableName} WHERE {$condition}";
    $conn=getConn();
    $result=$conn->query($sql);
    $rows=$result->fetch_all();
    mysqli_free_result($result);
    mysqli_close($conn);
    return $rows;
}
function getAllList($tableName,$fileds){
    /**
     * 查询全部数据
     * 表名，查询的字段名
     */
    $sql="SELECT {$fileds} FROM {$tableName}";
    $conn=getConn();
    $result=$conn->query($sql);
    $rows=$result->fetch_all();
    mysqli_free_result($result);
    mysqli_close($conn);
    return $rows;
}
function getInsertOne($tableName,$tableList){
    /**
     *插入操作
     * 根据表名，参数名跟值进行插入
     */
    $sql="INSERT INTO {$tableName} SET ";
    $str="";
    foreach ($tableList as $key => $value){
        $str .=$key."='".$value."',";  //进行拼接
    }
    $str=trim($str,","); //去掉.
    $sql .=$str;  //获得数据语句
    $conn=getConn();
    $result=mysqli_query($conn,$sql);
    if ($result){
        $judge=true;
    }else{
        $judge=false;
    }
    mysqli_close($conn);
    return  $judge;

}
function getDeleAll($tableName,$condtion){
    /**
     * 删除语句
     * 表名，条件
     */
    $sql="DELETE FROM {$tableName} WHERE {$condtion}";
    $conn=getConn();
    mysqli_query($conn,$sql);
    mysqli_close($conn);
}
function getUpdateAll($tableName,$tableList,$condition){
    /**
     * 更新语句
     *表名，更新语句，更新条件
     */
    $sql="UPDATE {$tableName} SET ";
    $str="";
    foreach ($tableList as $key => $value){
        $str .=$key."='".$value."' ,";
    }
    $str=trim($str,",");
    $sql .=$str."WHERE {$condition}";
    $conn=getConn();
    mysqli_query($conn,$sql);
    mysqli_close($conn);
}
