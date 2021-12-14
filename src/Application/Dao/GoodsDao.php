<?php
namespace src\Application\Dao;
interface GoodsDao
{

    /**
     * 根据分类id进行把这个商品表的分类删除
     * @param $conn
     * @param int $goodsCategoryId
     * @return mixed
     */
    public static function deleteByGoodsCategoryId($conn, int $goodsCategoryId);

    /**
     * 根据id获取当个商品信息
     * @param $conn
     * @param int $id
     * @return mixed
     */
    public static function getById($conn,int $id);

    /**
     * 根据一个字段名进行查询获取多个对象
     * @param $conn
     * @param string $field
     * @param string $value
     * @param int $status
     * @param int $num
     * @return mixed
     */
    public static function listField($conn, string $field, string $value, int $status, int $num);

    /**
     * 根据名字进行模糊查询商品信息
     * @param $conn
     * @param string $goodsName
     * @return mixed
     */
    public static function getByGoodsName($conn,string $goodsName);

    /**
     * 获取这个分类下的商品所有信息
     * @param $conn
     * @param int $goodsCategoryId
     * @return mixed
     */
    public static function listGoodsCategoryId($conn,int $goodsCategoryId);



}