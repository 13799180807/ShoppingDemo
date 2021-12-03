<?php


class GoodsDaoImpl implements  GoodsDao
{

    /**
     * @param $conn
     * @param $id
     * @return array
     */
    public static function getById($conn, $id) : array
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
     * @param $conn
     * @param $field
     * @param $value
     * @param $status
     * @param $num
     * @return array
     * 根据进来不同字段获取不同东西
     */
    public static function listField($conn, $field, $value, $status, $num) : array
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
     * @param $conn
     * @param $goodsName
     * @return array
     * 根据名字进行模糊查询
     */
    public static function getByGoodsName($conn, $goodsName) : array
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