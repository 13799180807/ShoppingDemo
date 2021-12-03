<?php
require 'GoodsServiceImpl.php';
interface GoodsService{

    /**
     * @param $id
     * @return mixed
     * 根据id获取单个信息
     */
    public static function getById($id);

    /**
     * @param $field
     * @param $value
     * @param $status
     * @param $num
     * @return mixed
     * 根据一个字段名进行查询获取多个对象
     */
    public static function listField($field, $value, $status, $num);

    /**
     * @param $goodsName
     * @return mixed
     * 根据名字模糊查询
     */
    public static function getByGoodsName($goodsName);

}
