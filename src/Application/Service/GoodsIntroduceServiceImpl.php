<?php


class GoodsIntroduceServiceImpl implements GoodsIntroduceService
{


    /**
     * @param $goodsId
     * @return array|mixed
     */
    public static function getGoodsId($goodsId) : array
    {
        // TODO: Implement getById() method.
        $conn=Connection::conn();
        $res=GoodsIntroduceDaoImpl::getGoodsId($conn,$goodsId);
        $conn->close();
        return $res;
    }
}