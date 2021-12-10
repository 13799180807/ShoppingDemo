<?php
namespace src\Application\Service;

use src\Application\Dao\GoodsIntroductionDaoImpl;
use src\Application\Library\Connection;
use src\Application\Model\GoodsModel;

class GoodsIntroductionServiceImpl implements GoodsIntroductionService
{
    /**
     * 根据id进行获取商品详情
     * @param int $goodsId
     * @return array
     */
    public static function getGoodsId(int $goodsId) : array
    {
        $conn=Connection::conn();
        $res=GoodsIntroductionDaoImpl::getGoodsId($conn,$goodsId);
        $conn->close();
        if (count($res)>0)
        {
            return GoodsModel::GoodsIntroduceInformationDisplay($res);
        }else{
            return array();
        }

    }
}