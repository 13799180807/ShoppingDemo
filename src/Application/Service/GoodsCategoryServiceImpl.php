<?php

namespace Application\Service;

use Application\Dao\GoodsCategoryDaoImpl;
use Application\Dao\GoodsDaoImpl;
use Application\Dao\GoodsIntroductionDaoImpl;
use Application\Dao\GoodsPictureDaoImpl;
use Application\Domain\Goods;
use Application\Domain\GoodsCategory;
use Application\Exception\Log;
use Application\Helper\Filter;

class GoodsCategoryServiceImpl implements GoodsCategoryService
{

    /**
     * 分类查询显示用的
     * @param string $userType
     * @param int $page
     * @param int $num
     * @param int $status
     * @param int $categoryId
     * @param string $name
     * @param int $hot
     * @param int $recommendation
     * @return array
     */
    public function listCategoryGoods(string $userType, int $page, int $num, int $status, int $categoryId = 0, string $name = "", int $hot = 0, int $recommendation = 0): array
    {

        /** 区分用户 */
        if ($userType == 'admin') {
            /**获得数量*/
            $totalPage = (new GoodsCategoryDaoImpl())->countCategoryByGoodsCondition($name, $status, $categoryId, $hot, $recommendation);
            /** 查询对应分页信息 */
            $goodsList = (new GoodsCategoryDaoImpl())->listCategoryGoods('admin', $name, $status, $categoryId, $hot, $recommendation, $page, $num);

        } else {
            /** 获得数量 */
            $totalPage = (new GoodsCategoryDaoImpl())->countCategoryByGoodsCondition("", $status, $categoryId);

            /** 查询分页的商品信息 */
            $goodsList = (new GoodsCategoryDaoImpl())->listCategoryGoods('user', $name, $status, $categoryId, 0, 0, $page, $num);

        }

        /** 统计页码 */
        $totalPage = ceil($totalPage / $num);

        /** 获取所有分类信息 */
        $categoryList = (new GoodsCategoryDaoImpl())->listCategory();

        if ($categoryId == 0) {
            $categoryName = "不限";
        } else {
            $res = (new GoodsCategoryDaoImpl())->getGoodsCategoryId($categoryId);
            if (count($res) > 0) {
                $categoryName = $res[0]["goods_category_name"];
            } else {
                $categoryName = "未分类";
            }

        }

        $categoryList = (new GoodsCategory())->categoryModel($categoryList);
        $goodsList = (new Goods())->goodsModel($goodsList);
        //回调信息
        $callBack = array(
            "totalPage" => $totalPage,
            "page" => $page,
            "num" => $num,
            "categoryId" => $categoryId,
            "categoryName" => $categoryName
        );
        return array(
            "category" => $categoryList,
            "goodsList" => $goodsList,
            "callBack" => $callBack
        );

    }

    /**
     * 获取所有商品分类
     * @return array
     */
    public function listCategory(): array
    {
        $res = (new GoodsCategoryDaoImpl())->listCategory();
        return (new GoodsCategory())->categoryModel($res);
    }


}