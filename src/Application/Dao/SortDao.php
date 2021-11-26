<?php
require 'SortDaoImpl.php';

interface SortDao{

    /**
     * @param $conn
     * @return mixed
     * 查询
     */
    public function sortListQuery($conn);

    /**
     * @param $conn
     * @param $id
     * @return mixed
     * 删除
     */
    public function sortOneDelect($conn,$id);

    /**
     * @param $conn
     * @param $name
     * @return mixed
     * 插入操作
     */
    public function sortInsert($conn,$name);

    /**
     * @param $conn
     * @param $id
     * @param $name
     * @return mixed
     * 修改分类名称
     */
    public function sortUpdate($conn,$id,$name);

}