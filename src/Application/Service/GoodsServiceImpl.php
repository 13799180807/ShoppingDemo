<?php


class GoodsServiceImpl implements GoodsService
{

    /**
     * @param $id
     * @return string
     */
    public static function getById($id)
    {
        // TODO: Implement getById() method.
        $conn=Connection::conn();
        $res=GoodsDaoImpl::getById($conn,$id);
        $conn->close();
        if(count($res)>0){
            return $res;
        }else{
            return -1;
        }

    }

    /**
     * @param $field
     * @param $value
     * @param $status
     * @param $num
     * @return array
     */
    public static function listField($field, $value, $status, $num) :array
    {
        $conn=Connection::conn();
        $res=GoodsDaoImpl::listField($conn,$field,$value,$status,$num);
        $conn->close();
        if (count($res)>0){
            return $res;
        }else{
            return array();
        }
    }

    /**
     * @param $goodsName
     * @return array
     * 模糊查询
     */
    public static function getByGoodsName($goodsName) : array
    {
        $conn=Connection::conn();
        $goodsName="%".$goodsName."%";
        return GoodsDaoImpl::getByGoodsName($conn,$goodsName);

    }

}