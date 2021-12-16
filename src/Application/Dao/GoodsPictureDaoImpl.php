<?php
namespace Application\Dao;
use Application\Library\DeleteBuilder;
use Application\Library\QueryBuilder;

class GoodsPictureDaoImpl implements GoodsPictureDao
{

    /**
     * 根据商品id获取更多图片信息
     * @param string $field
     * @param int $goodsId
     * @return array
     */
    public function getGoodsId(string $field,int $goodsId): array
    {
        $sql="SELECT {$field} FROM tb_goods_picture WHERE goods_id=?";
        $data=array($goodsId);
        return (new QueryBuilder())->run(2,$sql,"i",$data);
    }

    /**
     * 根据goods_id进行删除操作
     * @param int $goodsId
     * @return bool
     */
    public function deleteByGoodsId( int $goodsId): bool
    {
        $sql="DELETE FROM tb_goods_picture WHERE goods_id=?";
        $data=array($goodsId);
        return (new DeleteBuilder())->run(2,$sql,"i",$data);
    }
}