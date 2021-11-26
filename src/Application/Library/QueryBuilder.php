<?php


class QueryBuilder{
    /**
     * @param $conn
     * @param $table
     * @return mixed
     * $rows=QueryBuilder::queryAll($conn,"demo");
     */
    public static function queryAll($conn,$table){
        $sql="select * from {$table}";
        $stmt = $conn->stmt_init();
        $stmt->prepare($sql);
        $stmt->execute();
        $result=$stmt->get_result();
        $rows=$result->fetch_all(2);
        $stmt->free_result();
        $stmt->close();
        return $rows;
    }

    /**
     * @param $conn
     * @param $table
     * @param $condtion
     * @param $types
     * @param $stmtinit
     * @return int
     * 判断数据存在不存在在表格里面
     */
    public static function innserQuery($conn,$table,$condtion,$types,$stmtinit){

        $sql="SELECT *FROM {$table} WHERE {$condtion}";
        $stmt = $conn->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param($types,$stmtinit);
        $stmt->execute();
        $result=$stmt->get_result();
        $rows=$result->fetch_all(2);
        $stmt->free_result();
        $stmt->close();
        if (count($rows)=="0"){
            return 1;
        }else{
            return -1;
        }
    }
}
