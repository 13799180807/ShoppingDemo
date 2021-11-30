<?php
require 'GoodsDaoImpl.php';
interface GoodsDao
{


    /**
     * @param $conn
     * @param $id
     * @return mixed
     * 根据id获取单个信息
     */
    public static function getById($conn,$id);


    /**
     * @param $conn
     * @param $field
     * @param $value
     * @param $status
     * @param $num
     * @return mixed
     * 根据一个字段名进行查询获取多个对象
     */
    public static function listByfield($conn,$field,$value,$status,$num);



}