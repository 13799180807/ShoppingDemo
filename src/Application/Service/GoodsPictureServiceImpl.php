<?php


class GoodsPictureServiceImpl implements GoodsPictureService
{
    /**
     * @param $goodsId
     * @return array
     * 获取对应的商品图片信息
     */
    public static function getGoodsId($goodsId) :array
    {
        // TODO: Implement getGoodsId() method.
        $conn=Connection::conn();
        $res=GoodsPictureDaoImpl::getGoodsId($conn,$goodsId);
        $conn->close();
        return $res;
    }
}