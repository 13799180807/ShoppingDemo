<?php
namespace src\Application\Dao;

use src\Application\Library\Connection;

class GoodsIntroductionDaoImpl implements GoodsIntroductionDao
{

    /**
     * 根据id进行商品查询
     * @param $conn
     * @param int $goodsId
     * @return array
     */
    public static function getGoodsId($conn,int $goodsId) : array
    {
        $sql="SELECT * FROM tb_goods_introduction WHERE goods_id=?";
        $stmt=$conn->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param("i",$goodsId);
        $stmt->execute();
        return Connection::releaseRes($stmt);
    }

    /**
     * 根据goods_id进行删除
     * @param $conn
     * @param int $goodsId
     * @return bool
     */
    public static function deleteByGoodsId($conn, int $goodsId): bool
    {
        $sql="DELETE FROM tb_goods_introduction WHERE goods_id=? ";
        $stmt=$conn->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param("i",$goodsId);
        $stmt->execute();
        $stmt->close();
        return true;

    }
}