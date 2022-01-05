<?php

namespace Application\Service;

use Application\Dao\GoodsPictureDaoImpl;
use Application\Domain\GoodsPicture;
use Application\Helper\Filter;

class GoodsPictureServiceImpl implements GoodsPictureService
{
//    /**
//     * 根据id获取详情页面图片信息
//     * @param int $goodsId
//     * @return array
//     */
//    public function getGoodsId(int $goodsId) :array
//    {
//        $data=array(
//            'id'=>$goodsId
//        );
//        /** 安全过滤 */
//        $data=Filter::safeReplace($data);
//        $res=(new GoodsPictureDaoImpl())->getGoodsId("*",$data['id']);
//
//        if (count($res)>0)
//        {
//            return (new GoodsPicture())->pictureModel($res);
//        }else{
//            return array();
//        }
//
//
//    }
}