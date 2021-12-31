<?php
namespace Application\Dao;
use Application\Helper\Filter;
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

    /**
     * 根据商品id进行插入商品详细介绍
     * @param int $goodsId
     * @param string $introduction
     * @return int
     */
    public function saveByGoodsId(int $goodsId, string $introduction=""): int
    {
        /** 过滤字符 */
        $resFilter=Filter::setEntities(array("introduction"=>$introduction));
        /** sql组转 */
        $sql="INSERT INTO tb_goods_introduction(goods_id,goods_introduction) value  (?,?)";
        /** 执行插入 */
        return (new SqlUtil())->run("save",$sql,"is",array($goodsId,$resFilter['introduction']));
    }

    /**
     * 根据商品id更新商品表中的商品数据
     * @param int $goodsId
     * @param string $introduction
     * @return bool
     */
    public function updateByGoodsId(int $goodsId, string $introduction=""): bool
    {
        /** 过滤字符 */
        $resFilter=Filter::setEntities(array("introduction"=>$introduction));
        /** 组装 */
        $sql="UPDATE tb_goods_introduction SET goods_introduction=? WHERE goods_id=?";
        /** 更新 */
        return (new SqlUtil())->run("update",$sql,"si",array($resFilter['introduction'],$goodsId));


    }
}