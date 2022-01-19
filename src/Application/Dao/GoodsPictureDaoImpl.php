<?php

namespace Application\Dao;

use Application\Library\SqlUtil;

class GoodsPictureDaoImpl implements GoodsPictureDao
{

    /**
     * 根据不同的字段进行查询获取
     * @param string $fieldName
     * @param string $fieldValue
     * @return array
     */
    public function getByField(string $fieldName, string $fieldValue): array
    {
        $sql = "SELECT * FROM tb_goods_picture WHERE {$fieldName}=? ";
        return (new SqlUtil())->run("query", $sql, "i", array($fieldValue));

    }


    /**
     * 根据字段进行删除表中的数据
     * @param string $fieldName
     * @param string $fieldValue
     * @return bool
     */
    public function removeByField(string $fieldName, string $fieldValue): bool
    {
        $sql = "DELETE FROM tb_goods_picture WHERE {$fieldName}=? ";
        return (new SqlUtil())->run("remove", $sql, "s", array($fieldValue));
    }

    /**
     * 图片表添加一条数据
     * @param int $goodsId
     * @param string $fileName
     * @return int
     */
    public function saveByGoodsId(int $goodsId, string $fileName): int
    {
        $sql = "INSERT INTO tb_goods_picture (goods_id, goods_picture_path) value (?,?)";
        return (new SqlUtil())->run("save", $sql, "is", array($goodsId, $fileName));

    }
}