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
        return Connection::releaseRes($stmt);
    }


    /**
     * 判断表中是否可以进行插入
     * @param $conn
     * @param string $table
     * @param string $condition
     * @param string $types
     * @param string $stint
     * @return int
     */
    public static function insertQuery($conn,string $table,string $condition,string $types,string $stint) : int
    {
        $sql="SELECT *FROM {$table} WHERE {$condition}";
        $stmt = $conn->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param($types,$stint);
        $stmt->execute();
        $rows=Connection::releaseRes($stmt);
        if (count($rows)=="0"){
            return 1;
        }else{
            return -1;
        }
    }
}
