<?php
namespace Application\Service;
interface GoodsService{

    /**
     * 主页显示用的
     * @return array
     */
    public function listIndex() :array;


    /**
     * 单个商品详情页面使用
     * @param string $userType
     * @param int $id
     * @return array
     */
    public function listGoodsIdShow(string $userType,int $id) :array;




//    /**
//     * 根据名字模糊查询
//     * @param string $goodsName
//     * @return array
//     */
//    public function getByGoodsName(string $goodsName) :array;


}
