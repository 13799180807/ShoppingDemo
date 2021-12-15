<?php
namespace Application\Dao;

use Application\Library\Connection;
use Application\Library\DeleteBuilder;

class GoodsDaoImpl implements  GoodsDao
{

    /**
     * 删除商品表中一个分类
     * @param $conn
     * @param int $goodsCategoryId
     * @return bool
     */
    public static function deleteByGoodsCategoryId($conn, int $goodsCategoryId) :bool
    {

        return (new DeleteBuilder())->deleteByField($conn,"tb_goods","goods_category_id",$goodsCategoryId);
    }

    /**
     * 根据id进行查询商品的某个信息
     * @param $conn
     * @param int $id
     * @return array
     */
    public static function getById($conn,int $id) : array
    {
        $sql="SELECT * FROM tb_goods WHERE goods_id=? and goods_status=1 ";
        $stmt=$conn->stmt_init();//构建空白的语句对象
        $stmt->prepare($sql);
        $stmt->bind_param("i",$id);
        $stmt->execute();
        return Connection::releaseRes($stmt);
    }

    /**
     * 根据进来不同字段获取不同东西
     * @param $conn
     * @param string $field
     * @param string $value
     * @param int $status
     * @param int $num
     * @return array
     */
    public static function listField($conn, string $field,string $value,int $status,int $num) : array
    {

        if ($field=="created_at"){
            $sql="SELECT * FROM tb_goods WHERE  goods_status='{$status}'   ORDER BY created_at DESC limit {$num}";
        }else{
            $sql="SELECT * FROM tb_goods WHERE {$field}='{$value}' and goods_status='{$status}'   ORDER BY updated_at DESC limit {$num}";
        }
        $stmt = $conn->stmt_init();
        $stmt->prepare($sql);
        $stmt->execute();
        return Connection::releaseRes($stmt);
    }

    /**
     * 根据名字进行模糊查询商品信息
     * @param $conn
     * @param string $goodsName
     * @return array
     */
    public static function getByGoodsName($conn, string $goodsName) : array
    {
        $sql="SELECT * FROM tb_goods WHERE  goods_status=1 and goods_name  LIKE ? ";
        $stmt=$conn->stmt_init();//构建空白的语句对象
        $stmt->prepare($sql);
        $stmt->bind_param("s",$goodsName);
        $stmt->execute();
        return Connection::releaseRes($stmt);
    }

    /**
     * 获取这个分类下的所有id
     * @param $conn
     * @param int $goodsCategoryId
     * @return mixed
     */
    public static function listGoodsCategoryId($conn, int $goodsCategoryId)
    {
        $sql="SELECT goods_id FROM tb_goods WHERE goods_category_id=? ";
        $stmt=$conn->stmt_init();//构建空白的语句对象
        $stmt->prepare($sql);
        $stmt->bind_param("i",$goodsCategoryId);
        $stmt->execute();
        $result=$stmt->get_result();
        $rows=$result->fetch_all(1);
        $stmt->free_result();
        $stmt->close();
        return $rows;
    }
}