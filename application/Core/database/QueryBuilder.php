<?php


class QueryBuilder{
    /**
     * @param $table
     * @return int
     * 使用方法 $rows=QueryBuilder::queryAll("demo");
     */

    public static function queryAll($table){
        $conn=Connection::conn();
        $sql="select * from {$table}";
        $stmt = $conn->stmt_init();
        $stmt->prepare($sql);
        $stmt->execute();
        $result=$stmt->get_result();
        $rows=$result->fetch_all(2);
        if(count($rows)>0){
            $stmt->free_result();
            $stmt->close();
            $conn->close();
            return $rows;
        }else{
            $stmt->free_result();
            $stmt->close();
            $conn->close();
            return -1;
        }
    }

}