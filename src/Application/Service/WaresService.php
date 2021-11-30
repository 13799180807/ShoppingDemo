<?php
require 'WaresServiceImpl.php';
interface WaresService
{

    /**
     * @param $typea
     * @param $num
     * @param $state
     * @return mixed
     * 根据分类进行，数量，进行查询显示
     */
    public static function waresShowAll($typea,$num,$state);

    /**
     * @param $sp_uid
     * @return mixed
     * 详细介绍页面图片显示
     */
    public static function waresImgAll($sp_uid);

    /**
     * @param $sp_uid
     * @return mixed
     * 详细介绍页面商品说明用的
     */
    public static function waresTextAll($sp_uid);

    /**
     * @param $sp_uid
     * @return mixed
     * 显示一个商品的查询
     */
    public static function waresOneAll($sp_uid);

    /**
     * @param $name
     * @return mixed
     * 模糊查询
     */
    public static function waresFuzzySearch($name);

    /**
     * @param $name
     * @return mixed
     * 模糊查询
     */
    public function waresFuzzySearch($name);

}