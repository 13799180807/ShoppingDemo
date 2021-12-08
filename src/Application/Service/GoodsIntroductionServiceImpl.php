<?php


class GoodsIntroductionServiceImpl implements GoodsIntroductionService
{


    /**
     * @param $goodsId
     * @return array|mixed
     */
    public static function getGoodsId($goodsId) : array
    {
        // TODO: Implement getById() method.
        $conn=Connection::conn();
        $res=GoodsIntroductionDaoImpl::getGoodsId($conn,$goodsId);
        $conn->close();
        return $res;
    }
}