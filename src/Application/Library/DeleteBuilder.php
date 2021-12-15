<?php
namespace Application\Library;

class DeleteBuilder
{

    /**
     * 根据字段删除
     * @param $conn
     * @param $table
     * @param $field
     * @param $key
     * @return bool
     */
    public function deleteByField($conn,$table,$field,$key): bool
    {
        $sql="DELETE FROM {$table} WHERE {$field}=? ";
        $stmt=$conn->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param("s",$key);
        $stmt->execute();
        $stmt->close();
        return true;
    }




}

