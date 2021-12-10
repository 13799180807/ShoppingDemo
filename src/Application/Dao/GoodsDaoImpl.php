<?php
namespace src\Application\Dao;

class GoodsDaoImpl implements  GoodsDao
{

    /**
     * 根据id进行查询商品的某个信息
     * @param $conn
     * @param int $id
     * @return array
     */
    public static function getById($conn,int $id) : array
    {
        $sql="SELECT * FROM tb_goods WHERE goods_id=?";
        $stmt=$conn->stmt_init();//构建空白的语句对象
        $stmt->prepare($sql);
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $result=$stmt->get_result();
        $rows=$result->fetch_all(2);
        $stmt->free_result();
        $stmt->close();
        return $rows;
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
        $result=$stmt->get_result();
        $rows=$result->fetch_all(2);
        $stmt->free_result();
        $stmt->close();
        return $rows;
    }

    /**
     * 根据名字进行模糊查询商品信息
     * @param $conn
     * @param string $goodsName
     * @return array
     */
    public static function getByGoodsName($conn, string $goodsName) : array
    {
        $sql="SELECT * FROM tb_goods WHERE goods_name LIKE ? ";
        $stmt=$conn->stmt_init();//构建空白的语句对象
        $stmt->prepare($sql);
        $stmt->bind_param("s",$goodsName);
        $stmt->execute();
        $result=$stmt->get_result();
        $rows=$result->fetch_all(2);
        $stmt->free_result();
        $stmt->close();
        return $rows;
    }

}