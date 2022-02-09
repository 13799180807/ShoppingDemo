<?php


namespace Application\Service;

use Application\Dao\GoodsDaoImpl;
use Application\Dao\ShoppingCartsDaoImpl;
use Application\Dao\UserInformationDaoImpl;

class ShoppingCartsServiceImpl implements ShoppingCartsService
{

    /**
     * 购物车加入商品
     * @param string $userId
     * @param int $goodsId
     * @param int $cartNum
     * @return array
     */
    public function saveShoppingCart(string $userId, int $goodsId, int $cartNum): array
    {
        /** 判断用户信息 */
        $isUser = (new UserInformationDaoImpl())->listUserInformationByField($userId);
        if (count($isUser) == 0) {
            return array(
                'status' => false,
                'msg' => "用户信息不存在，请正确操作"
            );
        }
        /** 检测该商品 是否上架的  */
        $isGoods = (new GoodsDaoImpl())->getByGoodsId($goodsId);
        if (count($isGoods) == 0) {
            return array(
                'status' => false,
                'msg' => "该商品不存在"
            );
        }
        if ($isGoods[0]['goods_status'] != 1) {
            return array(
                'status' => false,
                'msg' => "该商品已经下架"
            );
        }

        /** 进行判断一次当购物车存在相同数据的时候 执行数量相加 添加之前检查表，在进行选择操作 */
        #####


        /** 执行加入购物车 */
        $res = (new ShoppingCartsDaoImpl())->saveShoppingCart($userId, $goodsId, $cartNum);
        if ($res < 1) {
            return array(
                'status' => false,
                'msg' => "加入购物车失败"
            );
        }
        return array(
            'status' => true,
            'msg' => "加入购物车成功"
        );

    }
}