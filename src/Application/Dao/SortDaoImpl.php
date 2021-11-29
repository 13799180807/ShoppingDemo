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
     * @param $sortName
     * @return mixed|void
     * 根据分类进行查询
     */
    public function waresSortQuery($conn,$sortName,$pages,$num)
    {

        $pages=($pages-1)*$num;
        // TODO: Implement waresSortQuery() method.
        if ($sortName=="查询全部"){
            $sql="SELECT * FROM shop_wares  ORDER BY create_time limit ?,? ";
            $stmt = $conn->stmt_init();
            $stmt->prepare($sql);
            $stmt->bind_param("ii",$pages,$num);
        }else{
            $sql="SELECT * FROM shop_wares WHERE sp_varieties=? ORDER BY create_time limit ?,?";
            $stmt = $conn->stmt_init();
            $stmt->prepare($sql);
            $stmt->bind_param("sii",$sortName,$pages,$num);
        }
        $stmt->execute();
        $result=$stmt->get_result();
        $rows=$result->fetch_all(2);
        $stmt->free_result();
        $stmt->close();
        return $rows;
    }

    /**
     * @param $conn
     * @param $sortName
     * @param $num
     * @return false|float|mixed
     * 查询个数
     */
    public function waresPage($conn, $sortName, $num)
    {
        if ($sortName=="查询全部"){
            $sql="SELECT * FROM shop_wares  ";
            $stmt = $conn->stmt_init();
            $stmt->prepare($sql);
        }else{
            $sql="SELECT * FROM shop_wares WHERE sp_varieties=? ";
            $stmt = $conn->stmt_init();
            $stmt->prepare($sql);
            $stmt->bind_param("s",$sortName);
        }
        $stmt->execute();
        $result=$stmt->get_result();
        $stmt->free_result();
        $stmt->close();
        $rows = $result -> num_rows; //查到几条数据
        $pages=ceil($rows/$num); //有小数就取整加一
        return $pages;
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

    /**
     * @param $conn
     * @param $id
     * @param $name
     * @return mixed
     * 更新分类
     */
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

