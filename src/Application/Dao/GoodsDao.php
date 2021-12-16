<?php
namespace Application\Dao;
interface GoodsDao
{
    /**
     * 根据分类id进行删除商品表中的数据删除这个分类
     * @param int $goodsCategoryId
     * @return bool
     */
    public function deleteByGoodsCategoryId(int $goodsCategoryId) :bool;

    /**
     * 根据id获取单个商品信息
     * @param string $fields
     * @param int $id
     * @param int $status
     * @return array
     */
    public function getById(string $fields,int $id,int $status) :array;

    /**
     * 根据一个字段名进行查询获取多个对象
     * @param string $fields
     * @param string $field
     * @param string $value
     * @param int $status
     * @param int $num
     * @return array
     */
    public function listField(string $fields,string $field, string $value, int $status, int $num) :array;

    /**
     * 根据名字进行模糊查询商品信息
     * @param string $field
     * @param int $status
     * @param string $goodsName
     * @return array
     */
    public function getByGoodsName(string $field,int $status,string $goodsName) :array;

    /**
     * 获取这个分类下的商品所有信息
     * @param string $field
     * @param int $goodsCategoryId
     * @return array
     */
    public function listGoodsCategoryId(string $field,int $goodsCategoryId) :array;






}