<?php



class WaresDaoImpl implements waresDao{

    /**
     * @param $conn
     * @param $typea
     * @param $num
     * @param $state
     * @return mixed
     * 查询商品表中的信息根据类型，数量，状态查询
     */
    public function waresNewsQuery($conn, $typea, $num, $state)
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
    public function waresImgQuery($conn, $sp_uid)
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
    public function waresTextQuery($conn, $sp_uid)
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
    public function waresOneQuery($conn, $sp_uid)
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






}


