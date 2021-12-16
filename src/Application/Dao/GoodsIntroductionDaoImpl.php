<?php
namespace Application\Dao;

use Application\Library\DeleteBuilder;
use Application\Library\QueryBuilder;

class GoodsIntroductionDaoImpl implements GoodsIntroductionDao
{

    /**
     * 根据商品id进行商品详细说明查询
     * @param string $field
     * @param int $goodsId
     * @return array
     */
    public function getGoodsId(string $field,int $goodsId): array
    {
        $sql="SELECT {$field} FROM tb_goods_introduction WHERE goods_id=?";
        $data=array($goodsId);
        return (new QueryBuilder())->run(2,$sql,"i",$data);
    }

    /**
     * 根据goods_id进行删除
     * @param int $goodsId
     * @return bool
     */
    public function deleteByGoodsId(int $goodsId): bool
    {
        $sql="DELETE FROM tb_goods_introduction WHERE goods_id=?";
        $data=array($goodsId);
        return (new DeleteBuilder())->run(2,$sql,"i",$data);
    }


}