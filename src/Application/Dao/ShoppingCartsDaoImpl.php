<?php


namespace Application\Dao;


use Application\Helper\Filter;
use Application\Library\SqlUtil;

class ShoppingCartsDaoImpl implements ShoppingCartsDao
{

    /**
     * 添加一个数据
     * @param string $userId
     * @param int $goodsId
     * @param int $cartNum
     * @return int
     */
    public function saveShoppingCart(string $userId, int $goodsId, int $cartNum): int
    {
        $data = Filter::preventXss(array($userId, $goodsId, $cartNum));
        $sql = "INSERT INTO tb_shopping_carts (user_id, goods_id, cart_num) VALUES (?,?,?)";
        return (new SqlUtil())->run("save", $sql, "sii", $data);
    }

    /**
     * 根据字段删除数据
     * @param int|null $cartId
     * @param string|null $userId
     * @return bool
     */
    public function moveByField(int $cartId = null, string $userId = null): bool
    {
        if (($cartId == null && $userId == null) || ($cartId != null && $userId != null)) {
            return false;
        }

        $sql = "DELETE FROM tb_shopping_carts WHERE";
        $data = array();
        if ($cartId != null) {
            $sql = $sql . " cart_id=?";
            $data[] = $cartId;
        }
        if ($userId != null) {
            $sql = $sql . " user_id=?";
            $data[] = $userId;
        }

        return (new SqlUtil())->run("remove", $sql, "s", $data);

    }

    /**
     * 更新数据
     * @param int $cartId
     * @param int $cartNum
     * @return bool
     */
    public function updateByCartId(int $cartId, int $cartNum): bool
    {
        $sql = "UPDATE tb_shopping_carts SET cart_num=? WHERE cart_id=?";
        $data = Filter::preventXss(array($cartNum, $cartId));
        return (new SqlUtil())->run("update", $sql, "ii", $data);
    }

    /**
     * 获取数据
     * @param int|null $cartId
     * @param string|null $userId
     * @param int|null $goodsId
     * @return array
     */
    public function getByField(int $cartId = null, string $userId = null, int $goodsId = null): array
    {
        $sql = "SELECT * FROM tb_shopping_carts WHERE";
        $data = array();
        $fieldsType = "";
        if ($cartId != null) {
            $sql = $sql . " cart_id=? AND";
            $data[] = $cartId;
            $fieldsType = $fieldsType . "i";
        }
        if ($userId != null) {
            $sql = $sql . " user_id=? AND";
            $data[] = $userId;
            $fieldsType = $fieldsType . "s";
        }
        if ($goodsId != null) {
            $sql = $sql . " goods_id=? AND";
            $data[] = $goodsId;
            $fieldsType = $fieldsType . "i";
        }
        /** 去掉不想要的 */
        $sql = trim($sql, "AND");

        if (count($data) == 0) {
            return array();
        }
        return (new SqlUtil())->run("query", $sql, $fieldsType, Filter::preventXss($data));


    }
}