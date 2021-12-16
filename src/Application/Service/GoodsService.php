<?php
namespace Application\Service;
interface GoodsService{

    /**
     * 根据id进行获取单个商品信息
     * @param int $id
     * @return mixed
     */
    public function getById(int $id);

    /**
     * 根据一个字段名进行查询获取多个对象
     * @param string $field
     * @param string $value
     * @param int $status
     * @param int $num
     * @return mixed
     */
    public function listField(string $field,string $value,int $status,int $num);

    /**
     * 根据名字模糊查询
     * @param string $goodsName
     * @return mixed
     */
    public function getByGoodsName(string $goodsName);






}
