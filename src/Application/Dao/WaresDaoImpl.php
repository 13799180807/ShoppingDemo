<?php



class WaresDaoImpl implements waresDao
{

    /**
     * @param $conn
     * @param $typea
     * @param $num
     * @param $state
     * @return mixed
     * 查询商品表中的信息根据类型，数量，状态查询
     */
    public static function waresNewsQuery($conn, $typea, $num, $state)
    {

        $sql="SELECT * FROM shop_wares WHERE sp_state='{$state}' ORDER BY {$typea} DESC limit {$num}";
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
     * @param $sp_uid
     * @return mixed
     * 查询某个商品信息表中的图片
     */
    public static function waresImgQuery($conn, $sp_uid)
    {
        // TODO: Implement waresImgQuery() method.
        $sql="SELECT * FROM shop_waresimg WHERE sp_uid=? ";
        $stmt=$conn->stmt_init();//构建空白的语句对象
        $stmt->prepare($sql);
        $stmt->bind_param("s",$sp_uid);
        $stmt->execute();
        $result=$stmt->get_result();
        $rows=$result->fetch_all(2);
        $stmt->free_result();
        $stmt->close();
        return $rows;
    }

    /**
     * @param $conn
     * @param $sp_uid
     * @return mixed
     * 查询某个商品的详细介绍详细信息
     */
    public static function waresTextQuery($conn, $sp_uid)
    {
        // TODO: Implement waresTextQuery() method.
        $sql="SELECT * FROM shop_warestext WHERE sp_uid=? ";
        $stmt=$conn->stmt_init();//构建空白的语句对象
        $stmt->prepare($sql);
        $stmt->bind_param("s",$sp_uid);
        $stmt->execute();
        $result=$stmt->get_result();
        $rows=$result->fetch_all(2);
        $stmt->free_result();
        $stmt->close();
        return $rows;
    }

    /**
     * @param $conn
     * @param $sp_uid
     * 查询一条消息用的
     */
    public static function waresOneQuery($conn, $sp_uid)
    {
        // TODO: Implement waresOneQuery() method.
        $sql="SELECT * FROM shop_wares WHERE sp_uid=? ";
        $stmt=$conn->stmt_init();//构建空白的语句对象
        $stmt->prepare($sql);
        $stmt->bind_param("s",$sp_uid);
        $stmt->execute();
        $result=$stmt->get_result();
        $rows=$result->fetch_all(2);
        $stmt->free_result();
        $stmt->close();
        return $rows;
    }

    /**
     * @param $conn
     * @param $name
     * @return mixed
     * 模糊查找
     */
    public static function waresVagueQuery($conn, $name)
    {
        $sql="SELECT *FROM shop_wares WHERE sp_name LIKE ?";
        $stmt=$conn->stmt_init();//构建空白的语句对象
        $stmt->prepare($sql);
        $stmt->bind_param("s",$name);
        $stmt->execute();
        $result=$stmt->get_result();
        $rows=$result->fetch_all(2);
        $stmt->free_result();
        $stmt->close();
        return $rows;
    }

    /**
     * @param $conn
     * @param $id
     * @return bool|mixed
     * 管理员删除商品sql语句
     */
    public static function deleteById($conn, $id)
    {
        $row=DeleteBuilder::delectAll($conn,"shop_wares","id=?","i",$id);
        return $row;
    }

    /**
     * @param $conn
     * @param $list
     * @return mixed|void
     * 添加
     */
    public static function insert($conn, $list)
    {
        // TODO: Implement insert() method.
    }

    /**
     * @param $conn
     * @param $list
     * 修改
     */
    public static function updateById($conn, $list)
    {
        // TODO: Implement updateById() method.
    }
}


