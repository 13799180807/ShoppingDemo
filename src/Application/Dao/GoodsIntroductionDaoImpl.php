<?php
namespace src\Application\Dao;

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
        $result=$stmt->get_result();
        $rows=$result->fetch_all(2);
        $stmt->free_result();
        return $rows;
    }
}