<?php

namespace Application\Service;

use Application\Dao\GoodsPictureDaoImpl;
use Application\Domain\GoodsPicture;

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

        $res=(new GoodsPictureDaoImpl())->getByField("goods_id",$goodsId);

        if (count($res) > 0) {
            return (new GoodsPicture())->pictureModel($res);
        } else {
            return array();
        }


    }

    /**
     * 批量删除照片
     * @param array $imgArr
     * @return array
     */
    public function movePhotos(array $imgArr): array
    {
        foreach ($imgArr as $value) {
            /** 查询这个商品id进行获取本地存储名字 */
            $res = (new GoodsPictureDaoImpl())->getByField("id", $value);
            if (count($res) != 0) {
                $imgName = $res[0]['goods_picture_path'];
                $path = "upload/" . $imgName;
                deleteFile($path);
                /** 删除表数据 */
                (new GoodsPictureDaoImpl())->removeByField("id", $value);
            }
        }
        return array(
            'status' => true,
            'msg' => "删除成功"
        );


    }
}