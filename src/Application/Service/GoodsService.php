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

    /**
     * 根据商品id进行更新这个分类
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
     * @param string $introduction
     * @return array
     */
    public function updateGoodsById(int $goodsId, string $name, int $categoryId, float $prick, int $stock, int $status = 1,
                                    int $hot = 2, int $recommendation = 2, string $describe = "", string $img = "",string $introduction="") :array;




//    /**
//     * 根据名字模糊查询
//     * @param string $goodsName
//     * @return array
//     */
//    public function getByGoodsName(string $goodsName) :array;


}
