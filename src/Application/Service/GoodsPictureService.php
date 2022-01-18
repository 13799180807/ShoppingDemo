<?php

namespace Application\Service;
interface GoodsPictureService
{
    /**
     * 根据id获取商品的图片信息
     * @param int $goodsId
     * @return mixed
     */
    public function getGoodsId(int $goodsId);

    /**
     * 添加图片
     * @param int $goodsId
     * @param array $fileArr
     * @return array
     */
    public function saveByGoodsId(int $goodsId,array $fileArr) :array;



}
