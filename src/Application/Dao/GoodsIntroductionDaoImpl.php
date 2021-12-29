<?php
namespace Application\Dao;
use Application\Library\SqlUtil;

class GoodsIntroductionDaoImpl implements GoodsIntroductionDao
{

    /**
     * 根据商品id进行商品详细说明查询
     * @param int $goodsId
     * @return array
     */
    public function getGoodsId(int $goodsId): array
    {
        $sql="SELECT * FROM tb_goods_introduction WHERE goods_id=?";
        return (new SqlUtil())->run("query",$sql,"i",array($goodsId));
    }

    /**
     * 根据goods_id进行删除
     * @param int $goodsId
     * @return bool
     */
    public function removeByGoodsId(int $goodsId): bool
    {
        $sql="DELETE FROM tb_goods_introduction WHERE goods_id=?";
        return (new SqlUtil())->run("remove",$sql,"i",array($goodsId));
    }


}