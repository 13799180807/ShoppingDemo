<?php

namespace Application\Dao;

use Application\Library\SqlUtil;

class GoodsCategoryDaoImpl implements GoodsCategoryDao
{
    private string $sql = "";
    private string $fieldsType = "";
    private array $dataList = array();

    /**
     * 获取所有分类信息
     * @return array
     */
    public function listCategory(): array
    {
        $sql = "SELECT * FROM tb_goods_category ";
        return (new SqlUtil())->run("queryAll", $sql);
    }

    /**
     * 根据商品表中的条件进行统计一共满足条件有多少个数量返回int
     * @param string $goodsName
     * @param int $goodsStatus
     * @param int $categoryId
     * @param int $goodsHot
     * @param int $goodsRecommendation
     * @return int
     */
    public function countCategoryByGoodsCondition(string $goodsName = "", int $goodsStatus = 0, int $categoryId = 0,
                                                  int $goodsHot = 0, int $goodsRecommendation = 0): int
    {
        /** 反斜杠引用字符串 */
        $goodsName = str_replace("%", " ", addslashes($goodsName));

        /** sql组装 */
        self::combinationSql($goodsName, $goodsStatus, $categoryId, $goodsHot, $goodsRecommendation);
        $fieldsType = $this->fieldsType;
        $dataList = $this->dataList;

        $sql = "SELECT * FROM tb_goods WHERE" . $this->sql;

        /** 去掉多余的得到我要的 */
        $sql = trim($sql, "AND");

        /** 判断一下是否有条件查询 */
        if (count($dataList) == 0) {
            $sql = trim($sql, "WHERE");
            return (new SqlUtil())->run("countAll", $sql);
        } else {
            return (new SqlUtil())->run("count", $sql, $fieldsType, $dataList);
        }
    }

    /**
     * 组装sql
     * @param $goods_name
     * @param $goods_status
     * @param $category_id
     * @param $goods_hot
     * @param $goods_recommendation
     */
    private function combinationSql($goods_name, $goods_status, $category_id, $goods_hot, $goods_recommendation)
    {
        $sql = $this->sql;
        $fieldsType = $this->fieldsType;
        $dataList = $this->dataList;

        if ($goods_name != "") {
            $sql = $sql . "  goods_name LIKE ? AND";
            $name = "%" . $goods_name . "%";
            $fieldsType = $fieldsType . "s";
            $dataList[] = $name;
        }

        if ($goods_status != 0) {
            $sql = $sql . "  goods_status=? AND";
            $fieldsType = $fieldsType . "i";
            $dataList[] = $goods_status;
        }

        if ($category_id != 0) {
            $sql = $sql . "  goods_category_id=? AND";
            $fieldsType = $fieldsType . "i";
            $dataList[] = $category_id;
        }

        if ($goods_hot != 0) {
            $sql = $sql . "  goods_hot=? AND";
            $fieldsType = $fieldsType . "i";
            $dataList[] = $goods_hot;
        }

        if ($goods_recommendation != 0) {
            $sql = $sql . "  goods_recommendation=? ";
            $fieldsType = $fieldsType . "i";
            $dataList[] = $goods_recommendation;
        }
        $this->sql = $sql;
        $this->fieldsType = $fieldsType;
        $this->dataList = $dataList;
    }

    /**
     * 获取分页信息数据
     * @param string $userType
     * @param string $goodsName
     * @param int $goodsStatus
     * @param int $goodsCategoryId
     * @param int $goodsHot
     * @param int $goodsRecommendation
     * @param int $page
     * @param int $num
     * @return array
     */
    public function listCategoryGoods(string $userType, string $goodsName, int $goodsStatus, int $goodsCategoryId, int $goodsHot,
                                      int $goodsRecommendation, int $page, int $num): array
    {
        /** 反斜杠引用字符串 */
        $goodsName = str_replace("%", " ", addslashes($goodsName));

        $page = ($page - 1) * $num;

        /** 组合sql */
        self::combinationSql($goodsName, $goodsStatus, $goodsCategoryId, $goodsHot, $goodsRecommendation);
        $fieldsType = $this->fieldsType;
        $dataList = $this->dataList;

        /** sql语句组合 */
        if ($userType == "admin") {
            $sql = "SELECT * FROM tb_goods  WHERE" . $this->sql;
        } else {
            $sql = "SELECT goods_id,goods_name,goods_category_id,goods_price,goods_img FROM tb_goods  WHERE" . $this->sql;
        }

        /** 去掉不想要的 */
        $sql = trim($sql, "AND");
        /** 判断一下是否有条件查询 */
        if (count($dataList) == 0) {
            $sql = trim($sql, "WHERE");
        }
        $sql = $sql . " ORDER BY created_at LIMIT ?,?";
        $fieldsType = $fieldsType . "ii";
        $dataList[] = $page;
        $dataList[] = $num;
        return (new SqlUtil())->run("query", $sql, $fieldsType, $dataList);
    }

    /**
     * 获取单个分类信息
     * @param int $categoryId
     * @return array
     */
    public function getGoodsCategoryId(int $categoryId): array
    {
        $sql = "SELECT * FROM tb_goods_category WHERE goods_category_id=? ";
        return (new SqlUtil())->run("query", $sql, "i", array($categoryId));
    }

    /**
     * 根据这个id删除这个分类
     * @param int $categoryId
     * @return bool
     */
    public function removeByGoodsCategoryId(int $categoryId): bool
    {
        $sql = "DELETE FROM tb_goods_category WHERE goods_category_id=?";
        return (new SqlUtil())->run("remove", $sql, "i", array($categoryId));
    }

}

