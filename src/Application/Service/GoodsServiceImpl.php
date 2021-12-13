<?php
namespace src\Application\Service;

use src\Application\Dao\GoodsDaoImpl;
use src\Application\Helper\FilterHelper;
use src\Application\Library\Connection;
use src\Application\Model\GoodsModel;

class GoodsServiceImpl implements GoodsService
{

    /**
     * 根据id获取一条商品信息
     * @param int $id
     * @return array
     */
    public static function getById(int $id) : array
    {
        $data=array(
            'id'=>$id
        );
        /** 安全过滤 */
        $data=FilterHelper::safeReplace($data);
        $conn=Connection::conn();
        $res=GoodsDaoImpl::getById($conn,$data['id']);
        $conn->close();

        if(count($res)>0)
        {
            return GoodsModel::productPageInformationDisplay($res);

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
    public static function listField(string $field, string $value, int $status, int $num) :array
    {
        $data=array(
            'field'=>$field,
            'value'=>$value,
            'status'=>$status,
            'num'=>$num
        );
        /** 安全过滤 */
        $data=FilterHelper::safeReplace($data);
        $conn=Connection::conn();
        $res=GoodsDaoImpl::listField($conn,$data['field'],$data['value'],$data['status'],$data['num']);
        $conn->close();

        /** 判断有没数据 */
        if (count($res)>0)
        {
            return GoodsModel::homeInformationDisplay($res);
        }
        return array();

    }

    /**
     * 模糊查询
     * @param string $goodsName
     * @return array
     */
    public static function getByGoodsName(string $goodsName) : array
    {
        $data=array(
            'goodsName'=>$goodsName,
        );
        /** 安全过滤 */
        $data=FilterHelper::safeReplace($data);
        $conn=Connection::conn();
        $goodsName="%".$data['goodsName']."%";
        $res=GoodsDaoImpl::getByGoodsName($conn,$goodsName);
        $conn->close();
        if (count($res)>0)
        {
           return GoodsModel::homeInformationDisplay($res);
        }
        return array();

    }

}