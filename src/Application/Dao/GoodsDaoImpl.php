<?php
namespace Application\Dao;
use Application\Library\DeleteBuilder;
use Application\Library\QueryBuilder;

class GoodsDaoImpl implements  GoodsDao
{
    /**
     * 删除商品表中一个分类的数据
     * @param int $goodsCategoryId
     * @return bool
     */
    public function deleteByGoodsCategoryId(int $goodsCategoryId): bool
    {
        $sql="DELETE FROM tb_goods WHERE goods_category_id=?";
        $data=array($goodsCategoryId);
        return (new DeleteBuilder())->run(2,$sql,"i",$data);
    }

    /**
     * 根据id进行查询商品的某个信息
     * @param string $fields
     * @param int $id
     * @param int $status
     * @return array
     */
    public function getById(string $fields,int $id,int $status): array
    {
        $sql="SELECT {$fields} FROM tb_goods WHERE goods_id=? and goods_status=? ";
        $data=array($id,$status);
        return (new QueryBuilder())->run(2,$sql,"ii",$data);
    }

    /**
     * 根据进来不同字段获取不同数据
     * @param string $fields
     * @param string $field
     * @param string $value
     * @param int $status
     * @param int $num
     * @return array
     */
    public function listField(string $fields,string $field,string $value,int $status,int $num) : array
    {
        if ($field=="created_at"){
            $sql="SELECT {$fields} FROM tb_goods WHERE  goods_status=?  ORDER BY created_at DESC limit ?";
            $data=array($status,$num);
            return (new QueryBuilder())->run(2,$sql,"ii",$data);
        }else{
            $sql="SELECT {$fields} FROM tb_goods WHERE {$field}=? and goods_status=?  ORDER BY updated_at DESC limit ? ";
            $data=array($value,$status,$num);
            return (new QueryBuilder())->run(2,$sql,"sii",$data);
        }

    }

    /**
     * 根据名字进行模糊查询商品信息
     * @param string $field
     * @param int $status
     * @param string $goodsName
     * @return array
     */
    public function getByGoodsName(string $field,int $status,string $goodsName) : array
    {
        $sql="SELECT {$field} FROM tb_goods WHERE  goods_status=? and goods_name  LIKE ? ";
        $data=array($status,$goodsName);
        return (new QueryBuilder())->run(2,$sql,"is",$data);
    }

    /**
     * 获取这个分类下的所有id
     * @param string $field
     * @param int $goodsCategoryId
     * @return array
     */
    public function listGoodsCategoryId(string $field,int $goodsCategoryId) :array
    {
        $sql="SELECT {$field} FROM tb_goods WHERE goods_category_id=? ";
        $data=array($goodsCategoryId);
        return (new QueryBuilder())->run(2,$sql,"i",$data);
    }





}