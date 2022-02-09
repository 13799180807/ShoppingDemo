<?php


namespace Application\Dao;


interface ShoppingCartsDao
{
    /**
     * 加入一条数据
     * @param string $userId
     * @param int $goodsId
     * @param int $cartNum
     * @return int
     */
    public function saveShoppingCart(string $userId, int $goodsId, int $cartNum): int;

    /**
     * 根据字段删除数据
     * @param int|null $cartId
     * @param string|null $userId
     * @return bool
     */
    public function moveByField(int $cartId = null, string $userId = null): bool;

    /**
     * 修改信息
     * @param int $cartId
     * @param int $cartNum
     * @return bool
     */
    public function updateByCartId(int $cartId, int $cartNum): bool;

    /**
     * 根据字段查询获取数据
     * @param int|null $cartId
     * @param string|null $userId
     * @param int|null $goodsId
     * @return array
     */
    public function getByField(int $cartId = null, string $userId = null, int $goodsId = null): array;
    #查询
    #统计
}