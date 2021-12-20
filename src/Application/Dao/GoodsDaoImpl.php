<?php
namespace Application\Dao;
use Application\Library\SqlUtil;

class GoodsDaoImpl implements  GoodsDao
{
    /**
     * 删除商品表中一个分类的数据
     * @param int $goodsCategoryId
     * @return bool
     */
    public function removeByGoodsCategoryId(int $goodsCategoryId): bool
    {
        $sql="DELETE FROM tb_goods WHERE goods_category_id=?";
        return (new SqlUtil())->run("remove",$sql,"i",array($goodsCategoryId));

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
        return (new SqlUtil())->run("query",$sql,"ii",array($id,$status));
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
            return (new SqlUtil())->run("query",$sql,"ii",array($status,$num));
        }else{
            $sql="SELECT {$fields} FROM tb_goods WHERE {$field}=? and goods_status=?  ORDER BY updated_at DESC limit ? ";
            return (new SqlUtil())->run("query",$sql,"sii",array($value,$status,$num));
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
        return (new SqlUtil())->run("query",$sql,"is",array($status,$goodsName));
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
        return (new SqlUtil())->run("query",$sql,"i",array($goodsCategoryId));
    }





}