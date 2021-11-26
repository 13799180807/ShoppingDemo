<?php


class DelectBuilder
{
    /**
     * @param $table
     * @return bool
     * 使用方法例子： DelectBuilder::delectAll($conn,"demo","id=?","s","30");
     */
    public static  function delectAll($conn,$table,$condtion,$types,$stmtinit){

        $sql="DELETE FROM {$table} WHERE {$condtion}";
        $stmt=$conn->prepare($sql);
        $stmt->bind_param("{$types}",$stmtinit);
        $stmt->execute();
        $stmt->close();
        return true;
    }

}

