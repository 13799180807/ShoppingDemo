<?php

namespace Application\Service;

use Application\Dao\GoodsCategoryDaoImpl;
use Application\Dao\GoodsDaoImpl;
use Application\Dao\GoodsIntroductionDaoImpl;
use Application\Dao\GoodsPictureDaoImpl;
use Application\Domain\Goods;
use Application\Domain\GoodsIntroduction;
use Application\Domain\GoodsPicture;

class GoodsServiceImpl implements GoodsService
{
    /**
     * 商城主页显示信息用的
     * @return array[]
     */
    public function listIndex(): array
    {
        $resHot = (new GoodsDaoImpl())->listField(5, 1, "goods_hot", "1");
        $resRecommendation = (new GoodsDaoImpl())->listField(5, 1, "goods_recommendation", "1");
        $resNewest = (new GoodsDaoImpl())->listField(7, 1, "goods_hot", "1");

        $hot = (new Goods())->goodsModel($resHot);
        $recommend = (new Goods())->goodsModel($resRecommendation);
        $newest = (new Goods())->goodsModel($resNewest);

        return array(
            "hot" => $hot,
            "recommend" => $recommend,
            "newest" => $newest
        );

    }

    /**
     * 单个商品详情页面
     * @param int $id
     * @param int|null $status
     * @return array
     */
    public function listGoodsIdShow(int $id, int $status = null): array
    {
        /** 检查商品存在不存在 */
        $goodsRes = (new GoodsDaoImpl())->getByGoodsId($id);
        if (count($goodsRes) == 0) {
            return array(
                'status' => false,
                'msg' => "商品不存在",
                'data' => array()
            );
        }
        /** 判断需要查找的商品状态 */
        if ($status != null) {
            if ($goodsRes[0]['goods_status'] != $status) {
                return array(
                    'status' => false,
                    'msg' => "商品已经下架啦",
                    'data' => array()
                );
            }
        }


        /** 查询商品信息 */
        $resImg = (new GoodsPictureDaoImpl())->getByField("goods_id", $id);
        $resText = (new GoodsIntroductionDaoImpl())->getGoodsId($id);

        /** 数据进行组装输出*/
        return array(
            'status' => true,
            'msg' => "商品查询成功",
            'data' => array(
                "goods" => (new Goods())->goodsModel($goodsRes),
                "categoryList" => (new GoodsCategoryDaoImpl())->listCategory(),
                "goodsIntroduce" => (new GoodsIntroduction())->introductionModel($resText),
                "goodsPicture" => (new GoodsPicture())->pictureModel($resImg)
            ),
        );

    }

    /**
     * 更新一个商品表的信息根据id
     * @param int $goodsId
     * @param string $name
     * @param int $categoryId
     * @param float $prick
     * @param int $stock
     * @param int $status
     * @param int $hot
     * @param int $recommendation
     * @param string $describe
     * @param string $img
     * @param string $introduction
     * @return string[]
     */
    public function updateGoodsById(int $goodsId, string $name, int $categoryId, float $prick, int $stock, int $status = 1,
                                    int $hot = 2, int $recommendation = 2, string $describe = "", string $img = "", string $introduction = ""): array
    {
        /** 判断这个商品id存在不存在 为了防止不通过表单进行操作进入数据库 */
        $res = (new GoodsDaoImpl())->getByGoodsId($goodsId);
        if (count($res) == 0) {
            /** 数据不存在 */
            return array(
                "msg" => "请正确操作，该数据不存在。你的行为已经被记录！！！"
            );
        }

        /** 判断商品图片有没有更新，如果有更新删除原来的图片的 */
        if ($img != "") {
            /** 查询原先商品信息  获得图片的名称  执行删除文件*/
            $imageName = $res[0]['goods_img'];
            /** 检测文件删除 */
            $path = UPLOAD_PATH . $imageName;
            deleteFile($path);
        }

        /** 执行修改商品表中的商品信息操作 */
        (new GoodsDaoImpl())->updateGoodsById($goodsId, $name, $categoryId, $prick, $stock, $status, $hot, $recommendation, $describe, $img);

        /** 检查商品详细表中存在不存在这条数据不存在则插入，存在则修改 */
        if (count((new GoodsIntroductionDaoImpl())->getGoodsId($goodsId)) == 0) {
            /** 插入操作 */
            (new GoodsIntroductionDaoImpl())->saveByGoodsId($goodsId, $introduction);

        } else {
            /** 修改操作 */
            (new GoodsIntroductionDaoImpl())->updateByGoodsId($goodsId, $introduction);
        }

        /** 回调函数 */
        return array(
            "msg" => "商品修改成功"
        );
    }

    /**
     * 管理员添加商品
     * @param string $goodsName
     * @param int $goodsCategoryId
     * @param float $goodsPrice
     * @param int $goodsStock
     * @param int $goodsStatus
     * @param int $goodsHot
     * @param int $goodsRecommendation
     * @param string $goodsDescribe
     * @param string $goodsImg
     * @param string $introduction
     * @return string[]
     */
    public function saveGoods(string $goodsName, int $goodsCategoryId, float $goodsPrice, int $goodsStock = 0, int $goodsStatus = 1, int $goodsHot = 2, int $goodsRecommendation = 2, string $goodsDescribe = "", string $goodsImg = "", string $introduction = ""): array
    {

        /** 检测这个分类存在不存在，不存在则拒绝创建 */
        if (!count((new GoodsCategoryDaoImpl())->getGoodsCategoryId($goodsCategoryId)) > 0) {
            /** 不存在 */
            /** 进行上传的照片删除 */
            $path = "upload/" . $goodsImg;
            deleteFile($path);
            return array(
                "msg" => "添加的分类不存在！！！"
            );
        }

        /** 添加商品操作 返回自增商品id */
        $goodsId = (new GoodsDaoImpl())->saveGoods($goodsName, $goodsCategoryId, $goodsPrice, $goodsStock, $goodsStatus, $goodsHot, $goodsRecommendation, $goodsDescribe, $goodsImg);

        /** 根据商品id进行操作 判断有没有添加详细说明和详细图片 */
        if ($introduction != "") {
            /** 进行详细说明添加 */
            (new GoodsIntroductionDaoImpl())->saveByGoodsId($goodsId, $introduction);
        }

        /** 回调数据 */
        return array(
            'msg' => "商品添加成功"
        );
    }


    /**
     * 根据指定的商品id进行商品的删除
     * @param int $goodsId
     * @return array
     */
    public function removeByGoodsId(int $goodsId): array
    {
        /** 获取商品表中的主图名字 */

        $goodsRes = (new GoodsDaoImpl())->getByGoodsId($goodsId);
        if (count($goodsRes) != 0) {
            $imageName = $goodsRes[0]['goods_img'];
            /** 检测文件删除 */
            $path = UPLOAD_PATH . $imageName;
            deleteFile($path);
        }
        /** 获取图片表中所有有关这个商品的图片 */
        $pictureRes = (new GoodsPictureDaoImpl())->getByField("goods_id", $goodsId);
        if (count($pictureRes) != 0) {
            foreach ($pictureRes as $row) {
                $path = UPLOAD_PATH . $row['goods_picture_path'];
                deleteFile($path);
            }
        }

        /** 删除数据库中的记录 */
        (new GoodsDaoImpl())->removeByField($goodsId);
        /** 删除详细信息说明 */
        (new GoodsIntroductionDaoImpl())->removeByGoodsId($goodsId);
        /** 删除数据库中关联图片记录 */
        (new GoodsPictureDaoImpl())->removeByField("goods_id", $goodsId);

        /** 返回数据 */
        return array(
            'status' => true,
            'msg' => "删除完成"
        );

    }
}