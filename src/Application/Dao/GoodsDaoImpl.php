<?php

namespace Application\Dao;

use Application\Helper\Filter;
use Application\Library\SqlUtil;

class GoodsDaoImpl implements GoodsDao
{
    /**
     * 根据参数删除表数据
     * @param int|null $goodsId
     * @param int|null $categoryId
     * @return bool
     */
    public function removeByField(int $goodsId = null, int $categoryId = null): bool
    {
        if (($goodsId == null && $categoryId == null) || ($goodsId != null && $categoryId != null)) {
            return false;
        }
        $sql = "DELETE FROM tb_goods WHERE";
        $data = array();

        if ($goodsId != null) {
            $sql = $sql . " goods_id=?";
            $data[] = $goodsId;
        }
        if ($categoryId != null) {
            $sql = $sql . " goods_category_id=?";
            $data[] = $categoryId;
        }

        return (new SqlUtil())->run("remove", $sql, "i", $data);
    }

    /**
     * 根据商品id获取信息
     * @param int $goodsId
     * @return array
     */
    public function getByGoodsId(int $goodsId): array
    {
        $sql = "SELECT * FROM tb_goods WHERE goods_id=? ";
        $data = Filter::preventXss(array($goodsId));
        return (new SqlUtil())->run("query", $sql, "i", $data);
    }


    /** 修改前后分界线 */


    /**
     * 根据不同字段进行查询该字段的信息
     * @param int $num
     * @param int $status
     * @param string $field
     * @param string $value
     * @return array
     */
    public function listField(int $num, int $status, string $field = "", string $value = ""): array
    {
        $sql = "SELECT goods_id,goods_name,goods_category_id,goods_price,goods_img FROM tb_goods WHERE";
        $dataList = array();
        $fieldsType = "";

        if ($status != 0) {
            $sql = $sql . " goods_status=? AND";
            $dataList[] = $status;
            $fieldsType = $fieldsType . "i";
        }

        /** 拼接sql */
        if ($field != "") {
            $sql = $sql . " " . $field . "=? ORDER BY updated_at DESC limit ?";
            $dataList[] = $value;
            $dataList[] = $num;
            $fieldsType = $fieldsType . "si";
        } else {
            $sql = trim($sql, "WHERE");
            $sql = trim($sql, "AND");
            $sql = $sql . " ORDER BY created_at DESC limit ?";
            $dataList[] = $num;
            $fieldsType = $fieldsType . "i";
        }
        return (new SqlUtil())->run("query", $sql, $fieldsType, $dataList);

    }

    /**
     * 根据名字进行模糊查询商品信息
     * @param string $goodsName
     * @param int $status
     * @return array
     */
    public function getByGoodsName(string $goodsName, int $status = 0): array
    {
        $sql = "SELECT goods_id,goods_name,goods_category_id,goods_price,goods_img FROM tb_goods WHERE";
        $dataList = array();
        $goodsName = str_replace("%", " ", addslashes($goodsName));
        $goodsName = "%" . $goodsName . "%";
        /** 拼装 */
        if ($status != 0) {
            $sql = $sql . " goods_status=? and goods_name  LIKE ?";
            $fieldsType = "is";
            $dataList[] = $status;
            $dataList[] = $goodsName;
        } else {
            $sql = $sql . " goods_name  LIKE ?";
            $fieldsType = "s";
            $dataList[] = $goodsName;
        }
        return (new SqlUtil())->run("query", $sql, $fieldsType, $dataList);
    }

    /**
     * 获取这个分类下的商品的id
     * @param int $goodsCategoryId
     * @return array
     */
    public function listGoodsCategoryId(int $goodsCategoryId): array
    {
        $sql = "SELECT goods_id FROM tb_goods WHERE goods_category_id=? ";
        return (new SqlUtil())->run("query", $sql, "i", array($goodsCategoryId));
    }

    /**
     * 根据商品id进行这个分类更新
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
     * @return bool
     */
    public function updateGoodsById(int $goodsId, string $name, int $categoryId, float $prick, int $stock, int $status = 1,
                                    int $hot = 2, int $recommendation = 2, string $describe = "", string $img = ""): bool
    {
        /** 过滤转义字符 */
        $filterArr = array(
            "name" => $name,
            "describe" => $describe,
            "img" => $img,
        );
        $resFilter = Filter::setEntities($filterArr);

        if ($filterArr['img'] == "") {
            $sql = "UPDATE tb_goods SET goods_name=?,goods_category_id=?,goods_price=?,goods_stock=?,goods_status=?,
                  goods_hot=?, goods_recommendation=? ,goods_describe=? WHERE goods_id=? ";
            $dataList = array($resFilter['name'], $categoryId, $prick, $stock, $status, $hot, $recommendation, $resFilter['describe'], $goodsId);
            return (new SqlUtil())->run("update", $sql, "sisiiiisi", $dataList);
        }

        $sql = "UPDATE tb_goods SET goods_name=?,goods_category_id=?,goods_price=?,goods_stock=?,goods_status=?,
                  goods_hot=?, goods_recommendation=? ,goods_describe=?,goods_img=? WHERE goods_id=? ";
        /** 执行操作 */
        $dataList = array($resFilter['name'], $categoryId, $prick, $stock, $status, $hot, $recommendation, $resFilter['describe'], $resFilter['img'], $goodsId);
        return (new SqlUtil())->run("update", $sql, "sisiiiissi", $dataList);

    }


    public function saveGoods(string $goodsName, int $goodsCategoryId, float $goodsPrice, int $goodsStock = 0, int $goodsStatus = 1, int $goodsHot = 2,
                              int $goodsRecommendation = 2, string $goodsDescribe = "", string $goodsImg = ""): int
    {
        /** 过滤 */
        $resFilter = Filter::setEntities(array(
            "goodsName" => $goodsName,
            "goodsDescribe" => $goodsDescribe,
            "goodsImg" => $goodsImg
        ));

        /** sql */
        $sql = "INSERT INTO tb_goods (goods_name, goods_category_id, goods_price, goods_stock, goods_status, goods_hot, goods_recommendation, goods_describe, goods_img) VALUES (?,?,?,?,?,?,?,?,?)";

        /** 执行查询 ，查询结果返回插入的自增id */
        return (new SqlUtil())->run("save", $sql, "sisiiiiss", array(
            $resFilter['goodsName'], $goodsCategoryId, $goodsPrice, $goodsStock, $goodsStatus, $goodsHot, $goodsRecommendation, $resFilter['goodsDescribe'], $resFilter['goodsImg']));
    }


}