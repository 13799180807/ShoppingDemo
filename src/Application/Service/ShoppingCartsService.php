<?php


namespace Application\Service;


interface ShoppingCartsService
{
    /**
     * 添加到购物车
     * @param string $userId
     * @param int $goodsId
     * @param int $cartNum
     * @return array
     */
    public function saveShoppingCart(string $userId, int $goodsId, int $cartNum): array;

    /**
     * 删除购物车记录
     * @param int $cartsId
     * @param string $userId
     * @return array
     */
    public function moveByCartsId(int $cartsId, string $userId): array;

    /**
     * 购物车数量的加减 $operation=1时＋否则-
     * @param int $cartsId
     * @param string $userId
     * @param int $operation
     * @param int $num
     * @return array
     */
    public function updateCartsId(int $cartsId, string $userId, int $operation, int $num = 1): array;

    /**
     * 获取这个用户的购物车
     * @param string $userId
     * @return array
     */
    public function listByUserCarts(string $userId): array;

}