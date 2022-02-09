<?php

namespace Application\Service;
interface GoodsService
{

    /**
     * 主页显示用的
     * @return array
     */
    public function listIndex(): array;


    /**
     * 单个商品详情页面使用
     * @param int $id
     * @param int|null $status
     * @return array
     */
    public function listGoodsIdShow(int $id,int $status=null): array;

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
                                    int $hot = 2, int $recommendation = 2, string $describe = "", string $img = "", string $introduction = ""): array;

    /**
     * 添加商品
     * @param string $goodsName
     * @param int $goodsCategoryId
     * @param float $goodsPrice
     * @param int $goodsStock
     * @param int $goodsStatus
     * @param int $goodsHot
     * @param int $goodsRecommendation
     * @param string $goodsDescribe
     * @param string $goodsImg
     * @param string $introduction
     * @return array
     */
    public function saveGoods(string $goodsName, int $goodsCategoryId, float $goodsPrice, int $goodsStock = 0, int $goodsStatus = 1,
                              int $goodsHot = 2, int $goodsRecommendation = 2, string $goodsDescribe = "", string $goodsImg = "", string $introduction = ""): array;

    /**
     * 根据指定的商品id进行商品的删除
     * @param int $goodsId
     * @return array
     */
    public function removeByGoodsId(int $goodsId): array;


}
