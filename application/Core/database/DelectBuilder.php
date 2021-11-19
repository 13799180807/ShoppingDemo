<?php


class DelectBuilder
{
    /**
     * @param $table
     * @return bool
     * 使用方法例子： DelectBuilder::delectAll("demo","id=?","s","30");
     */
    public static  function delectAll($table,$condtion,$types,$stmtinit){

        $conn=Connection::conn();
        $sql="DELETE FROM {$table} WHERE {$condtion}";
        $stmt=$conn->prepare($sql);
        $stmt->bind_param("{$types}",$stmtinit);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        return true;

    }

}

