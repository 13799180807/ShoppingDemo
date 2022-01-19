<?php

namespace Application\Dao;
interface GoodsPictureDao
{

    /**
     * 根据字段进行查询
     * @param string $fieldName
     * @param string $fieldValue
     * @return array
     */
    public function getByField(string $fieldName, string $fieldValue): array;


    /**
     * 根据字段进行删除，表中的数据
     * @param string $fieldName
     * @param string $fieldValue
     * @return bool
     */
    public function removeByField(string $fieldName, string $fieldValue): bool;



    /**
     * 根据goodsId进行商品图片的添加
     * @param int $goodsId
     * @param string $fileName
     * @return int
     */
    public function saveByGoodsId(int $goodsId, string $fileName): int;

}