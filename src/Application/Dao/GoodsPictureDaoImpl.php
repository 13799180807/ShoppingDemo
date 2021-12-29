<?php
namespace Application\Dao;
use Application\Library\SqlUtil;

class GoodsPictureDaoImpl implements GoodsPictureDao
{

    /**
     * 根据商品id获取更多图片信息
     * @param int $goodsId
     * @return array
     */
    public function getGoodsId(int $goodsId): array
    {
        $sql="SELECT * FROM tb_goods_picture WHERE goods_id=?";
        return (new SqlUtil())->run("query",$sql,"i",array($goodsId));
    }

    /**
     * 根据goods_id进行删除操作
     * @param int $goodsId
     * @return bool
     */
    public function removeByGoodsId(int $goodsId): bool
    {
        $sql="DELETE FROM tb_goods_picture WHERE goods_id=?";
        return (new SqlUtil())->run("remove",$sql,"i",array($goodsId));
    }
}