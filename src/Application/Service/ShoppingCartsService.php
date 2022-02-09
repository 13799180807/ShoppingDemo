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

}