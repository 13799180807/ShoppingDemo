<?php

namespace Application\Service;

use Application\Dao\GoodsPictureDaoImpl;
use Application\Domain\GoodsPicture;
use Application\Helper\Filter;

class GoodsPictureServiceImpl implements GoodsPictureService
{

    /**
     * 添加图片
     * @param int $goodsId
     * @param array $fileArr
     * @return array
     */
    public function saveByGoodsId(int $goodsId, array $fileArr): array
    {
        // TODO: Implement saveByGoodsId() method.
        if (count($fileArr) == 0) {
            return array(
                'status' => false,
                'msg' => "照片为空添加失败"
            );
        }
        /** 验证该商品存在不存在 */

        $success = 0;
        $failed = 0;
        foreach ($fileArr as $value) {
            $res = (new GoodsPictureDaoImpl())->saveByGoodsId($goodsId, $value);
            if ($res == 0) {
                $failed = $failed + 1;
            } else {
                $success = $success + 1;
            }
        }
        $msg = "添加成功 " . $success . " 张，" . "失败 " . $failed . " 张。";
        return array(
            'status' => true,
            'msg' => $msg
        );
    }

    /**
     * 根据id获取详情页面图片信息
     * @param int $goodsId
     * @return array
     */
    public function getGoodsId(int $goodsId): array
    {

        $res = (new GoodsPictureDaoImpl())->getGoodsId($goodsId);

        if (count($res) > 0) {
            return (new GoodsPicture())->pictureModel($res);
        } else {
            return array();
        }


    }


}