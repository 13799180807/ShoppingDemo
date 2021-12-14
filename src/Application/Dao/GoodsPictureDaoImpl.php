<?php
namespace src\Application\Dao;
use src\Application\Library\Connection;

class GoodsPictureDaoImpl implements GoodsPictureDao
{

    /**
     * 获取更多图片信息
     * @param $conn
     * @param int $goodsId
     * @return array
     */
    public static function getGoodsId($conn, int $goodsId): array
    {
        // TODO: Implement getGoodsId() method.
        $sql="SELECT * FROM tb_goods_picture WHERE goods_id=?";
        $stmt=$conn->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param("i",$goodsId);
        $stmt->execute();
        return Connection::releaseRes($stmt);
    }

    /**
     * 根据goods_id进行删除操作
     * @param $conn
     * @param int $goodsId
     * @return bool
     */
    public static function deleteByGoodsId($conn, int $goodsId): bool
    {
        $sql="DELETE FROM tb_goods_picture WHERE goods_id=? ";
        $stmt=$conn->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param("i",$goodsId);
        $stmt->execute();
        $stmt->close();
        return true;
    }
}