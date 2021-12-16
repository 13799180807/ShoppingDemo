<?php
namespace Application\Service;

use Application\Dao\GoodsDaoImpl;
use Application\Domain\Goods;
use Application\Helper\FilterHelper;

class GoodsServiceImpl implements GoodsService
{
    /**
     * 根据id获取一条商品信息
     * @param int $id
     * @return array
     */
    public function getById(int $id) : array
    {
        $data=array(
            'id'=>$id
        );
        /** 安全过滤 */
        $data=FilterHelper::safeReplace($data);
        $fields=array(
            'goodsId','goodsName','goodsCategoryId','goodsPrice','goodsStock',
            'goodsHot','goodsRecommendation','goodsDescribe','goodsImg', 'createdAt',
            );
        $fields=splicing($fields);
        $res=(new GoodsDaoImpl())->getById($fields,$data['id'],1);

        if(count($res)>0)
        {
           return (new Goods())->GoodsModel($res);
        }
        return array();
    }

    /**
     * 根据不同字段名获取对应的信息
     * @param string $field
     * @param string $value
     * @param int $status
     * @param int $num
     * @return array
     */
    public function listField(string $field, string $value, int $status, int $num) :array
    {
        $data=array(
            'field'=>$field,
            'value'=>$value,
            'status'=>$status,
            'num'=>$num
        );
        /** 安全过滤 */
        $data=FilterHelper::safeReplace($data);
        $fields=array(
            'goodsId','goodsName','goodsCategoryId','goodsPrice','goodsImg',
        );
        $fields=splicing($fields);
        $res=(new GoodsDaoImpl())->listField($fields,$data['field'],$data['value'],$data['status'],$data['num']);

        /** 判断有没数据 */
        if (count($res)>0)
        {
            return (new Goods())->GoodsModel($res);
        }
        return array();
    }

    /**
     * 模糊查询
     * @param string $goodsName
     * @return array
     */
    public function getByGoodsName(string $goodsName) : array
    {
        $data=array(
            'goodsName'=>$goodsName,
        );
        /** 安全过滤 */
        $data=FilterHelper::safeReplace($data);

        $fields=array(
            'goodsId','goodsName','goodsCategoryId','goodsPrice','goodsImg',
        );
        $fields=splicing($fields);
        $goodsName="%".$data['goodsName']."%";
        $res=(new GoodsDaoImpl())->getByGoodsName($fields,1,$goodsName);

        if (count($res)>0)
        {
            return (new Goods())->GoodsModel($res);
        }
        return array();

    }

}