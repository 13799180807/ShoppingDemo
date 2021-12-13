<?php
namespace src\Application\Service;

use src\Application\Dao\GoodsPictureDaoImpl;
use src\Application\Helper\FilterHelper;
use src\Application\Library\Connection;
use src\Application\Model\GoodsModel;

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