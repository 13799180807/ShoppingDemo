<?php


namespace Application\Library;


use Application\Exception\Log;

class SqlUtil
{
    public static $conn;         //数据库连接

    /**
     * 查询的类型(save)(update)(remove)(count)(countAll无条件统计)(query)(queryAll无条件查询)
     * @param string $sqlType
     * @param string $sql
     * @param string $fieldsType
     * @param array $key
     * @return mixed
     */
    public function run(string $sqlType, string $sql, string $fieldsType = "", array $key = array())
    {
        /** 写入参数 */
        if (self::$conn == "") {
            self::$conn = (new Connection())->conn();
        }

        /** 判断sql执行类型 */
        $type = $sqlType;

        /** 判断是否有无条件的查询 */
        if ($type == "queryAll" || $type == "countAll") {
            /** 没有条件查询的 */
            $stmt = self::$conn->stmt_init();
            $stmt->prepare($sql);
            $res = $stmt->execute();

        } else {
            /** 有条件查询的需要构造空白语句 */
            $stmt = self::$conn->prepare($sql);
            $stmt->bind_param($fieldsType, ...$key);
            $res = $stmt->execute();
        }

        switch ($type) {
            case "save":
                $stmt->close();
                return mysqli_insert_id(self::$conn);  //返回int类型插入的id
            case "update":
            case "remove":
                /** 执行或者更新或者删除 返回的是 true,false */
                $stmt->close();
                return $res;
            case "count":
                /** 有条件的统计数量 */
                $result = $stmt->get_result();
                $stmt->free_result();
                $stmt->close();
                return $result->num_rows; //int
            case "countAll":
                /** 无条件统计 */
                $result = $stmt->get_result();
                $stmt->free_result();
                $stmt->close();
                return $result->num_rows; //int
            case "query":
                /** 有条件的查询 */
                $result = $stmt->get_result();
                $res = $result->fetch_all(1);
                $stmt->free_result();
                $stmt->close();
                return $res; //array
            case "queryAll":
                /** 没条件查询 */
                $result = $stmt->get_result();
                $res = $result->fetch_all(1);
                $stmt->free_result();
                $stmt->close();
                return $res; //array
            default:
                $msg = "数据查询类型为" . $type . "执行失败，sql语句为：" . $this->sql;
                (new Log())->run($msg);

        }

    }


}