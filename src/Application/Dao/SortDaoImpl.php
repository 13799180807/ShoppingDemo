<?php


class SortDaoImpl implements SortDao
{
    /**
     * @param $conn
     * @return mixed
     * 查询
     */
    public function sortListQuery($conn)
    {
        // TODO: Implement sortListQuery() method.
        $rows=QueryBuilder::queryAll($conn,"shop_sort");
        return $rows;
    }

    /**
     * @param $conn
     * @param $id
     * @return bool|mixed
     * 删除一个分类
     */
    public function sortOneDelect($conn, $id)
    {
        // TODO: Implement sortOneDel() method.
        $rows=DelectBuilder::delectAll($conn,"shop_sort","id=?","i",$id);
        return $rows;
    }

    /**
     * @param $conn
     * @param $name
     * @return mixed
     * 添加一个分类
     */
    public function sortInsert($conn, $name)
    {
        // TODO: Implement sortInsert() method.
        $sql="INSERT INTO shop_sort(sort_name) VALUE (?)";
        $stmt=$conn->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param("s",$name);
        $result=$stmt->execute();
        $stmt->close();
        return $result;
    }

    public function sortUpdate($conn, $id, $name)
    {
        // TODO: Implement sortUpdate() method.
        $sql=" UPDATE shop_sort SET sort_name=? WHERE id=?";
        $stmt = $conn->stmt_init();  //构建空白的语句对象
        $stmt->prepare($sql);
        $stmt->bind_param("si",$name,$id);
        $result = $stmt->execute();
        var_dump($result);
        $stmt->close();
        return $result;

    }
}

