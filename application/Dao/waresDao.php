<?php
require 'waresDaolmpl.php';

interface  waresDao{

    /**
     * @param $typea
     * @param $num
     * @param $state
     * @return mixed
     * 主页分类接口查询
     */
    public function waresShowindex($typea,$num,$state);

    /**
     * @param $sp_uid
     * @return mixed
     * 显示商品图片用的
     */
    public function waresShowImg($sp_uid);

    /**
     * @param $sp_uid
     * @return mixed
     * 显示商品介绍用的
     */
    public function waresShowText($sp_uid);

    /**
     * @param $sp_uid
     * @return mixed
     * 商品详情页面显示
     */
    public function waresShowDetails($sp_uid);



}

