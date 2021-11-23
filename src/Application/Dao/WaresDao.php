<?php
require 'WaresDaoImpl.php';

interface  waresDao{


    /**
     * @param $conn
     * @param $typea
     * @param $num
     * @param $state
     * @return mixed
     * 主页分类查询用的
     */
    public function waresNewsQuery($conn,$typea,$num,$state);

    /**
     * @param $conn
     * @param $sp_uid
     * @return mixed
     * 查询表中的某个商品的图片信息
     */
    public function waresImgQuery($conn,$sp_uid);

    /**
     * @param $conn
     * @param $sp_uid
     * @return mixed
     * 查询表中的某个商品详细介绍
     */
    public function waresTextQuery($conn,$sp_uid);


    /**
     * @param $conn
     * @param $sp_uid
     * @return mixed
     * 当个商品查询
     */
    public function waresOneQuery($conn,$sp_uid);






}

