<?php


class GoodsIntroductionDaoImpl implements GoodsIntroductionDao
{

    /**
     * @param $conn
     * @param $goodsId
     * @return mixed
     */
    public static function getGoodsId($conn, $goodsId) : array
    {
        // TODO: Implement getById() method.
        $sql="SELECT * FROM tb_goods_introduction WHERE goods_id=?";
        $stmt=$conn->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param("i",$goodsId);
        $stmt->execute();
        $result=$stmt->get_result();
        $rows=$result->fetch_all(2);
        $stmt->free_result();
        return $rows;
    }
}