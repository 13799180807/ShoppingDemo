<?php
namespace Application\Service;

use Application\Dao\GoodsPictureDaoImpl;
use Application\Helper\FilterHelper;
use Application\Library\Connection;
use Application\Model\GoodsModel;

class GoodsPictureServiceImpl implements GoodsPictureService
{
    /**
     * 根据id获取详情页面图片信息
     * @param int $goodsId
     * @return array
     */
    public static function getGoodsId(int $goodsId) :array
    {
        $data=array(
            'id'=>$goodsId
        );
        /** 安全过滤 */
        $data=FilterHelper::safeReplace($data);
        $conn=Connection::conn();
        $res=GoodsPictureDaoImpl::getGoodsId($conn,$data['id']);
        $conn->close();

        if (count($res)>0)
        {
            return GoodsModel:: GoodsPictureInformationDisplay($res);
        }else{
            return array();
        }


    }
}