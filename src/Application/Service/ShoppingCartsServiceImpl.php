<?php


namespace Application\Service;

use Application\Dao\GoodsDaoImpl;
use Application\Dao\ShoppingCartsDaoImpl;
use Application\Dao\UserInformationDaoImpl;
use Application\Domain\Goods;
use Application\Domain\ShoppingCarts;

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
        /** 检查购物车存在不存在相同产品 */
        $isCarts = (new ShoppingCartsDaoImpl())->getByField(null, $userId, $goodsId);
        if (count($isCarts) == 0) {
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
        /** 购物车存在此商品，修改数量 */
        $num = $isCarts[0]['cart_num'] + $cartNum;
        (new ShoppingCartsDaoImpl())->updateByCartId($isCarts[0]['cart_id'], $num);
        return array(
            'status' => true,
            'msg' => "加入购物车成功"
        );
    }

    /**
     * 删除购物车一条记录
     * @param int $cartsId
     * @param string $userId
     * @return array
     */
    public function moveByCartsId(int $cartsId, string $userId): array
    {
        /** 检查数据存在不存在 */
        $isCarts = (new ShoppingCartsDaoImpl())->getByField($cartsId);
        if (count($isCarts) == 0) {
            return array(
                'status' => false,
                'msg' => "商品不存在，删除失败"
            );
        }
        /** 判断数据是不是这个用户的 */
        if ($isCarts[0]['user_id'] != $userId) {
            return array(
                'status' => false,
                'msg' => "删除失败,购物车不存在该商品"
            );
        }
        /** 执行删除记录 */
        (new ShoppingCartsDaoImpl())->moveByField($cartsId);
        return array(
            'status' => true,
            'msg' => "删除成功"
        );
    }

    /**
     * 购物车加减   $operation=1加
     * @param int $cartsId
     * @param string $userId
     * @param int $operation
     * @param int $num
     * @return array
     */
    public function updateCartsId(int $cartsId, string $userId, int $operation, int $num = 1): array
    {
        /** 判断购物车存在不存在这个数据 */
        $isCarts = (new ShoppingCartsDaoImpl())->getByField($cartsId);
        if (count($isCarts) == 0) {
            return array(
                'status' => false,
                'msg' => "商品不在购物车，操作失败"
            );
        }
        /** 判断用户是不是这个用户的数据 */
        if ($isCarts[0]['user_id'] != $userId) {
            return array(
                'status' => false,
                'msg' => "商品不存在"
            );
        }
        /** 检查数量  数量=1时不进行减法操作，只加不减 */
        $cartsNum = $isCarts[0]['cart_num'];
        if ($operation == 1) {
            $cartsNum = $cartsNum + $num;
        } else {
            if ($cartsNum <= 1) {
                return array(
                    'status' => false,
                    'msg' => "数量已经最少了，不能在减少了"
                );
            }
            $cartsNum = $cartsNum - $num;
        }
        /** 执行操作 */
        (new ShoppingCartsDaoImpl())->updateByCartId($cartsId, $cartsNum);
        /** 结束 */
        return array(
            'status' => true,
            'msg' => "数量修改成功"
        );

    }

    /**
     * 获取这个用户的购物车
     * @param string $userId
     * @return array
     */
    public function listByUserCarts(string $userId): array
    {
        $isCarts = (new ShoppingCartsDaoImpl())->getByField(null, $userId);
        /** 判断购物车是否为空 */
        if (count($isCarts) == 0) {
            return array(
                'status' => true,
                'msg' => "获取成功",
                'data' => array()
            );
        }

        /** 遍历查找商品表相关数据 */
        $goods = array();
        foreach ($isCarts as $row) {
            $isGoods = (new GoodsDaoImpl())->getByGoodsId($row['goods_id']);
            if (count($isGoods) == 0) {
                $goods[] = array();
            } else {
                $goods[] = $isGoods[0];
            }
        }
        return array(
            'status' => true,
            'msg' => "数据获取成功",
            'data' => array(
                'carts' => (new ShoppingCarts())->ShoppingCartsModel($isCarts),
                'goods' => (new Goods())->goodsModel($goods)
            )
        );

    }
}