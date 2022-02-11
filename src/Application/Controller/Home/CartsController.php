<?php


namespace Application\Controller\Home;


use Application\Helper\FeedBack;
use Application\Helper\Request;
use Application\Middleware\Token;
use Application\Service\ShoppingCartsServiceImpl;

class CartsController
{


    /** 获取购物车信息 */
    public function actionListCarts()
    {
        /** 接收数据 */
        $token = Request::param("token", "s");
        $userId = Request::param("account", "s");
        /** 验证数据 */
        $isToken = (new Token())->isState("user", $userId, $token);
        if (!$isToken['status']) {
            echo FeedBack::result(404, $isToken['msg']);
            return;
        }
        /** 数据查询 */
        $res = (new ShoppingCartsServiceImpl())->listByUserCarts($userId);
        if (!$res['status']) {
            echo FeedBack::result(404, "获取信息失败");
            return;
        }
        if (count($res['data']) == 0) {
            echo FeedBack::result(200, "购物车信息为空", array());
            return;
        }
        /** 组合数据 */
        $carts = $res['data']['carts'];
        $goods = $res['data']['goods'];
        $cartsList = array();
        for ($i = 0; $i < count($carts); $i++) {
            $c = array();
            /** 商品存在，执行组装 */
            $c['cartId'] = $carts[$i]['cartId'];#购物车订单ID
            $c['goodsId'] = $goods[$i]['goodsId'];#商品ID
            $c['goodsName'] = $goods[$i]['goodsName'];#商品名字
            $c['goodsPrice'] = $goods[$i]['goodsPrice'];#商品价格
            $c['goodsImg'] = $goods[$i]['goodsImg'];#商品图片
            $c['goodsStatus'] = $goods[$i]['goodsStatus'];
            $c['cartNum'] = $carts[$i]['cartNum'];#购买数量
            if ($carts[$i]['goodsId'] != $goods[$i]['goodsId']) {
                $c['goodsStatus'] = 3;
            } else {
                $c['goodsStatus'] = $goods[$i]['goodsStatus'];
            }
            $cartsList[] = $c;
        }
        echo FeedBack::result(200, "获取信息成功", $cartsList);
    }

    /** 加入购物车 */
    public function actionAddCarts()
    {
        $token = Request::param("token", "s");
        $userId = Request::param("account", "s");
        $num = Request::param("num", "i");
        $goodsId = Request::param("goodsId", "i");

        if ($num == 0 || $goodsId == 0) {
            echo FeedBack::result(404, "加入购物车失败，参数错误");
            return;
        }

        $isToken = (new Token())->isState("user", $userId, $token);
        if (!$isToken['status']) {
            echo FeedBack::result(404, $isToken['msg']);
            return;
        }

        $res = (new ShoppingCartsServiceImpl())->saveShoppingCart($userId, $goodsId, $num);
        if (!$res['status']) {
            echo FeedBack::result(404, $res['msg']);
            return;
        }
        echo FeedBack::result(200, "加入购物车成功");
    }

    /** 删除记录 */
    public function actionDelCarts()
    {
        $token = Request::param("token", "s");
        $userId = Request::param("account", "s");
        $cartsId = Request::param("cartsId", "i");
        if ($cartsId == 0) {
            echo FeedBack::result(404, "删除订单失败，参数错误");
            return;
        }
        $isToken = (new Token())->isState("user", $userId, $token);
        if (!$isToken['status']) {
            echo FeedBack::result(404, $isToken['msg']);
            return;
        }
        $res = (new ShoppingCartsServiceImpl())->moveByCartsId($cartsId, $userId);
        if (!$res['status']) {
            echo FeedBack::result(404, $isToken['msg']);
            return;
        }
        echo FeedBack::result(200, "删除成功");
    }

    /** 购物车数量加减 */
    public function actionUpdCartsNum()
    {
        $token = Request::param("token", "s");
        $userId = Request::param("account", "s");
        $cartsId = Request::param("cartsId", "i");
        $operation = Request::param("operation", "i");

        if ($cartsId == 0 || $operation == 0) {
            echo FeedBack::result(404, "修改数量失败，参数错误");
            return;
        }
        if ($operation != 1 && $operation != 2) {
            echo FeedBack::result(404, "商品数量修改失败");
            return;
        }
        $isToken = (new Token())->isState("user", $userId, $token);
        if (!$isToken['status']) {
            echo FeedBack::result(404, $isToken['msg']);
            return;
        }
        $res = (new ShoppingCartsServiceImpl())->updateCartsId($cartsId, $userId, $operation);
        if (!$res['status']) {
            echo FeedBack::result(404, $res['msg']);
            return;
        }
        echo FeedBack::result(200, "数量修改成功");
    }


}