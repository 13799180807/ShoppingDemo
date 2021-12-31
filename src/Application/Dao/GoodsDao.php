<?php
namespace Application\Dao;
interface GoodsDao
{
    /**
     * 根据分类id进行删除商品表中的数据删除这个分类
     * @param int $goodsCategoryId
     * @return bool
     */
    public function removeByGoodsCategoryId(int $goodsCategoryId) :bool;

    /**
     * 根据id进行查询商品的某个信息
     * @param string $userType
     * @param int $goods_id
     * @param int $goods_status
     * @return array
     */
    public function getById(string $userType, int $goods_id, int $goods_status=0) :array;

    /**
     * 根据不同字段进行查询该字段的信息
     * @param int $num
     * @param int $status
     * @param string $field
     * @param string $value
     * @return array
     */
    public function listField(int $num ,int $status,string $field="", string $value="") :array;

    /**
     * 根据名字进行模糊查询商品信息
     * @param string $goodsName
     * @param int $status
     * @return array
     */
    public function getByGoodsName(string $goodsName,int $status=0) :array;

    /**
     * 获取这个分类下的商品的id
     * @param int $goodsCategoryId
     * @return array
     */
    public function listGoodsCategoryId(int $goodsCategoryId) :array;

    /**
     * 更新商品
     * @param int $goodsId
     * @param string $name
     * @param int $categoryId
     * @param float $prick
     * @param int $stock
     * @param int $status
     * @param int $hot
     * @param int $recommendation
     * @param string $describe
     * @param string $img
     * @return bool
     */
    public function updateGoodsById(int $goodsId,string $name,int $categoryId,float $prick,int $stock,int $status=1,
    int $hot=2,int $recommendation=2,string $describe="" ,string $img="") : bool;

    /**
     * 检测表中某个字段的值存在不存在这个表中
     * @param string $field
     * @param string $fieldType
     * @param string $fieldKey
     * @return array
     */
    public function getByField(string $field,string $fieldType,string $fieldKey) :array;





}