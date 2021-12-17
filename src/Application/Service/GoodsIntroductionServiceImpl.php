<?php
namespace Application\Service;

use Application\Dao\GoodsIntroductionDaoImpl;
use Application\Domain\GoodsIntroduction;
use Application\Helper\FilterHelper;

class GoodsIntroductionServiceImpl implements GoodsIntroductionService
{
    /**
     * 根据id进行获取商品详情
     * @param int $goodsId
     * @return array
     */
    public function getGoodsId(int $goodsId) : array
    {
        $data=array(
            'id'=>$goodsId,
        );
        /** 安全过滤 */
        $data=FilterHelper::safeReplace($data);
        $res=(new GoodsIntroductionDaoImpl())->getGoodsId("*",$data['id']);

        if (count($res)>0)
        {
            return (new GoodsIntroduction())->introductionModel($res);
        }else{
            return array();
        }

    }
}