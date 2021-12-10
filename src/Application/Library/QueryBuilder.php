<?php
namespace src\Application\Library;

class QueryBuilder
{
    /**
     * 查询表全部信息
     * @param $conn
     * @param string $table
     * @return array
     */
    public static function queryAll($conn,string $table) :array
    {
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
     * @param $condition
     * @param $types
     * @param $stint
     * @return int
     * 没有结果为1，有结果-1
     */
    public static function insertQuery($conn, $table, $condition, $types, $stint) : int
    {

        $sql="SELECT *FROM {$table} WHERE {$condition}";
        $stmt = $conn->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param($types,$stint);
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
