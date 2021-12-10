<?php
namespace src\Application\Dao;
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
        $result=$stmt->get_result();
        $rows=$result->fetch_all(2);
        $stmt->free_result();
        $stmt->close();
        return $rows;
    }
}