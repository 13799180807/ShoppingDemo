<?php


namespace Application\Domain;


class ShoppingCarts
{
    public int $cart_id;
    public string $user_id;
    public string $goods_id;
    public int $cart_num;
    public string $created_at;
    public string $updated_at;

    public function ShoppingCartsModel(array $rows): array
    {
        $dataList = array();
        $i = 0;
        foreach ($rows as $row) {
            $c = new ShoppingCarts();
            foreach ($row as $key => $value) {
                $key = underscoreToHump($key);
                /** 安全处理 */
                $c->$key = htmlentities($value);
            }
            $dataList[$i] = (array)$c;
            $i++;
        }
        return $dataList;
    }

}